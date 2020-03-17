<?php
/**
* Authors : Théo Cook and Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 17.03.2020
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
        case 'accueil':
            displayAccueil();
            break;
        case 'form':
            displayForm();
            break;
        default:
            displayAccueil();
    }
}else{
    displayAccueil();
}
