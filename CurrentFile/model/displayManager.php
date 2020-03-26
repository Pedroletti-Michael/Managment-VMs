<?php
/**
 * User: Théo
 * Date: 25.03.2020
 * Time: 11:30
 */

require 'model/dbConnector.php';

function displayBDD_Entity(){
    $query = "SELECT entityName FROM entity";
    return executeQuery($query);
}

function displayBDD_OS(){
    $query = "SELECT osName, osType FROM os";
    return executeQuery($query);
}

function displayBSS_Snapshots(){
    $query = "SELECT policy FROM snapshot";
    return executeQuery($query);
}

function displayBSS_Backup(){
    $query = "SELECT policy FROM backup";
    return executeQuery($query);
}