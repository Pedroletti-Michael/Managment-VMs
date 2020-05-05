<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * Description : Contains all functions related to the admin view
 */

function displayAllVM($searchFilter,$vmFilter = "all")
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        if(isset($vmFilter['vmFilter']) && $vmFilter['vmFilter'] != null)
        {
            switch ($_SESSION['userType'])
            {
                case 0:
                    require_once 'controler/user.php';
                    displayHome();
                    break;
                case 1:
                    require_once 'model/vmManager.php';

                    if($vmFilter['vmFilter'] == "all")
                    {
                        $checkFilter = "all";
                        $allVM = getAllVM();
                    }
                    elseif($vmFilter['vmFilter'] == "confirmed")
                    {
                        $checkFilter = "confirmed";
                        $allVM = getValidatedVM();
                    }
                    elseif($vmFilter['vmFilter'] == "confirmation")
                    {
                        $checkFilter = "confirmation";
                        $allVM = getConfirmationVM();
                    }
                    elseif($vmFilter['vmFilter'] == "renewal")
                    {
                        $checkFilter = "renewal";
                        $allVM = getRenewalVM();
                    }
                    elseif($vmFilter['vmFilter'] == "deleted")
                    {
                        $checkFilter = "deleted";
                        $allVM = getDeletedOrUnrenewalVM();
                    }

                    $_GET['action'] = "allVM";
                    require 'view/allVM.php';
                    break;
                default:
                    $_GET['action'] = "signIn";
                    require 'view/signIn.php';
                    break;
            }
        }
        else
        {
            switch ($_SESSION['userType'])
            {
                case 0:
                    displayHome();
                    break;
                case 1:
                    require_once 'model/vmManager.php';
                    $allVM = getAllVM();
                    $_GET['action'] = "allVM";
                    require 'view/allVM.php';
                    break;
                default:
                    $_GET['action'] = "signIn";
                    require 'view/signIn.php';
                    break;
            }
        }
    }
    else
    {
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function displayConfirmationVM()
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                displayHome();
                break;
            case 1:
                require_once 'model/vmManager.php';
                $confirmationVM = getConfirmationVM();
                $_GET['action'] = "confirmationVM";
                require 'view/confirmationVM.php';
                break;
            default:
                $_GET['action'] = "signIn";
                require 'view/signIn.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function displayRenewalVM()
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                require_once 'model/vmManager.php';
                $userId = $_SESSION['userId'];
                getRenewFromAUser($userId);
                require 'view/renewalVM.php';
                break;
            case 1:
                require_once 'model/vmManager.php';
                $renewalVM = getRenewalVM();
                $_GET['action'] = "renewalVM";
                require 'view/renewalVM.php';
                break;
            default:
                $_GET['action'] = "signIn";
                require 'view/signIn.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function displayDetailsVM($idVM)
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                require_once 'model/vmManager.php';
                require_once 'model/displayManager.php';
                $dataVM = getDataVM($idVM);

                if($_SESSION['userEmail'] == $dataVM[0]['customer'])
                {
                    $entityNames = displayBDD_Entity();
                    $osNames = displayBDD_OS();
                    $windowsData = displayBDD_OSNameWhereWindows();
                    $linuxData = displayBDD_OSNameWhereLinux();
                    $snapshotPolicy = displayBSS_Snapshots();
                    $backupPolicy = displayBSS_Backup();

                    require_once 'model/userManager.php';
                    $users = getAllUsers();

                    $_SESSION['idVM'] = $idVM;

                    $_GET['action'] = "detailsVM";
                    require 'view/detailsVM.php';
                }
                else
                {
                    displayHome();
                }
                break;
            case 1:
                require_once 'model/displayManager.php';
                $entityNames = displayBDD_Entity();
                $osNames = displayBDD_OS();
                $snapshotPolicy = displayBSS_Snapshots();
                $backupPolicy = displayBSS_Backup();

                require_once 'model/userManager.php';
                $users = getAllUsers();

                require_once 'model/vmManager.php';
                $dataVM = getDataVM($idVM);
                $vms = getAllVmNameAndId();

                $_SESSION['idVM'] = $idVM;

                $_GET['action'] = "detailsVM";
                require 'view/detailsVM.php';
                break;
            default:
                $_GET['action'] = "signIn";
                require 'view/signIn.php';
                break;
        }
    }
    else
    {
        $_SESSION['idVM'] = $idVM;
        $_SESSION['actionUser'] = "detailsVM";
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function updateVM($vmInformation)
{
    require_once "model/vmManager.php";

    if (strtotime($vmInformation['inputComissioningDate']) > strtotime($vmInformation['inputEndDate']))
    {
        if($_SESSION['userType'] == 0)
        {
            displayHome();
        }
        elseif($_SESSION['userType'] == 1)
        {
            $allVM = getAllVM();
            $_GET['action'] = "allVM";
            require 'view/allVM.php';
        }
        else
        {
            $_GET['action'] = "signIn";
            require 'view/signIn.php';
        }
    }

    if(isset($vmInformation['Academique']))
    {
        $vmInformation['usingVM'] = "Academique";
    }
    if (isset($vmInformation['RaD']))
    {
        if(!isset($vmInformation['usingVM']))
        {
            $vmInformation['usingVM'] = "RaD";
        }
        else
        {
            $vmInformation['usingVM'] = $vmInformation['usingVM'].", RaD";
        }
    }
    if (isset($vmInformation['Operationnel']))
    {
        if(!isset($vmInformation['usingVM']))
        {
            $vmInformation['usingVM'] = "Operationnel";
        }
        else
        {
            $vmInformation['usingVM'] = $vmInformation['usingVM'].", Operationnel";
        }
    }
    if (isset($vmInformation['Test']))
    {
        if(!isset($vmInformation['usingVM']))
        {
            $vmInformation['usingVM'] = "Test";
        }
        else
        {
            $vmInformation['usingVM'] = $vmInformation['usingVM'].", Test";
        }
    }

    unset($vmInformation['Academique']);
    unset($vmInformation['RaD']);
    unset($vmInformation['Operationnel']);
    unset($vmInformation['Test']);

    if(isset($vmInformation['domainEINET']))
    {
        $vmInformation['domainEINET'] = 1;
    }
    else
    {
        $vmInformation['domainEINET'] = 0;
    }

    if($vmInformation['securityFormControlSelect'] == "OS mis à jour par le responsable technique")
    {
        $vmInformation['securityFormControlSelect'] = 1;
    }
    elseif($vmInformation['securityFormControlSelect'] == "OS mis à jour par le SI (update automatiques)")
    {
        $vmInformation['securityFormControlSelect'] = 0;
    }

    if($vmInformation['editDateAnniversary'] == "" || $vmInformation['editDateAnniversary'] == " ")
    {
        $vmInformation['editDateAnniversary'] = 0000-00-00;
    }
    elseif($vmInformation['editCriticity'] == "" || $vmInformation['editCriticity'] == " ")
    {
        $vmInformation['editCriticity'] = 0;
    }

    if(updateVMInformation($vmInformation, $_SESSION['idVM']))
    {
        if($_SESSION['userType'] == 0)
        {
            displayHome();
        }
        elseif($_SESSION['userType'] == 1)
        {
            $allVM = getAllVM();
            $_GET['action'] = "allVM";
            require 'view/allVM.php';
        }
        else
        {
            $_GET['action'] = "signIn";
            require 'view/signIn.php';
        }
    }
    else
    {
        if($_SESSION['userType'] == 0)
        {
            displayHome();
        }
        elseif($_SESSION['userType'] == 1)
        {
            $allVM = getAllVM();
            $_GET['action'] = "allVM";
            require 'view/allVM.php';
        }
        else
        {
            $_GET['action'] = "signIn";
            require 'view/signIn.php';
        }
    }
}

function vmAccepted()
{
    $vmStatus = true;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus))
    {
        displayAllVM("","");
    }
    else
    {
        displayDetailsVM($_SESSION['idVM']);
    }
}

