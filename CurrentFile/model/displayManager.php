<?php
/**
 * User: Théo
 * Date: 25.03.2020
 * Time: 11:30
 */

require_once 'model/dbConnector.php';

/********************** Entity **************************/
function displayBDD_Entity(){
    $query = "SELECT entityName, status FROM entity";
    return executeQuery($query);
}

function displayBDD_Entity_StatusOn(){
    $query = "SELECT entityName FROM entity where status = 0";
    return executeQuery($query);
}

function addEntity($nameEntity){
    $strSep = '\'';

    $query = "INSERT INTO entity (entityName) VALUES (".$strSep.$nameEntity.$strSep.")";
    return executeQuery($query);
}

function deleteEntity($nameEntity){
    $query = "UPDATE entity SET entity.status = 1 WHERE entity.entityName = '$nameEntity'";
    return executeQuery($query);
}

function modifyEntity($nameEntity,$newName){
    $query = "UPDATE `entity` SET `entityName` = '$newName' WHERE `entity`.`entityName` = '$nameEntity';";
    return executeQuery($query);
}

function getIdEntity($nameEntity){
    $query = "SELECT entity_id FROM entity WHERE entity.entityName = '$nameEntity'";
    return executeQuery($query);
}

function getEntityAssociateToVM(){
    $query = "SELECT entity_id FROM vm";
    return executeQuery($query);
}
/********************** OS **************************/
function displayBDD_OSNameWhereWindows(){
    $strSep = '\'';

    $query = "SELECT osName FROM os WHERE status = 0 AND statusCommendable = 0 AND osType = ". $strSep."Windows".$strSep;

    $result = array();
    array_push($result, "Windows");
    array_push($result, executeQuery($query));

    return $result;
}

function displayBDD_OSNameWhereLinux(){
    $strSep = '\'';

    $query = "SELECT osName FROM os WHERE status = 0 AND statusCommendable = 0 AND osType = ". $strSep."Linux".$strSep;

    $result = array();
    array_push($result, "Linux / Ubuntu");
    array_push($result, executeQuery($query));

    return $result;
}

function displayBDD_OSNameWhereWindowsUncommendable(){
    $strSep = '\'';

    $query = "SELECT osName FROM os WHERE status = 0 AND statusCommendable = 1 AND osType = ". $strSep."Windows".$strSep;

    $result = array();
    array_push($result, "Windows");
    array_push($result, executeQuery($query));

    return $result;
}

function displayBDD_OSNameWhereLinuxUncommendable(){
    $strSep = '\'';

    $query = "SELECT osName FROM os WHERE status = 0 AND statusCommendable = 1 AND osType = ". $strSep."Linux".$strSep;

    $result = array();
    array_push($result, "Linux / Ubuntu");
    array_push($result, executeQuery($query));

    return $result;
}

function displayBDD_OS(){
    $query = "SELECT osName, osType, statusCommendable FROM os WHERE status = 0";
    return executeQuery($query);
}

function displayOsCommendable(){
    $query = "SELECT osName, osType FROM os WHERE status = 0 AND statusCommendable = 0";
    return executeQuery($query);
}

function dispayOsUncommendable(){
    $query = "SELECT osName, osType FROM os WHERE status = 0 AND statusCommendable = 1";
    return executeQuery($query);
}

function addOS($nameOS,$typeOS, $osCommendable){
    $strSep = '\'';

    $query = "INSERT INTO os (osName,osType,statusCommendable) VALUES (".$strSep.$nameOS.$strSep.",".$strSep.$typeOS.$strSep.",".$strSep.$osCommendable.$strSep.")";
    return executeQuery($query);
}

function deleteOS($nameOS){
    $query = "UPDATE os SET status = 1 WHERE os.osName = '$nameOS'";
    return executeQuery($query);
}

function modifyOS($nameOS,$newName,$newType, $osCommendable){
    $query = "UPDATE `os` SET `osName` = '$newName', `osType` = '$newType', `statusCommendable` = '$osCommendable' WHERE `os`.`osName` = '$nameOS';";
    return executeQuery($query);
}

