<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the admin view
 */

function displayAllVM()
{
    $_GET['action'] = "allVM";
    require 'view/allVM.php';
}