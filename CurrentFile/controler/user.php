<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 17.03.2020
 * Description : Contains all functions related to the user
 **/

/**
 * Get datas user's VMs to display the user's VMs at the home page
 */
function displayHome()
{
    if(isset($_SESSION['userType'])&& $_SESSION['userType'] != null)
    {
        require_once 'model/userManager.php';
        $userId = getUserId($_SESSION['userEmail']);

        require_once "model/vmManager.php";
        $allVmName = getAllVmNameAndId();
        $allValidatedVM = getUserValidatedVM($userId);
        $allConfirmationVM = getUserConfirmationVM($userId);
        $allRenewalVM = getUserRenewalVM($userId);
        $allDeletedVM = getUserDeletedOrUnrenewalVM($userId);
        $allVM = getUserVM($userId);

        $_GET['action'] = "home";
        require_once "view/home.php";
    }
    else
    {
        $_GET['action'] = "signIn";
        require "view/signIn.php";
    }
}

/**
 * Display the sign in page
 */
function displaySignIn()
{
    $_GET['action'] = "signIn";
    require 'view/signIn.php';
}

/**
 * Verify the datas's form VM order and if the login is correct, display the home page.
 * (Only if the user did not take any action before logging in).
 *
 * @param $loginRequest = The datas's form VM order (POST)
 */
function login($loginRequest)
{
    if (isset($loginRequest['userLogin']) && $loginRequest['userLogin'] != null && isset($loginRequest['userPassword']) && $loginRequest['userPassword'] != null)
    {
        $userLogin= $loginRequest['userLogin'];
        $userPwd = $loginRequest['userPassword'];

        require_once "model/userManager.php";
        $userEmail = userLogin($userLogin, $userPwd);

        if ($userEmail!=null && $userEmail!=false && $_SESSION['loginNumber'] != 2)
        {
            createSession($userEmail);

            if(isset($_SESSION['actionUser']) && $_SESSION['actionUser'] == "detailsVM")
            {
                displayDetailsVM($_SESSION['idVM']);
            }
            else
            {
                displayHome();
            }
        }
        else
        {
            if(isset($_SESSION['loginNumber'])){
                if($_SESSION['loginNumber'] >= 2){
                    $date = new DateTime();
                    if(isset($_SESSION['loginFail']) && $_SESSION['loginFail'] != null && $_SESSION['loginFail'] != false){
                        if($_SESSION['loginFail']+300 <= $date->getTimestamp()){
                            unset($_SESSION['loginFail']);
                            unset($_SESSION['loginNumber']);
                            unset($_SESSION['loginLeftTime']);
                        }
                        else{
                            $_SESSION['loginLeftTime'] = ($_SESSION['loginFail']+300) - $date->getTimestamp();
                        }
                    }
                    else{
                        $_SESSION['loginFail'] = $date->getTimestamp();
                        $_SESSION['loginLeftTime'] = $date->getTimestamp() - $_SESSION['loginFail'];
                    }
                }
                else{
                    $_SESSION['loginNumber'] ++;
                }
            }
            else{
                $_SESSION['loginNumber'] = 1;
            }

            $_GET['action'] = "signIn";
            $_POST['error'] = "credentials";
            require "view/signIn.php";
        }
    }
    else
    {
        $_GET['action'] = "signIn";
        $_POST['error'] = "fieldEmpty";
        require "view/signIn.php";
    }
}

/**
 * Create the user's session (store the user's informations into the user's session)
 * @param $userEmail = The user's email address
 */
function createSession($userEmail)
{
    $_SESSION['userEmail'] = $userEmail;

    $_SESSION['sessionTime'] = strtotime(date("Y-m-d H:i:s"));

    $_SESSION['userType'] = getUserType($userEmail);
    $_SESSION['userId'] = getUserId($userEmail);

    require_once 'model/vmManager.php';

    if($_SESSION['userType'] == 1)
    {
        $_SESSION['countConfirmationVM'] = countConfirmationVM();
        $_SESSION['countRenewalVM'] = countRenewalVM();
    }
    else
    {
        $_SESSION['countConfirmationVM'] = countUserConfirmationVM($_SESSION['userId']);
        $_SESSION['countRenewalVM'] = countUserRenewalVM($_SESSION['userId']);
    }

    require_once 'model/notificationPushManager.php';
    addNotificationPush("une connexion réussi");
}

