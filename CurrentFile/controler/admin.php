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
                        $checkFilter = "Toutes les vm";
                        $allVM = getAllVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM confirmées")
                    {
                        $checkFilter = "VM confirmées";
                        $allVM = getValidatedVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM à confirmer")
                    {
                        $checkFilter = "VM à confirmer";
                        $allVM = getConfirmationVM();
                    }
                    elseif($searchFilter['vmFilter'] == "VM à renouveler")
                    {
                        $checkFilter = "VM à renouveler";
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
                    $snapshotPolicy = displayBSS_Snapshots();
                    $backupPolicy = displayBSS_Backup();

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

                require_once 'model/vmManager.php';
                $dataVM = getDataVM($idVM);

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
        $_SESSION['actionUser'] = "detailsVM";
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function updateVM($vmInformation)
{
    if(isset($vmInformation['Academique']))
    {
        $vmInformation['usingVM'] = "Academique";

        unset($vmInformation['RaD']);
        unset($vmInformation['Operationnel']);
        unset($vmInformation['Academique']);
    }
    elseif (isset($vmInformation['RaD']))
    {
        $vmInformation['usingVM'] = "RaD";

        unset($vmInformation['RaD']);
        unset($vmInformation['Operationnel']);
        unset($vmInformation['Academique']);
    }
    elseif (isset($vmInformation['Operationnel']))
    {
        $vmInformation['usingVM'] = "Operationnel";

        unset($vmInformation['RaD']);
        unset($vmInformation['Operationnel']);
        unset($vmInformation['Academique']);
    }

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
    
    require_once 'model/vmManager.php';

    if(updateVMInformation($vmInformation, $_SESSION['idVM']))
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

function vmAccepted()
{
    $vmStatus = true;

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
    if(isset($entityName['add'])){
        $nameEntity = $entityName['txt'];
        addEntity($nameEntity);
    }
    if(isset($entityName['delete'])){
        $nameEntity = $entityName['value'];
        deleteEntity($nameEntity);
    }
    if(isset($entityName['modify'])){
        $nameEntity = $entityName['value'];
        $newName = $entityName['txt'];
        modifyEntity($nameEntity,$newName);
    }
    displayFormManagement();
}

function editOS($osName){
    require_once 'model/displayManager.php';
    if(isset($osName['add'])){
        $nameOS = $osName['txt'];
        $typeOS = $osName['type'];
        addOS($nameOS,$typeOS);
    }
    if(isset($osName['delete'])){
        $nameOS = $osName['value'];
        deleteOS($nameOS);
    }
    if(isset($osName['modify'])){
        $nameOS = $osName['value'];
        $newName = $osName['txt'];
        $newType = $osName['type'];
        modifyOS($nameOS,$newName,$newType);
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

