<?php
/**
 **/
session_start();

require 'controler/controler.php';
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
return $action;