function testSessionTime(){
    if(isset($_SESSION['sessionTime']) == false || $_SESSION['sessionTime'] + 3600 < strtotime(date("Y-m-d H:i:s"))){
        signOut();
        return true;
    }
    else{
        $_SESSION['sessionTime'] = strtotime(date("Y-m-d H:i:s"));
        if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1)
        {
            $_SESSION['countConfirmationVM'] = countConfirmationVM();
            $_SESSION['countRenewalVM'] = countRenewalVM();
        }
        else
        {
            $_SESSION['countConfirmationVM'] = countUserConfirmationVM($_SESSION['userId']);
            $_SESSION['countRenewalVM'] = countUserRenewalVM($_SESSION['userId']);
        }
        return false;
    }
}

/**
 * Disconnect the user, delete user's information and redirect the user to the sign in page
 */
function signOut()
{
    $_SESSION = array();
    session_destroy();

    displaySignIn();
}

/**
 * Get users to display and display the users management page
 */
function displayManagementUser()
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1)
    {
        require_once 'model/userManager.php';
        $allUsers = getAllUsers();
        $allUsersAsc = getAllUsersAscendant();
        $allUsersDesc = getAllUsersDescendant();

        require_once 'view/userManagement.php';
    }
    else
    {
        displaySignIn();
    }
}

function renewalTest(){
    require_once 'model/vmManager.php';
    require_once 'model/mailSender.php';
    // Get all VM from dataBase
    $allVm = getAllVmForCheckSendingMail();

    $advertMail = 0;
    $nonrenewalMail = 0;

    // Do a verification for all vm
    foreach($allVm as $vm){
        $idVm = $vm['id'];
        $vmStatus = $vm['vmStatus'];
        $userMail = $vm['customer'];
        $requestName = $vm['name'];
        $rtMail = $vm['userRt'];
        $raMail = $vm['userRa'];
        $dateEndVm = $vm['dateEnd'];
        $dateAnniversary = $vm['dataAnniversary'];

        // Function who do the verification, we only need to give these info
        if(isAnyMailToSend($idVm, $vmStatus, $userMail, $requestName, $rtMail, $raMail, $dateEndVm, $dateAnniversary)){
            $advertMail ++;
        }
        else{
            $nonrenewalMail ++;
        }
    }

    require_once 'model/notificationPushManager.php';
    addNotificationPush("une vérification pour l'envoi des e-mails d\'avertissement pour le renouvellement des VM");

    echo '<script>alert("'.$advertMail.' vérification pour des e-mails d\'avertissement ont été effectuée.<br>'.$nonrenewalMail.' e-mails de non renouvellements sont partis.");</script>';

    displayManagementUser();
}

/**
 * Refresh the users list (get the users on the ad server with ldap and add the users into the DB)
 * then display the users management page.
 */
function refreshUser(){
    require_once 'model/userManager.php';

    if(verificationUserFromDb())
    {
        displayManagementUser();
    }
    else
    {
        displayManagementUser();
    }

    require_once 'model/notificationPushManager.php';
    addNotificationPush("une vérification de la liste des users via l'annuaire");
}

/**
 * Verify the datas's form users management, updating the user type depending of the user's actions
 * and finally display the users management page.
 *
 * @param $allData = The datas's form users management (POST)
 */
