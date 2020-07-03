<?php
/**
* Authors : Théo Cook and Thomas Huguet
* CreationFile date : 17.03.2020
* Description : Serve to redirect the user depending of his actions
**/

session_start();

// Require all controler's files
$files = glob(__DIR__.'/controler/*.php');
foreach ($files as $file)
{
    require($file);
}

if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}


// Redirect the user depending of his actions
if(isset($_GET['action']))
{
    $action = $_GET['action'];
    require_once 'model/vmManager.php';

    switch ($action)
    {
        case 'home':
            if(testSessionTime()){break;}
            displayHome();
            break;
        case 'signIn':
            //if(testSessionTime()){break;}
            displaySignIn();
            break;
        case 'signOut':
            //if(testSessionTime()){break;}
            signOut();
            break;
        case 'RequestLogin':
            login($_POST);
            break;
        case 'form':
            if(testSessionTime()){break;}
            displayForm();
            break;
        case 'formAdmin':
            if(testSessionTime()){break;}
            displayFormAdmin();
            break; 
        case 'RequestVM':
            if(testSessionTime()){break;}
            formVM($_POST);
            break;
        case 'RequestVMAdmin':
            if(testSessionTime()){break;}
            formVMAdmin($_POST);
            break;
        case 'formManagement':
            if(testSessionTime()){break;}
            displayFormManagement($_GET['array']);
            break;
        case 'allVM':
            if(testSessionTime()){break;}
            displayAllVM($_POST,$_GET);
            break;
        case 'renewalVM':
            if(testSessionTime()){break;}
            displayRenewalVM();
            break;
        case 'confirmationVM':
            if(testSessionTime()){break;}
            displayConfirmationVM();
            break;
        case 'detailsVM':
            if(testSessionTime()){break;}
            displayDetailsVM($_GET['id']);
            break;
        case 'updateVM':
            if(testSessionTime()){break;}
            updateVM($_POST);
            break;
        case 'vmAccepted':
            if(testSessionTime()){break;}
            vmAccepted($_POST);
            break;
        case 'vmRefused':
            if(testSessionTime()){break;}
            vmRefused($_POST['deniedRequestInformation']);
            break;
        case 'renewalAccepted':
            if(testSessionTime()){break;}
            modifyStatusAfterRenewal($_GET, true);
            break;
        case 'renewalRefused':
            if(testSessionTime()){break;}
            modifyStatusAfterRenewal($_GET, false);
            break;
        case 'vm':
            if(testSessionTime()){break;}
            displayVM();
            break;
        case 'backup':
            if(testSessionTime()){break;}
            displayBackup();
            break;
        case 'entity':
            if(testSessionTime()){break;}
            displayBDDEntity();
            break;
        case 'os':
            if(testSessionTime()){break;}
            displayOS();
            break;
        case 'pricing':
            if(testSessionTime()){break;}
            displayPricing();
            break;
        case 'snapshot':
            if(testSessionTime()){break;}
            displaySnapshot();
            break;
        case 'user':
            if(testSessionTime()){break;}
            displayUser();
            break;
        case 'editEntity':
            if(testSessionTime()){break;}
            editEntity($_POST);
            break;
        case 'editOS':
            if(testSessionTime()){break;}
            editOS($_POST);
            break;
        case 'editSnapshots':
            if(testSessionTime()){break;}
            editSnapshots($_POST);
            break;
        case 'editBackup':
            if(testSessionTime()){break;}
            editBackup($_POST);
            break;
        case 'research':
            if(testSessionTime()){break;}
            displayResearch($_POST['inputResearch']);
            break;
        case 'refreshUser':
            if(testSessionTime()){break;}
            refreshUser();
            break;
        case 'exportToExcel':
            if(testSessionTime()){break;}
            exportToExcel();
            break;
        case 'displayManagementUser':
            if(testSessionTime()){break;}
            displayManagementUser();
            break;
        case 'saveModificationUser':
            if(testSessionTime()){break;}
            saveModificationAboutUsers($_POST);
            break;
        case 'displayAlertManagementPage':
            if(testSessionTime()){break;}
            displayAlertManagementPage();
            break;
        case 'saveAlertModification':
            if(testSessionTime()){break;}
            saveAlertModification($_POST);
            break;
        case 'saveContentMail':
            if(testSessionTime()){break;}
            saveContentMail($_POST);
            break;
        case 'renewalTest':
            if(testSessionTime()){break;}
            renewalTest();
            break;
        case 'addUserListAd':
            addUserListAd();
            break;
        default:
            if(testSessionTime()){break;}
            displayHome();
            break;
    }
}
else
{
    displayHome();
}
