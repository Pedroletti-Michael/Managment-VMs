<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the admin view
 */

function displayAllVM($searchFilter)
{
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        if(isset($searchFilter['vmFilter']) && $searchFilter['vmFilter'] != null)
        {
            switch ($_SESSION['userType'])
            {
                case 0:
                    require_once 'controler/user.php';
                    displayHome();
                    break;
                case 1:
                    require_once 'model/vmManager.php';

                    if($searchFilter['vmFilter'] == "Toutes les vm")
                    {
                        $checkFilter = 0;
                        $allVM = getAllVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM confirmées")
                    {
                        $checkFilter = 1;
                        $allVM = getValidatedVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM à confirmer")
                    {
                        $checkFilter = 2;
                        $allVM = getConfirmationVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM à renouveler")
                    {
                        $checkFilter = 3;
                        $allVM = getVmToRenew();
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
                    require_once 'controler/user.php';
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
                require_once 'controler/user.php';
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

function displayDetailsVM($idVM)
{
    require_once 'model/displayManager.php';
    $entityNames = displayBDD_Entity();
    $osNames = displayBDD_OS();
    $snapshotPolicy = displayBSS_Snapshots();
    $backupPolicy = displayBSS_Backup();

    require_once 'model/vmManager.php';
    $dataVM = getDataVM($idVM);

    $_GET['action'] = "detailsVM";
    require 'view/detailsVM.php';
}

function updateVM($vmInformation)
{
    if(isset($formVMRequest['Academique']))
    {
        $formVMRequest['usingVM'] = "Academique";

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }
    elseif (isset($formVMRequest['RaD']))
    {
        $formVMRequest['usingVM'] = "RaD";

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }
    elseif (isset($formVMRequest['Operationnel']))
    {
        $formVMRequest['usingVM'] = "Operationnel";

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }

    if(isset($formVMRequest['domainEINET']))
    {
        $formVMRequest['domainEINET'] = 1;
    }
    else
    {
        $formVMRequest['domainEINET'] = 0;
    }
    
    require_once 'model/vmManager.php';

    if(updateVMInformation($vmInformation))
    {
        $allVM = getAllVM();
        $_GET['action'] = "allVM";
        require 'view/allVM.php';
    }
    else
    {
        $confirmationVM = getConfirmationVM();
        $_GET['action'] = "confirmationVM";
        require 'view/confirmationVM.php';
    }
}

function displayFormManagement()
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
    if($entityName['add']){
        $nameEntity = $entityName['txt'];
        addEntity($nameEntity);
    }
    if($entityName['delete']){
        $nameEntity = $entityName['value'];
        deleteEntity($nameEntity);
    }
    displayFormManagement();
}

function editOS($osName){
    require_once 'model/displayManager.php';
    if($osName['add']){
        $nameOS = $osName['txt'];
        $typeOS = $osName['type'];
        addOS($nameOS,$typeOS);
    }
    displayFormManagement();
}

function editSnapshots($snapshotsName){
    require_once 'model/displayManager.php';
    if($snapshotsName['add']){
        $nameSnapshots = $snapshotsName['txt'];
        addSnapshots($nameSnapshots);
    }
    displayFormManagement();
}

function editBackup($backupName){
    require_once 'model/displayManager.php';
    if($backupName['add']){
        $nameBackup = $backupName['txt'];
        addBackup($nameBackup);
    }
    displayFormManagement();
}

