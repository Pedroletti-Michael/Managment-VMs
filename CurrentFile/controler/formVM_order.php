<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 17.03.2020
 * Description : Contains all functions related to the formVM_order
 **/

/**
 * Get datas to display on the form VM order then display the form VM order
 */
function displayForm()
{
    if(isset($_SESSION['userType'])&& $_SESSION['userType'] != null)
    {
        require_once 'model/displayManager.php';
        $entityNames = displayBDD_Entity();
        $osNames = displayOsCommendable();
        $windowsData = displayBDD_OSNameWhereWindows();
        $linuxData = displayBDD_OSNameWhereLinux();
        $snapshotPolicy = displayBSS_Snapshots();
        $backupPolicy = displayBSS_Backup();

        require_once 'model/vmManager.php';
        $namesValue = getVmName();
        $allVmName = array();

        foreach ($namesValue as $value)
        {
            array_push($allVmName, $value[0]);
        }

        require_once 'model/userManager.php';
        $users = getAllUsers();

        $_GET['action'] = "form";
        require 'view/form.php';
    }
    else
    {
        $_GET['action'] = "signIn";
        require "view/signIn.php";
    }
}

/**
 * Get datas to display on the admin form VM order then display the admin form VM order
 */
function displayFormAdmin()
{
    if(isset($_SESSION['userType'])&& $_SESSION['userType'] != null)
    {
        require_once 'model/displayManager.php';
        $entityNames = displayBDD_Entity();
        $osNames = displayBDD_OS();
        $windowsData = displayBDD_OSNameWhereWindows();
        $linuxData = displayBDD_OSNameWhereLinux();
        $snapshotPolicy = displayBSS_Snapshots();
        $backupPolicy = displayBSS_Backup();
        $clusterData = getClusters();

        require_once 'model/vmManager.php';
        $namesValue = getVmName();
        $allVmName = array();

        foreach ($namesValue as $value)
        {
            array_push($allVmName, $value[0]);
        }

        require_once 'model/userManager.php';
        $users = getAllUsers();

        $_GET['action'] = "formAdmin";
        require 'view/formAdmin.php';
    }
    else
    {
        $_GET['action'] = "signIn";
        require "view/signIn.php";
    }
}

/**
 * Check the datas's form VM order and, when all is correct, add the VM into the DB
 * and send a mail to the customer, the technical manager and the administrative manager.
 *
 * @param $formVMRequest = The datas's form VM order (POST)
 */