function vmRefused()
{
    $vmStatus = false;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus))
    {
        displayAllVM("");
    }
    else
    {
        displayDetailsVM($_SESSION['idVM']);
    }
}

function renewwalAccepted()
{
    $vmStatus = false;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus))
    {
        displayAllVM("");
    }
    else
    {
        displayDetailsVM($_SESSION['idVM']);
    }
}

function renewwalRefused()
{
    $vmStatus = false;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus))
    {
        displayAllVM("");
    }
    else
    {
        displayDetailsVM($_SESSION['idVM']);
    }
}

function displayFormManagement($arrayToDisplay)
{
    require_once 'model/displayManager.php';
    $entityNames = displayBDD_Entity();
    $osNames = displayBDD_OS();
    $snapshotPolicy = displayBSS_Snapshots();
    $backupPolicy = displayBSS_Backup();

    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                require_once 'controler/user.php';
                displayHome();
                break;
            case 1:
                $_GET['action'] = "formManagement";
                require 'view/formManagement.php';
                break;
            default:
                $_GET['action'] = "signIn";
                require 'view/signIn.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function editEntity($entityName){
    require_once 'model/displayManager.php';
    if(isset($entityName['add'])){
        if(isset($entityName['txtEntityAdd']) && $entityName['txtEntityAdd'] != null)
        {
            $nameEntity = $entityName['txtEntityAdd'];
            addEntity($nameEntity);
        }
    }
    if(isset($entityName['delete'])){
        if(isset($entityName['valueEntityDel']) && $entityName['valueEntityDel'] != null)
        {
            $nameEntity = $entityName['valueEntityDel'];
            deleteEntity($nameEntity);
        }
    }
    if(isset($entityName['modify'])){
        if(isset($entityName['valueEntityMod']) && $entityName['valueEntityMod'] != null && isset($entityName['txtEntityMod']) && $entityName['txtEntityMod'] != null)
        {
            $nameEntity = $entityName['valueEntityMod'];
            $newName = $entityName['txtEntityMod'];
            modifyEntity($nameEntity,$newName);
        }
    }
    displayFormManagement();
}

