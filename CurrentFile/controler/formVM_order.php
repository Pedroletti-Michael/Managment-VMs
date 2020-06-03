<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 17.03.2020
 * Description : Contains all functions related to the formVM_order
 **/

function displayForm()
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

        require_once 'model/vmManager.php';
        $namesValue = getVmName();
        $allVmName = array();
        foreach ($namesValue as $value){
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
        foreach ($namesValue as $value){
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

function formVM($formVMRequest)
{
    require_once 'model/vmManager.php';
    $_SESSION['$displayModalConfirm'] = false;
    $errorForm = false;
    $allVmName = getVmName();
    $nameResult = false;

    foreach ($allVmName as $name){
        if($formVMRequest['inputVMName'] == $name){
            $name = true;
        }
    }

    if($formVMRequest['inputTMName'] == null || $formVMRequest['inputRAName'] == null)
    {
        $errorForm = true;
        $_SESSION['displayModalNoUserSelected'] = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if(strlen($formVMRequest['ti']) > 1000 || strlen($formVMRequest['objective']) > 1000){
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if($nameResult){
        $errorForm = true;
        $_SESSION['formRequest'] = $formVMRequest;
        displayForm();
    }

    if(isset($formVMRequest['inputEndDate']) && $formVMRequest['inputEndDate'] != null || $formVMRequest['inputEndDate'] != ''){
        if (strtotime($formVMRequest['inputComissioningDate']) > strtotime($formVMRequest['inputEndDate']) || strtotime($formVMRequest['inputComissioningDate']) < strtotime('now'))
        {
            $errorForm = true;
            $_SESSION['formRequest'] = $formVMRequest;
            displayForm();
        }
    }
    else{
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
            if(requestMail($_SESSION['userEmail'], $formVMRequest['inputVMName'], $formVMRequest['inputTMName'], $formVMRequest['inputRAName'])){
                $requestMail = true;
            }
            $link = "http://vmman.heig-vd.ch/index.php?action=detailsVM&id=". getIdOfVmByName($formVMRequest['inputVMName']);
            if(mailAdministrator($_SESSION['userEmail'], $formVMRequest['inputVMName'], $link)){
                $adminMail = true;
            }


            if($requestMail && $adminMail){
                $_SESSION['$displayModalConfirm'] = true;
            }
            else{
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