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

function formVM($formVMRequest)
{
    if (strtotime($formVMRequest['inputComissioningDate']) > strtotime($formVMRequest['inputEndDate']))
    {
        displayForm();
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

    require_once 'model/vmManager.php';

    if(addVMToDB($formVMRequest))
    {
        require_once 'model/mailSender.php';

        requestMail($_SESSION['userEmail'], $formVMRequest['inputVMName'], $formVMRequest['inputTMName'], $formVMRequest['inputRAName']);
        $link = "http://vmman.heig-vd.ch/index.php?action=detailsVM&id=". getIdOfVmByName($formVMRequest['inputVMName']);
        mailAdministrator($_SESSION['userEmail'], $formVMRequest['inputVMName'], $link);
        displayHome();
    }
    else
    {
        displayForm();
    }
}