function editOS($osName){
    require_once 'model/displayManager.php';
    if(isset($osName['add'])){
        if(isset($osName['txtOSAdd']) && $osName['txtOSAdd'] != null && isset($osName['typeOSAdd']) && $osName['typeOSAdd'] != null)
        {
            $nameOS = $osName['txtOSAdd'];
            $typeOS = $osName['typeOSAdd'];
            addOS($nameOS,$typeOS);
        }
    }
    elseif(isset($osName['delete'])){
        if(isset($osName['valueOSDel']) && $osName['valueOSDel'] != null)
        {
            $nameOS = $osName['valueOSDel'];
            $length = strlen($nameOS);
            $textOs = "";

            for($count = 0; $count < $length; $count++)
            {
                if($nameOS[$count] !== " ")
                {
                }
                else
                {
                    for($count += 1; $count < $length; $count++)
                    {
                        $textOs = "$textOs"."$nameOS[$count]";
                    }
                    break;
                }
            }
            deleteOS($textOs);
        }
    }
    elseif(isset($osName['modify'])){
        if(isset($osName['valueOSMod']) && $osName['valueOSMod'] != null && isset($osName['txtOSMod']) && $osName['txtOSMod'] != null && isset($osName['typeOSMod']) && $osName['typeOSMod'] != null)
        {
            $nameOS = $osName['valueOSMod'];
            $newName = $osName['txtOSMod'];
            $newType = $osName['typeOSMod'];
            $textOs = "";
            $length = strlen($nameOS);

            for($count = 0; $count < $length; $count++)
            {
                if($nameOS[$count] !== " ")
                {
                }
                else
                {
                    for($count += 1; $count < $length; $count++)
                    {
                        $textOs = "$textOs"."$nameOS[$count]";
                    }
                    break;
                }
            }
            modifyOS($textOs,$newName,$newType);
        }
    }
    displayFormManagement();
}

