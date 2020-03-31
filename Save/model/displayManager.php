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

function addEntity($nameEntity){
    $strSep = '\'';

    $query = "INSERT INTO entity (entityName) VALUES (".$strSep.$nameEntity.$strSep.")";
    return executeQuery($query);
}

function deleteEntity($nameEntity){
    $query = "DELETE FROM entity WHERE entity.entityName = '$nameEntity'";
    return executeQuery($query);
}

function addOS($nameOS,$typeOS){
    $strSep = '\'';

    $query = "INSERT INTO os (osName,osType) VALUES (".$strSep.$nameOS.$strSep.",".$strSep.$typeOS.$strSep.")";
    return executeQuery($query);
}

function addSnapshots($nameSnapshots){
    $strSep = '\'';

    $query = "INSERT INTO snapshot (policy) VALUES (".$strSep.$nameSnapshots.$strSep.")";
    return executeQuery($query);
}

function addBackup($nameBackup){
    $strSep = '\'';

    $query = "INSERT INTO backup (policy) VALUES (".$strSep.$nameBackup.$strSep.")";
    return executeQuery($query);
}


/**
 * Region contains all function to display information about columns for every table of the db
 */
function displayColumnsFromUser(){
    $query = "SHOW COLUMNS FROM user";
    return executeQuery($query);
}

function displayColumnsFromVm(){
    $query = "SHOW COLUMNS FROM vm";
    return executeQuery($query);
}

function displayColumnsFromBackup(){
    $query = "SHOW COLUMNS FROM backup";
    return executeQuery($query);
}

function displayColumnsFromEntity(){
    $query = "SHOW COLUMNS FROM Entity";
    return executeQuery($query);
}

function displayColumnsFromOs(){
    $query = "SHOW COLUMNS FROM os";
    return executeQuery($query);
}

function displayColumnsFromPricing(){
    $query = "SHOW COLUMNS FROM pricing";
    return executeQuery($query);
}

function displayColumnsFromSnapshot(){
    $query = "SHOW COLUMNS FROM snapshot";
    return executeQuery($query);
}