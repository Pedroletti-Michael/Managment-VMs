<?php
/**
* Authors : Théo Cook and Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 20.03.2020
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
        case 'allVM':
            displayAllVM();
            break;
        case 'signIn':
            displaySignIn();
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
            displayEntity();
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
        default:
            displayAccueil();
    }
}else{
    displayAccueil();
}
