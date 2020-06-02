<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* Description : Contains all functions related to the user
**/

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

function displaySignIn()
{
    $_GET['action'] = "signIn";
    require 'view/signIn.php';
}

function login($loginRequest)
{
  if (isset($loginRequest['userLogin']) && $loginRequest['userLogin'] != null && isset($loginRequest['userPassword']) && $loginRequest['userPassword'] != null)
     {
         $userLogin= $loginRequest['userLogin'];
         $userPwd = $loginRequest['userPassword'];

         require_once "model/userManager.php";

         $userEmail = userLogin($userLogin, $userPwd);

         if ($userEmail!=null || $userEmail!=false)
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

function createSession($userEmail)
{
    $_SESSION['userEmail'] = $userEmail;
    $_SESSION['userType'] = getUserType($userEmail);
    $_SESSION['userId'] = getUserId($userEmail);

    require_once 'model/vmManager.php';
    $_SESSION['countConfirmationVM'] = countConfirmationVM();
    $_SESSION['countRenewalVM'] = countRenewalVM();
}

function signOut()
{
    $_SESSION = array();
    session_destroy();

    displayHome();
}

function displayManagementUser(){
    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
        require_once 'model/userManager.php';
        $allUsers = getAllUsers();
        $allUsersAsc = getAllUsersAscendant();
        $allUsersDesc = getAllUsersDescendant();

        require_once 'view/userManagement.php';
    }
    else{
        displaySignIn();
    }

}

function refreshUser(){
    require_once 'model/userManager.php';
    if(verificationUserFromDb()){
        displayManagementUser();
    }
    else{
        displayManagementUser();
    }
}

function saveModificationAboutUsers($allData){
    require_once 'model/userManager.php';
    $allUsers = getAllUsers();

    if(isset($allData['usersAfterAsc']) && isset($allData['usersViewerAfterAsc'])){
        $adminFromForm = explode(";", $allData['usersAfterAsc']);
        $viewerFromForm = explode(";", $allData['usersViewerAfterAsc']);
        foreach($adminFromForm as $adminForm){
            foreach($allUsers as $user){
                if($adminForm == $user['user_id']){
                    if($user['type'] == 0 || $user['type'] == 2){
                        updateType($user['user_id'], true);
                    }
                }
            }
        }

        foreach($viewerFromForm as $viewerForm){
            foreach($allUsers as $user){
                if($viewerForm == $user['user_id']){
                    if($user['type'] == 0 || $user['type'] == 1){
                        updateType($user['user_id'], 2);
                    }
                }
            }
        }

        $adminFromDb = getAllAdmin();
        foreach($adminFromDb as $adminDb){
            $res = false;
            foreach($adminFromForm as $adminForm){
                if($adminForm == $adminDb['user_id']){
                    $res = true;
                }
            }
            if(!$res){
                updateType($adminDb['user_id'], false);
            }
        }

        $viewerFromDb = getAllViewer();
        foreach($viewerFromDb as $viewerDb){
            $res = false;
            foreach($viewerFromForm as $viewerForm){
                if($viewerForm == $viewerDb['user_id']){
                    $res = true;
                }
            }
            if(!$res){
                updateType($viewerDb['user_id'], false);
            }
        }
    }
    elseif(isset($allData['usersAfterDesc']) && isset($allData['usersViewerAfterDesc'])){
        $adminFromForm = explode(";", $allData['usersAfterDesc']);
        $viewerFromForm = explode(";", $allData['usersViewerAfterDesc']);
        foreach($adminFromForm as $adminForm){
            foreach($allUsers as $user){
                if($adminForm == $user['user_id']){
                    if($user['type'] == 0 || $user['type'] == 2){
                        updateType($user['user_id'], true);
                    }
                }
            }
        }

        foreach($viewerFromForm as $viewerForm){
            foreach($allUsers as $user){
                if($viewerForm == $user['user_id']){
                    if($user['type'] == 0 || $user['type'] == 1){
                        updateType($user['user_id'], 2);
                    }
                }
            }
        }

        $adminFromDb = getAllAdmin();
        foreach($adminFromDb as $adminDb){
            $res = false;
            foreach($adminFromForm as $adminForm){
                if($adminForm == $adminDb['user_id']){
                    $res = true;
                }
            }
            if(!$res){
                updateType($adminDb['user_id'], false);
            }
        }

        $viewerFromDb = getAllViewer();
        foreach($viewerFromDb as $viewerDb){
            $res = false;
            foreach($viewerFromForm as $viewerForm){
                if($viewerForm == $viewerDb['user_id']){
                    $res = true;
                }
            }
            if(!$res){
                updateType($viewerDb['user_id'], false);
            }
        }
    }

    displayManagementUser();
}