function getIdOS($nameOS){
    $query = "SELECT os_id FROM os WHERE os.osName = '$nameOS'";
    return executeQuery($query);
}

function getOSAssociateToVM(){
    $query = "SELECT os_id FROM vm";
    return executeQuery($query);
}
/********************** Snapshots **************************/
function displayBSS_Snapshots(){
    $query = "SELECT policy, name FROM snapshot WHERE status = 0";
    return executeQuery($query);
}

function addSnapshots($typeSnapshots,$policySnapshots){
    $strSep = '\'';

    $query = "INSERT INTO `snapshot` (`policy`, `name`) VALUES (".$strSep.$policySnapshots.$strSep.",".$strSep.$typeSnapshots.$strSep.");";
    return executeQuery($query);
}

function deleteSnapshots($nameSnapshots){
    $query = "UPDATE snapshot SET status = 1 WHERE `snapshot`.`name` = '$nameSnapshots'";
    return executeQuery($query);
}

function modifySnapshots($nameSnapshots,$newPolicy,$newType){
    $query = "UPDATE `snapshot` SET `policy` = '$newPolicy', `name` = '$newType' WHERE `snapshot`.`name` = '$nameSnapshots';";
    return executeQuery($query);
}

function getIdSnapshots($nameSnapshots){
    $query = "SELECT snapshot_id FROM snapshot WHERE snapshot.name = '$nameSnapshots'";
    return executeQuery($query);
}

function getSnapshotsAssociateToVM(){
    $query = "SELECT snapshot_id FROM vm";
    return executeQuery($query);
}
/********************** Backup **************************/
function displayBSS_Backup(){
    $query = "SELECT policy, name FROM backup WHERE status = 0";
    return executeQuery($query);
}

function addBackup($typeBackup,$policyBackup){
    $strSep = '\'';

    $query = "INSERT INTO backup (`policy`, `name`) VALUES (".$strSep.$policyBackup.$strSep.",".$strSep.$typeBackup.$strSep.")";
    return executeQuery($query);
}

function deleteBackup($nameBackup){
    $query = "UPDATE backup SET status = 1 WHERE `backup`.`name` = '$nameBackup';";
    return executeQuery($query);
}

function modifyBackup($nameBackup,$newPolicy,$newType){
    $query = "UPDATE `backup` SET `policy` = '$newPolicy', `name` = '$newType' WHERE `backup`.`name` = '$nameBackup';";
    return executeQuery($query);
}

function getIdBackup($nameBackup){
    $query = "SELECT backup_id FROM backup WHERE backup.name = '$nameBackup'";
    return executeQuery($query);
}

function getBackupAssociateToVM(){
    $query = "SELECT backup_id FROM vm";
    return executeQuery($query);
}


/**
 * Here we have all function we use for getInformation about cluster
 */
function getClusters(){
    $strSep = '\'';

    $query = "SELECT name FROM `cluster` WHERE status = 0";

    $result = executeQuery($query);

    return $result;
}

function getClusterAndSiteName(){
    $strSep = '\'';

    $query = "SELECT cluster.name, site.name FROM site INNER JOIN cluster ON site.id = cluster.id_site WHERE cluster.status = 0";

    $result = executeQuery($query);

    return $result;
}

function addCluster($clusterName, $siteName){
    $strSep = '\'';

    $query = "SELECT id FROM site WHERE name = ".$strSep.$siteName.$strSep;
    $result = executeQuery($query);
    $idSite = $result[0]['id'];

    $query = "INSERT INTO cluster (`name`, `id_site`) VALUES (".$strSep.$clusterName.$strSep.", ".$strSep.$idSite.$strSep.")";
    return executeQuery($query);
}


/**
 * Here we have all function we use for get information about site
 */
function getSiteInformation(){
    $strSep = '\'';

    $query = "SELECT name FROM `site` WHERE status = 0";

    $result = executeQuery($query);

    return $result;
}



/********************** Columns **************************/
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