function formVM($formVMRequest)
{
    require_once 'model/vmManager.php';
    $_SESSION['$displayModalConfirm'] = false;
    $errorForm = false;
    $allVmName = getVmName();
    $nameResult = false;
    $name = false;

    foreach ($allVmName as $name)
    {
        $name['name'] = strtolower($name['name']);
        if($formVMRequest['inputVMName'] == $name['name'])
        {
            $name = true;
            break;
        }
    }

    if($name){
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if($formVMRequest['inputTMName'] == null || $formVMRequest['inputRAName'] == null)
    {
        $errorForm = true;
        $_SESSION['displayModalNoUserSelected'] = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if(strlen($formVMRequest['ti']) > 1000 || strlen($formVMRequest['objective']) > 1000)
    {
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if($nameResult)
    {
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if(isset($formVMRequest['inputEndDate']) && $formVMRequest['inputEndDate'] != null || $formVMRequest['inputEndDate'] != '')
    {
        $today = date('Y-m-d');
        $now = strtotime($today);
        if (strtotime($formVMRequest['inputComissioningDate']) > strtotime($formVMRequest['inputEndDate']) || strtotime($formVMRequest['inputComissioningDate']) < $now)
        {
            $errorForm = true;
            $_SESSION['formRequest'] = $formVMRequest;
            displayForm();
        }
    }
    else
    {
        $formVMRequest['inputEndDate'] = null;
    }

    if($errorForm == true)
    {
        exit();
    }

    if(isset($formVMRequest['Academique']))
    {
        $formVMRequest['usingVM'] = "Academique";
    }
    if (isset($formVMRequest['RaD']))
    {
        if(!isset($formVMRequest['usingVM']))
        {
            $formVMRequest['usingVM'] = "RaD";
        }
        else
        {
            $formVMRequest['usingVM'] = $formVMRequest['usingVM'].", RaD";
        }
    }
    if (isset($formVMRequest['Operationnel']))
    {
        if(!isset($formVMRequest['usingVM']))
        {
            $formVMRequest['usingVM'] = "Operationnel";
        }
        else
        {
            $formVMRequest['usingVM'] = $formVMRequest['usingVM'].", Operationnel";
        }
    }
    if (isset($formVMRequest['Test']))
    {
        if(!isset($formVMRequest['usingVM']))
        {
            $formVMRequest['usingVM'] = "Test";
        }
        else
        {
            $formVMRequest['usingVM'] = $formVMRequest['usingVM'].", Test";
        }
    }
    unset($formVMRequest['Academique']);
    unset($formVMRequest['RaD']);
    unset($formVMRequest['Operationnel']);
    unset($formVMRequest['Test']);

    if(isset($formVMRequest['domainEINET']))
    {
        $formVMRequest['domainEINET'] = 1;
    }
    else
    {
        $formVMRequest['domainEINET'] = 0;
    }

    $formVMRequest['inputVMName'] = strtoupper($formVMRequest['inputVMName']);

    if(addVMToDB($formVMRequest))
    {
        require_once 'model/mailSender.php';
        $vmFromDb = getVmNameAndIdByName($formVMRequest['inputVMName']);

        if(count($vmFromDb) > 2)
        {
            $_SESSION['formRequest'] = $formVMRequest;
            displayForm();
        }
        else
        {
            $requestMail = false;
            $adminMail = false;

            if(requestMail($_SESSION['userEmail'], $formVMRequest['inputVMName'], $formVMRequest['inputTMName'], $formVMRequest['inputRAName'], $formVMRequest))
            {
                $requestMail = true;
            }

            $link = "http://vmman.heig-vd.ch/index.php?action=detailsVM&id=". getIdOfVmByName($formVMRequest['inputVMName']);

            if(mailAdministrator($_SESSION['userEmail'], $formVMRequest['inputVMName'], $link, $formVMRequest))
            {
                $adminMail = true;
            }

            if($requestMail && $adminMail)
            {
                $_SESSION['$displayModalConfirm'] = true;
            }
            else
            {
                $_SESSION['displayModalConfirmationFailed'] = true;
            }
            displayHome();
        }
    }
    else
    {
        $_SESSION['displayModalRequestFailed'] = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }
}


/**
 * Check the datas's formAdmin VM order and, when all is correct, add the VM into the DB
 * and send a mail to the customer, the technical manager and the administrative manager.
 *
 * @param $formVMAdminRequest = The datas's form VM order (POST)
 */
function formVMAdmin($formVMAdminRequest)
{
    require_once 'model/vmManager.php';
    $_SESSION['$displayModalConfirm'] = false;
    $errorForm = false;
    $allVmName = getVmName();
    $nameResult = false;
    $name = false;

    foreach ($allVmName as $name)
    {
        $name['name'] = strtolower($name['name']);
        if($formVMAdminRequest['inputVMName'] == $name['name'])
        {
            $name = true;
            break;
        }
    }

    if($name){
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMAdminRequest;
        displayFormAdmin();
    }

    if($formVMAdminRequest['inputTMName'] == null || $formVMAdminRequest['inputRAName'] == null)
    {
        $errorForm = true;
        $_SESSION['displayModalNoUserSelected'] = true;
        $_SESSION['formRequest'] = $formVMAdminRequest;
        displayFormAdmin();
    }

    if(strlen($formVMAdminRequest['ti']) > 1000 || strlen($formVMAdminRequest['objective']) > 1000)
    {
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMAdminRequest;
        displayFormAdmin();
    }

    if($nameResult)
    {
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMAdminRequest;
        displayFormAdmin();
    }

    if(isset($formVMAdminRequest['inputEndDate']) && $formVMAdminRequest['inputEndDate'] != null || $formVMAdminRequest['inputEndDate'] != '')
    {
        $today = date('Y-m-d');
        $now = strtotime($today);
        if (strtotime($formVMAdminRequest['inputComissioningDate']) > strtotime($formVMAdminRequest['inputEndDate']) || strtotime($formVMAdminRequest['inputComissioningDate']) < $now)
        {
            $errorForm = true;
            $_SESSION['formRequest'] = $formVMAdminRequest;
            displayFormAdmin();
        }
    }
    else
    {
        $formVMAdminRequest['inputEndDate'] = null;
    }

    if($errorForm == true)
    {
        exit();
    }

    if(isset($formVMAdminRequest['Academique']))
    {
        $formVMAdminRequest['usingVM'] = "Academique";
    }
    if (isset($formVMAdminRequest['RaD']))
    {
        if(!isset($formVMAdminRequest['usingVM']))
        {
            $formVMAdminRequest['usingVM'] = "RaD";
        }
        else
        {
            $formVMAdminRequest['usingVM'] = $formVMAdminRequest['usingVM'].", RaD";
        }
    }
    if (isset($formVMAdminRequest['Operationnel']))
    {
        if(!isset($formVMAdminRequest['usingVM']))
        {
            $formVMAdminRequest['usingVM'] = "Operationnel";
        }
        else
        {
            $formVMAdminRequest['usingVM'] = $formVMAdminRequest['usingVM'].", Operationnel";
        }
    }
    if (isset($formVMAdminRequest['Test']))
    {
        if(!isset($formVMAdminRequest['usingVM']))
        {
            $formVMAdminRequest['usingVM'] = "Test";
        }
        else
        {
            $formVMAdminRequest['usingVM'] = $formVMAdminRequest['usingVM'].", Test";
        }
    }
    unset($formVMAdminRequest['Academique']);
    unset($formVMAdminRequest['RaD']);
    unset($formVMAdminRequest['Operationnel']);
    unset($formVMAdminRequest['Test']);

    if(isset($formVMAdminRequest['domainEINET']))
    {
        $formVMAdminRequest['domainEINET'] = 1;
    }
    else
    {
        $formVMAdminRequest['domainEINET'] = 0;
    }

    $formVMAdminRequest['inputVMName'] = strtoupper($formVMAdminRequest['inputVMName']);

    if(addVMToDB($formVMAdminRequest))
    {
        require_once 'model/mailSender.php';
        $vmFromDb = getVmNameAndIdByName($formVMAdminRequest['inputVMName']);

        if(count($vmFromDb) > 2)
        {
            $_SESSION['formRequest'] = $formVMAdminRequest;
            displayFormAdmin();
        }
        else
        {
            $_SESSION['$displayModalConfirm'] = true;
            displayHome();
        }
    }
    else
    {
        $_SESSION['displayModalRequestFailed'] = true;
        $_SESSION['formRequest'] = $formVMAdminRequest;
        displayFormAdmin();
    }
}