function saveModificationAboutUsers($allData)
{
    require_once 'model/userManager.php';
    $allUsers = getAllUsers();

    //get the right list of user, depend on sorting method
    if(isset($allData['usersAfterAsc']) && isset($allData['usersViewerAfterAsc']))
    {
        $adminFromForm = explode(";", $allData['usersAfterAsc']);
        $viewerFromForm = explode(";", $allData['usersViewerAfterAsc']);

        //part used to check if we need to upgrade an user to administrator
        foreach($adminFromForm as $adminForm)
        {
            foreach($allUsers as $user)
            {
                if($adminForm == $user['user_id'])
                {
                    if($user['type'] == 0 || $user['type'] == 2)
                    {
                        $userName = getUserCompleteName($user['user_id']);
                        updateType($user['user_id'], true);
                        require_once 'model/notificationPushManager.php';
                        addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant qu'administrateur");
                    }
                }
            }
        }

        //part used to check if we need to upgrade an user to viewer
        foreach($viewerFromForm as $viewerForm)
        {
            foreach($allUsers as $user)
            {
                if($viewerForm == $user['user_id'])
                {
                    if($user['type'] == 0 || $user['type'] == 1)
                    {
                        $userName = getUserCompleteName($user['user_id']);
                        updateType($user['user_id'], 2);
                        require_once 'model/notificationPushManager.php';
                        addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que viewer");
                    }
                }
            }
        }

        $adminFromDb = getAllAdmin();

        //part used to check if we need to downgrade an administrator to user
        foreach($adminFromDb as $adminDb)
        {
            $res = false;
            foreach($adminFromForm as $adminForm)
            {
                if($adminForm == $adminDb['user_id'])
                {
                    $res = true;
                }
            }

            if(!$res)
            {
                $userName = getUserCompleteName($adminDb['user_id']);
                updateType($adminDb['user_id'], false);
                require_once 'model/notificationPushManager.php';
                addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que simple utilisateur");
            }
        }

        $viewerFromDb = getAllViewer();

        //part used to check if we need to downgrade an viewer to user
        foreach($viewerFromDb as $viewerDb)
        {
            $res = false;

            foreach($viewerFromForm as $viewerForm)
            {
                if($viewerForm == $viewerDb['user_id'])
                {
                    $res = true;
                }
            }

            if(!$res)
            {
                $userName = getUserCompleteName($viewerDb['user_id']);
                updateType($viewerDb['user_id'], false);
                require_once 'model/notificationPushManager.php';
                addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que simple utilisateur");
            }
        }
    }
    elseif(isset($allData['usersAfterDesc']) && isset($allData['usersViewerAfterDesc']))
    {
        $adminFromForm = explode(";", $allData['usersAfterDesc']);
        $viewerFromForm = explode(";", $allData['usersViewerAfterDesc']);

        foreach($adminFromForm as $adminForm)
        {
            foreach($allUsers as $user)
            {
                if($adminForm == $user['user_id'])
                {
                    if($user['type'] == 0 || $user['type'] == 2)
                    {
                        $userName = getUserCompleteName($user['user_id']);
                        updateType($user['user_id'], true);
                        require_once 'model/notificationPushManager.php';
                        addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant qu'administrateur");
                    }
                }
            }
        }

        foreach($viewerFromForm as $viewerForm)
        {
            foreach($allUsers as $user)
            {
                if($viewerForm == $user['user_id'])
                {
                    if($user['type'] == 0 || $user['type'] == 1)
                    {
                        $userName = getUserCompleteName($user['user_id']);
                        updateType($user['user_id'], 2);
                        require_once 'model/notificationPushManager.php';
                        addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que viewer");
                    }
                }
            }
        }

        $adminFromDb = getAllAdmin();

        foreach($adminFromDb as $adminDb)
        {
            $res = false;

            foreach($adminFromForm as $adminForm)
            {
                if($adminForm == $adminDb['user_id'])
                {
                    $res = true;
                }
            }

            if(!$res)
            {
                $userName = getUserCompleteName($adminDb['user_id']);
                updateType($adminDb['user_id'], false);
                require_once 'model/notificationPushManager.php';
                addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que simple utilisateur");
            }
        }

        $viewerFromDb = getAllViewer();

        foreach($viewerFromDb as $viewerDb)
        {
            $res = false;

            foreach($viewerFromForm as $viewerForm)
            {
                if($viewerForm == $viewerDb['user_id'])
                {
                    $res = true;
                }
            }
            if(!$res)
            {
                $userName = getUserCompleteName($viewerDb['user_id']);
                updateType($viewerDb['user_id'], false);
                require_once 'model/notificationPushManager.php';
                addNotificationPush("passer le compte de ".$userName[0]." ".$userName[1]." en tant que simple utilisateur");
            }
        }
    }
    displayManagementUser();
}
