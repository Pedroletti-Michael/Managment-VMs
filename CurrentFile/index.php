<?php
/**
* Authors : Théo Cook and Thomas Huguet
* CreationFile date : 17.03.2020
* Description : Serve to redirect the user depending of his actions
**/

session_start();

// Require all controler files
$files = glob(__DIR__.'/controler/*.php');
foreach ($files as $file)
{
    require($file);
}

// Redirect the user depending of his actions
if(isset($_GET['action']))
{
    $action = $_GET['action'];
    switch ($action)
    {
        case 'home':
            displayHome();
            break;
        case 'signIn':
            displaySignIn();
            break;
        case 'signOut':
            signOut();
            break;
        case 'RequestLogin':
            login($_POST);
            break;
        case 'form':
            displayForm();
            break;
        case 'RequestVM':
            formVM($_POST);
            break;
        case 'formManagement':
            displayFormManagement($_GET['array']);
            break;
        case 'allVM':
            displayAllVM($_POST,$_GET);
            break;
        case 'renewalVM':
            displayRenewalVM();
            break;
        case 'confirmationVM':
            displayConfirmationVM();
            break;
        case 'detailsVM':
            displayDetailsVM($_GET['id']);
            break;
        case 'updateVM':
            updateVM($_POST);
            break;
        case 'vmAccepted':
            vmAccepted($_POST);
            break;
        case 'vmRefused':
            vmRefused($_POST['deniedRequestInformation']);
            break;
        case 'renewalAccepted':
            modifyStatusAfterRenewal($_GET, true);
            break;
        case 'renewalRefused':
            modifyStatusAfterRenewal($_GET, false);
            break;
        case 'vm':
            displayVM();
            break;
        case 'backup':
            displayBackup();
            break;
        case 'entity':
            displayBDDEntity();
            break;
        case 'os':
            displayOS();
            break;
        case 'pricing':
            displayPricing();
            break;
        case 'snapshot':
            displaySnapshot();
            break;
        case 'user':
            displayUser();
            break;
        case 'editEntity':
            editEntity($_POST);
            break;
        case 'editOS':
            editOS($_POST);
            break;
        case 'editSnapshots':
            editSnapshots($_POST);
            break;
        case 'editBackup':
            editBackup($_POST);
            break;
        case 'research':
            displayResearch($_POST['inputResearch']);
            break;
        case 'refreshUser':
            refreshUser();
            break;
        case 'exportToExcel':
            exportToExcel();
            break;
        case 'displayManagementUser':
            displayManagementUser();
            break;
        case 'saveModificationUser':
            saveModificationAboutUsers($_POST);
            break;
        default:
            displayHome();
    }
}
else
{
    displayHome();
}