<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the admin view
 */

function displayAllVM()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                $_GET['action'] = "home";
                require 'view/home.php';
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
    else
    {
        require_once 'model/vmManager.php';
        $allVM = getAllVM();
        $_GET['action'] = "allVM";
        require 'view/allVM.php';

        /*$_GET['action'] = "signIn";
        require 'view/signIn.php';*/
    }
}

function displayFormManagement()
{
    require_once 'model/displayManager.php';
    $entityNames = displayBDD_Entity();
    $osNames = displayBDD_OS();
    $snapshotPolicy = displayBSS_Snapshots();
    $backupPolicy = displayBSS_Backup();

    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 0:
                $_GET['action'] = "home";
                require 'view/home.php';
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