function editSnapshots($snapshotsName){
    require_once 'model/displayManager.php';
    if(isset($snapshotsName['add'])){
        if(isset($snapshotsName['typeSnapAdd']) && $snapshotsName['typeSnapAdd'] != null && isset($snapshotsName['txtSnapAdd']) && $snapshotsName['txtSnapAdd'] != null)
        {
            $typeSnapshots= $snapshotsName['typeSnapAdd'];
            $policySnapshots = $snapshotsName['txtSnapAdd'];
            addSnapshots($typeSnapshots,$policySnapshots);
        }
    }
    elseif(isset($snapshotsName['delete'])){
        if(isset($snapshotsName['valueSnapDel']) && $snapshotsName['valueSnapDel'] != null)
        {
            $nameSnapshots = $snapshotsName['valueSnapDel'];
            $typeSnapshots = "";
            $length = strlen($nameSnapshots);

            for($count = 0; $count < $length; $count++)
            {
                if($nameSnapshots[$count] !== " ")
                {
                    $typeSnapshots = "$typeSnapshots"."$nameSnapshots[$count]";
                }
                else
                {
                    break;
                }
            }
            deleteSnapshots($typeSnapshots);
        }
    }
    elseif(isset($snapshotsName['modify'])){
        if(isset($snapshotsName['valueSnapMod']) && $snapshotsName['valueSnapMod'] != null && isset($snapshotsName['txtSnapMod']) && $snapshotsName['txtSnapMod'] != null && isset($snapshotsName['typeSnapMod']) && $snapshotsName['typeSnapMod'] != null)
        {
            $nameSnapshots = $snapshotsName['valueSnapMod'];
            $newPolicy = $snapshotsName['txtSnapMod'];
            $newType = $snapshotsName['typeSnapMod'];
            $typeSnapshots = "";
            $length = strlen($nameSnapshots);

            for($count = 0; $count < $length; $count++)
            {
                if($nameSnapshots[$count] !== " ")
                {
                    $typeSnapshots = "$typeSnapshots"."$nameSnapshots[$count]";
                }
                else
                {
                    break;
                }
            }
            modifySnapshots($typeSnapshots,$newPolicy,$newType);
        }
    }
    displayFormManagement();
}

function editBackup($backupName){
    require_once 'model/displayManager.php';
    if(isset($backupName['add'])){
        if(isset($backupName['typeBackupAdd']) && $backupName['typeBackupAdd'] != null && isset($backupName['txtBackupAdd']) && $backupName['txtBackupAdd'] != null)
        {
            $typeBackup= $backupName['typeBackupAdd'];
            $policyBackup = $backupName['txtBackupAdd'];
            addBackup($typeBackup,$policyBackup);
        }
    }
    elseif(isset($backupName['delete'])){
        if(isset($backupName['valueBackupDel']) && $backupName['valueBackupDel'] != null)
        {
            $nameBackup = $backupName['valueBackupDel'];
            $typeBackup = "";
            $length = strlen($nameBackup);

            for($count = 0; $count < $length; $count++)
            {
                if($nameBackup[$count] !== " ")
                {
                    $typeBackup = "$typeBackup"."$nameBackup[$count]";
                }
                else
                {
                    break;
                }
            }
            deleteBackup($typeBackup);
        }
    }
    elseif(isset($backupName['modify'])){
        if(isset($backupName['valueBackupMod']) && $backupName['valueBackupMod'] != null && isset($backupName['txtBackupMod']) && $backupName['txtBackupMod'] != null &&isset($backupName['typeBackupMod']) && $backupName['typeBackupMod'] != null)
        {
            $nameBackup = $backupName['valueBackupMod'];
            $newPolicy = $backupName['txtBackupMod'];
            $newType = $backupName['typeBackupMod'];
            $typeBackup = "";
            $length = strlen($nameBackup);

            for($count = 0; $count < $length; $count++)
            {
                if($nameBackup[$count] !== " ")
                {
                    $typeBackup = "$typeBackup"."$nameBackup[$count]";
                }
                else
                {
                    break;
                }
            }
            modifyBackup($typeBackup,$newPolicy,$newType);
        }
    }
    displayFormManagement();
}

function displayResearch($inputResearch){
    require_once 'model/vmManager.php';
    require_once 'model/dbConnector.php';
    $researchResult = researchVm($inputResearch);

    //display searchResultView
    require 'view/searchResult.php';
}

function modifyStatusAfterRenewal($idVM, $status){
    if($status){
        $vmStatus = 2;
    }
    else{
        $vmStatus = 4;
    }

    require_once "model/vmManager.php";

    if(updateStatusVM($idVM['id'], $vmStatus))
    {
        displayAllVM("");
    }
    else
    {
        displayDetailsVM($idVM['id']);
    }
}