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
                case 2:
                case 1:
                    require_once 'model/vmManager.php';
                    $allVmName = getAllVmNameAndId();

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
                case 2:
                case 1:
                    require_once 'model/vmManager.php';
                    require_once 'model/dbConnector.php';

                    $allValidatedVM = getValidatedVM();
                    $allConfirmationVM = getConfirmationVM();
                    $allRenewalVM = getRenewalVM();
                    $allDeletedVM = getDeletedOrUnrenewalVM();
                    $allVM = getAllVM();
                    $allVmName = getAllVmNameAndId();

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
            case 2:
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
            case 2:
            case 0:
                require_once 'model/vmManager.php';
                $userId = $_SESSION['userId'];
                $renewalVM = getUserRenewalVM($userId);
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
                $namesValue = getVmName();
                $allVmName = array();
                foreach ($namesValue as $value){
                    array_push($allVmName, $value[0]);
                }
                require_once 'model/displayManager.php';
                $dataVM = getDataVM($idVM);

                if($_SESSION['userEmail'] == $dataVM[0]['customer'] || $_SESSION['userEmail'] == $dataVM[0]['userRt'] || $_SESSION['userEmail'] == $dataVM[0]['userRa'])
                {
                    $entityNames = displayBDD_Entity();
                    $osNames = displayBDD_OS();
                    $windowsData = displayBDD_OSNameWhereWindows();
                    $linuxData = displayBDD_OSNameWhereLinux();
                    $snapshotPolicy = displayBSS_Snapshots();
                    $backupPolicy = displayBSS_Backup();
                    $clusterData = getClusters();

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
                $clusterData = getClusters();

                require_once 'model/userManager.php';
                $users = getAllUsers();

                require_once 'model/vmManager.php';
                $namesValue = getVmName();
                $allVmName = array();
                foreach ($namesValue as $value){
                    array_push($allVmName, $value[0]);
                }
                $dataVM = getDataVM($idVM);
                $vms = getAllVmNameAndId();

                $_SESSION['idVM'] = $idVM;

                $_GET['action'] = "detailsVM";
                require 'view/detailsVM.php';
                break;
            case 2:
                require_once 'model/vmManager.php';
                $namesValue = getVmName();
                $allVmName = array();
                foreach ($namesValue as $value){
                    array_push($allVmName, $value[0]);
                }
                require_once 'model/displayManager.php';
                $dataVM = getDataVM($idVM);

                $entityNames = displayBDD_Entity();
                $osNames = displayBDD_OS();
                $windowsData = displayBDD_OSNameWhereWindows();
                $linuxData = displayBDD_OSNameWhereLinux();
                $snapshotPolicy = displayBSS_Snapshots();
                $backupPolicy = displayBSS_Backup();
                $clusterData = getClusters();

                require_once 'model/userManager.php';
                $users = getAllUsers();

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
    $_SESSION['displayModalConfirm'] = false;

    if($vmInformation['inputEndDate'] != "")
    {
        if (strtotime($vmInformation['inputComissioningDate']) > strtotime($vmInformation['inputEndDate']))
        {
            if (strtotime($vmInformation['inputComissioningDate']) > strtotime($vmInformation['inputEndDate']) || strtotime($vmInformation['inputComissioningDate']) < strtotime('now'))
            {
                if ($_SESSION['userType'] == 0) {
                    displayHome();
                } elseif ($_SESSION['userType'] == 1) {
                    $allVM = getAllVM();
                    $_GET['action'] = "allVM";
                    require 'view/allVM.php';
                } else {
                    $_GET['action'] = "signIn";
                    require 'view/signIn.php';
                }
            }
        }
    }


    if(strlen($vmInformation['ti']) > 1000 || strlen($vmInformation['objective']) > 1000){
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

    if($vmInformation['securityFormControlSelect'] == "Mises à jour installées par le responsable technique")
    {
        $vmInformation['securityFormControlSelect'] = 1;
    }
    elseif($vmInformation['securityFormControlSelect'] == "Mises à jour installées par le S-ISI de manière automatique")
    {
        $vmInformation['securityFormControlSelect'] = 0;
    }

    if($vmInformation['editCriticity'] == "" || $vmInformation['editCriticity'] == " ")
    {
        $vmInformation['editCriticity'] = 0;
    }

    $vmInformation['inputVMName'] = strtoupper($vmInformation['inputVMName']);

    if(updateVMInformation($vmInformation, $_SESSION['idVM']))
    {
        if($_SESSION['userType'] == 0)
        {
            displayHome();
        }
        elseif($_SESSION['userType'] == 1)
        {
            $_SESSION['displayModalConfirm'] = true;
            displayAllVM("","");
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

function vmAccepted($vmInformation)
{
    $vmStatus = true;
    $_SESSION['displayModalConfirm'] = false;

    require_once "model/vmManager.php";

    if($vmInformation['inputEndDate'] != "")
    {
        if (strtotime($vmInformation['inputComissioningDate']) > strtotime($vmInformation['inputEndDate']))
        {
            if (strtotime($vmInformation['inputComissioningDate']) > strtotime($vmInformation['inputEndDate']) || strtotime($vmInformation['inputComissioningDate']) < strtotime('now'))
            {
                if ($_SESSION['userType'] == 0) {
                    displayHome();
                } elseif ($_SESSION['userType'] == 1) {
                    $allVM = getAllVM();
                    $_GET['action'] = "allVM";
                    require 'view/allVM.php';
                } else {
                    $_GET['action'] = "signIn";
                    require 'view/signIn.php';
                }
            }
        }
    }

    if(strlen($vmInformation['ti']) > 1000 || strlen($vmInformation['objective']) > 1000){
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

    if($vmInformation['securityFormControlSelect'] == "Mises à jour installées par le responsable technique")
    {
        $vmInformation['securityFormControlSelect'] = 1;
    }
    elseif($vmInformation['securityFormControlSelect'] == "Mises à jour installées par le S-ISI de manière automatique")
    {
        $vmInformation['securityFormControlSelect'] = 0;
    }
    else{
        $vmInformation['securityFormControlSelect'] = 0;
    }

    if($vmInformation['editCriticity'] == "" || $vmInformation['editCriticity'] == " ")
    {
        $vmInformation['editCriticity'] = 0;
    }

    if(updateStatusVM($_SESSION['idVM'], $vmStatus, null, $vmInformation) == 2 && updateVMInformation($vmInformation, $_SESSION['idVM'])){
        $_SESSION['displayModalConfirm'] = true;
        displayAllVM("","");
    }
    elseif(updateStatusVM($_SESSION['idVM'], $vmStatus, null, $vmInformation) == 1 && updateVMInformation($vmInformation, $_SESSION['idVM'])){
        $_SESSION['displayModalErrorMail'] = true;
        displayAllVM("","");
    }
    else{
        $_SESSION['displayErrorModification'] = true;
        displayDetailsVM($_SESSION['idVM']);
    }
}

function vmRefused($reason = null)
{
    $vmStatus = false;

    if($reason == null){
        $reason = 'Nous ne pouvons malheureusement pas accéder à votre requête pour le moment.';
    }

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus, $reason) == 2){
        $_SESSION['$displayModalConfirm'] = true;
        displayAllVM("");
    }
    elseif(updateStatusVM($_SESSION['idVM'], $vmStatus, $reason) == 1){
        $_SESSION['displayModalErrorMail'] = true;
        displayAllVM("");
    }
    else{
        $_SESSION['displayErrorModification'] = true;
        displayDetailsVM($_SESSION['idVM']);
    }
}

function renewwalAccepted()
{
    $vmStatus = false;
    $_SESSION['$displayModalConfirm'] = false;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus) == 2){
        $_SESSION['$displayModalConfirm'] = true;
        displayAllVM("");
    }
    elseif(updateStatusVM($_SESSION['idVM'], $vmStatus) == 1){
        $_SESSION['displayModalErrorMail'] = true;
        displayAllVM("");
    }
    else{
        $_SESSION['displayErrorModification'] = true;
        displayDetailsVM($_SESSION['idVM']);
    }
}

function renewwalRefused()
{
    $vmStatus = false;

    require_once "model/vmManager.php";

    if(updateStatusVM($_SESSION['idVM'], $vmStatus) == 2){
        $_SESSION['$displayModalConfirm'] = true;
        displayAllVM("");
    }
    elseif(updateStatusVM($_SESSION['idVM'], $vmStatus) == 1){
        $_SESSION['displayModalErrorMail'] = true;
        displayAllVM("");
    }
    else{
        $_SESSION['displayErrorModification'] = true;
        displayDetailsVM($_SESSION['idVM']);
    }
}

function displayFormManagement($arrayToDisplay)
{
    require_once 'model/displayManager.php';
    $_SESSION['gestionFormArray'] = $arrayToDisplay;
    $brutEntityNames = displayBDD_Entity();
    $entityNames = array();
    foreach($brutEntityNames as $value){
        if($value['status'] == 0){
            array_push($entityNames, $value['entityName']);
        }
    }

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
    $arrayToDisplay = $_SESSION['gestionFormArray'];
    $isEntityAssociated = false;
    require_once 'model/displayManager.php';

    if(isset($entityName['add'])){
        if(isset($entityName['txtEntityAdd']) && $entityName['txtEntityAdd'] != null)
        {
            $nameEntity = $entityName['txtEntityAdd'];
            addEntity($nameEntity);
        }
    }
    if(isset($entityName['delete'])){
        if(isset($entityName['valueEntityToDelete']) && $entityName['valueEntityToDelete'] != null)
        {
            $nameEntity = $entityName['valueEntityToDelete'];
            $entitiesAssociatedToVM = getEntityAssociateToVM();
            $idEntity = getIdEntity($nameEntity);

            foreach($entitiesAssociatedToVM as $entityAssiociatedToVM)
            {
                if($idEntity[0]['entity_id'] == $entityAssiociatedToVM['entity_id'])
                {
                    $isEntityAssociated = true;
                }
                else
                {
                    $isEntityAssociated = false;
                }
            }

            if($isEntityAssociated == true)
            {
                $_SESSION['displayModalEntityAssociated'] = true;
                displayFormManagement("entity");
                exit;
            }
            else
            {
                deleteEntity($nameEntity);
            }

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
    displayFormManagement($arrayToDisplay);
}

function editOS($osName){
    $arrayToDisplay = $_SESSION['gestionFormArray'];
    $isOSAssociated = false;
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
        if(isset($osName['valueOSToDelete']) && $osName['valueOSToDelete'] != null)
        {
            $nameOS = $osName['valueOSToDelete'];
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

            $allOSAssociatedToVM = getOSAssociateToVM();
            $idOS = getIdOS($textOs);

            foreach($allOSAssociatedToVM as $osAssociatedToVM)
            {
                if($idOS[0]['os_id'] == $osAssociatedToVM['os_id'])
                {
                    $isOSAssociated = true;
                }
                else
                {
                    $isOSAssociated = false;
                }

                if($isOSAssociated == true)
                {
                    $_SESSION['displayModalOSAssociated'] = true;
                    displayFormManagement("os");
                    exit;
                }
                else
                {
                    deleteOS($textOs);
                }
            }
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
    displayFormManagement($arrayToDisplay);
}

function editSnapshots($snapshotsName){
    $arrayToDisplay = $_SESSION['gestionFormArray'];
    $isSnapshotAssociated = false;
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
        if(isset($snapshotsName['valueSnapToDelete']) && $snapshotsName['valueSnapToDelete'] != null)
        {
            $nameSnapshots = $snapshotsName['valueSnapToDelete'];
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

            $snapshotsAssociatedToVM = getSnapshotsAssociateToVM();
            $idSnapshot = getIdSnapshots($typeSnapshots);

            foreach($snapshotsAssociatedToVM as $snapshotAssociatedToVM)
            {
                if($idSnapshot[0]['snapshot_id'] == $snapshotAssociatedToVM['snapshot_id'])
                {
                    $isSnapshotAssociated = true;
                }
                else
                {
                    $isSnapshotAssociated = false;
                }
            }

            if($isSnapshotAssociated == true)
            {
                $_SESSION['displayModalSnapshotAssociated'] = true;
                displayFormManagement("snapshots");
                exit;
            }
            else
            {
                deleteSnapshots($typeSnapshots);
            }
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
    displayFormManagement($arrayToDisplay);
}

function editBackup($backupName){
    $arrayToDisplay = $_SESSION['gestionFormArray'];
    $isBackupAssociated = false;
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
        if(isset($backupName['valueBackupToDelete']) && $backupName['valueBackupToDelete'] != null)
        {
            $nameBackup = $backupName['valueBackupToDelete'];
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

            $backupsAssociatedToVM = getBackupAssociateToVM();
            $idBackup = getIdBackup($typeBackup);

            foreach($backupsAssociatedToVM as $backupAssociatedToVM)
            {
                if($idBackup[0]['backup_id'] == $backupAssociatedToVM['backup_id'])
                {
                    $isBackupAssociated = true;
                }
                else
                {
                    $isBackupAssociated = false;
                }
            }

            if($isBackupAssociated == true)
            {
                $_SESSION['displayModalBackupAssociated'] = true;
                displayFormManagement("backup");
                exit;
            }
            else
            {
                deleteBackup($typeBackup);
            }
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
    displayFormManagement($arrayToDisplay);
}

function displayResearch($inputResearch){
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != null)
    {
        require_once 'model/vmManager.php';
        require_once 'model/dbConnector.php';
        $researchResult = researchVm($inputResearch);

        //display searchResultView
        require 'view/searchResult.php';
    }
    else
    {
        $_GET['action'] = "signIn";
        require 'view/signIn.php';
    }
}

function modifyStatusAfterRenewal($idVM, $status){
    if($status){
        $vmStatus = 2;
    }
    else{
        $vmStatus = 4;
    }

    require_once "model/vmManager.php";

    if(updateStatusVM($idVM['id'], $vmStatus) == 2){
        $_SESSION['$displayModalConfirm'] = true;
        displayAllVM("");
    }
    elseif(updateStatusVM($idVM['id'], $vmStatus) == 1){
        $_SESSION['displayModalErrorMail'] = true;
        displayAllVM("");
    }
    else{
        $_SESSION['displayErrorModification'] = true;
        displayDetailsVM($idVM['id']);
    }
}

function exportToExcel(){
    require_once "model/vmManager.php";
    $allVM = getAllVM();

    exportVMToExcel($allVM);
}

function displayAlertManagementPage(){
    if(isset($_SESSION['userType'])){
        if($_SESSION['userType'] == 1){
            require_once "model/jsonConnector.php";
            $alertJsonData = getJsonData(0);
            $mailContentJsonData = getJsonData(1);


            require 'view/alertManagementPage.php';
        }
        else{
            displayHome();
        }
    }
    else{
        $_GET['action'] = "signIn";
        displaySignIn();
    }
}

function saveAlertModification($data){
    if(isset($data['adminMail'])){
        if(isset($data['senderMail'])){
            $tableToSave = array('data' => 'alertManagement', 'mailAdmin' => $data['adminMail'], 'sender' =>$data['senderMail']);
        }
    }

    if(isset($tableToSave)){
        require_once "model/jsonConnector.php";
        if(saveJsonData($tableToSave, 0)){
            $_SESSION['saveAlertModification'] = 1;
            displayAlertManagementPage();
        }
        else{
            $_SESSION['saveAlertModification'] = false;
            displayAlertManagementPage();
        }
    }
    else{
        $_SESSION['saveAlertModification'] = false;
        displayAlertManagementPage();
    }

}

function saveContentMail($data){
    if(isset($data['requestMail'])){
        if(isset($data['mailToAdminstratorRequest'])){
            if(isset($data['validateRequestMail'])){
                if(isset($data['deniedRequestMail'])){
                    if(isset($data['advertMail'])){
                        if(isset($data['nonrenewalMailAdvert'])){
                            if(isset($data['renewalMail'])){
                                if(isset($data['administratorMailValidateRequest'])){
                                    $tableToSave = array('data' => 'mailContent', 'requestMail' => $data['requestMail'], 'mailToAdminstratorRequest' =>$data['mailToAdminstratorRequest'], 'validateRequestMail' => $data['validateRequestMail'], 'deniedRequestMail' =>$data['deniedRequestMail'], 'advertMail' => $data['advertMail'], 'nonrenewalMailAdvert' =>$data['nonrenewalMailAdvert'], 'renewalMail' => $data['renewalMail'], 'administratorMailValidateRequest' => $data['administratorMailValidateRequest']);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    if(isset($tableToSave)){
        require_once "model/jsonConnector.php";
        if(saveJsonData($tableToSave, 1)){
            $_SESSION['saveContentMail'] = 1;
            displayAlertManagementPage();
        }
        else{
            $_SESSION['saveContentMail'] = false;
            displayAlertManagementPage();
        }
    }
    else{
        $_SESSION['saveContentMail'] = false;
        displayAlertManagementPage();
    }

}