<?php
/**
* Authors : Théo Cook and Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 31.03.2020
**/
session_start();

// Require all controler files
$files = glob(__DIR__.'/controler/*.php');
foreach ($files as $file)
{
    require($file);
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch ($action) {
        case 'home':
            displayHome();
            break;
        case 'form':
            displayForm();
            break;
        case 'formManagement':
            displayFormManagement();
            break;
        case 'allVM':
            displayAllVM();
            break;
        case 'confirmationVM':
            displayConfirmationVM();
            break;
        case 'detailsVM':
            displayDetailsVM($_POST);
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
        case 'RequestVM':
            formVM($_POST);
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
        default:
            displayHome();
    }
}else{
    displayHome();
}
