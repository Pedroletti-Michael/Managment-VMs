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
        $formVMRequest['domainEINET'] = "true";
    }
    else
    {
        $formVMRequest['domainEINET'] = "false";
    }

    foreach ($formVMRequest as $field)
    {
        if(!isset($field))
        {
            $_GET['action'] = "form";
            require "view/form.php";
            break;
        }
    }

    require_once 'model/vmManager.php';

    if(addVMToDB($formVMRequest))
    {
        require_once 'model/mailSender';

        if (requestMail($formVMRequest['inputResquesterName'], $formVMRequest['inputVMName'])){
            echo "<script>alert('success!');</script>";
        }
        else{
            echo "<script>alert('failure!');</script>";
        }

        $_GET['action'] = "home";
        require "view/home.php";
    }
    else
    {
        $_GET['action'] = "form";
        require "view/form.php";
    }
}
