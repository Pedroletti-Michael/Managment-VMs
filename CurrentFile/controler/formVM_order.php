<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 17.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the formVM_order
 **/

function displayForm()
{
    require_once 'model/displayManager.php';
    $entityNames = displayBDD_Entity();
    $osNames = displayBDD_OS();
    $snapshotPolicy = displayBSS_Snapshots();
    $backupPolicy = displayBSS_Backup();

    $_GET['action'] = "form";
    require 'view/form.php';
}


function formVM($formVMRequest)
{
    if(isset($formVMRequest['Academique']))
    {
        $formVMRequest['usingVM'] = $formVMRequest['Academique'];

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }
    elseif (isset($formVMRequest['RaD']))
    {
        $formVMRequest['usingVM'] = $formVMRequest['RaD'];

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }
    elseif (isset($formVMRequest['Operationnel']))
    {
        $formVMRequest['usingVM'] = $formVMRequest['Operationnel'];

        unset($formVMRequest['RaD']);
        unset($formVMRequest['Operationnel']);
        unset($formVMRequest['Academique']);
    }

    foreach ($formVMRequest as $field)
    {
        if(!isset($formVMRequest[$field]))
        {
            $_GET['action'] = "form";
            require "view/form.php";
        }
    }

    require_once 'model/vmManager.php';

    if(addVMToDB($formVMRequest))
    {
        $_GET['action'] = "home";
        require "view/home.php";
    }
    else
    {
        $_GET['action'] = "form";
        require "view/form.php";
    }
}
