<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 19.03.2020
* ModificationFile date : 19.03.2020
* Description : File used to manage VMs to add a VM in db or just to get info
* from db.
*/

/**
* This function add a VM into the db
*/
function addVMToDB($formVMRequest)
{
    require_once 'model/dbConnector.php';
    require_once 'model/userManager.php';
    $vmName = $formVMRequest['inputVMName'];
    $cluster = 'null';
    $dateStart = $formVMRequest['inputComissioningDate'];
    $dateEnd = $formVMRequest['inputEndDate'];
    $description = $formVMRequest['objective'];
    $ip = 'null';
    $dnsName = 'null';
    $redundance = 'null';
    $usageType = $formVMRequest['usingVM'];
    $cpu = $formVMRequest['inputCPU'];
    $ram = $formVMRequest['inputRAM'];
    $disk = $formVMRequest['inputSSD'];
    $network = $formVMRequest['networkFormControlSelect'];
    $domain = $formVMRequest['domainEINET'];
    $comment = $formVMRequest['ti'];
    $datacenter = 'null';
    $requestName = getUserId($formVMRequest['inputResquesterName']);
    $tmName = getUserId($formVMRequest['inputTMName']);
    $raName = getUserId($formVMRequest['inputRAName']);
    $entity_id = getEntityId($formVMRequest['disFormControlSelect']);
    $os_id = 2;//getOsId($formVMRequest['osFormControlSelect']);
    $snapshot_id = getSnapshotId($formVMRequest['snapshotsFormControlSelect']);
    $backup_id = getBackupId($formVMRequest['backupFormControlSelect']);
    $cost_id = 1;

    $strSep = '\'';

    $query = "INSERT INTO vm (name, cluster, dateStart, dateEnd, description, ip, dnsName, redundance, usageType, cpu, ram, disk, network, domain, comment, datacenter, customer, userRa, userRt, entity_id, os_id, snapshot_id, backup_id, cost_id) 
  
              VALUES(
              ".$strSep.$vmName.$strSep.",
              ".$strSep.$cluster.$strSep.",
              ".$strSep.$dateStart.$strSep.",
              ".$strSep.$dateEnd.$strSep.",
              ".$strSep.$description.$strSep.",
              ".$strSep.$ip.$strSep.",
              ".$strSep.$dnsName.$strSep.",
              ".$strSep.$redundance.$strSep.",
              ".$strSep.$usageType.$strSep.",
              ".$strSep.$cpu.$strSep.",
              ".$strSep.$ram.$strSep.",
              ".$strSep.$disk.$strSep.",
              ".$strSep.$network.$strSep.",
              ".$strSep.$domain.$strSep.",
              ".$strSep.$comment.$strSep.",
              ".$strSep.$datacenter.$strSep.",
              ".$strSep.$requestName.$strSep.",
              ".$strSep.$raName.$strSep.",
              ".$strSep.$tmName.$strSep.",
              ".$strSep.$entity_id.$strSep.",
              ".$strSep.$os_id.$strSep.",
              ".$strSep.$snapshot_id.$strSep.",
              ".$strSep.$backup_id.$strSep.",
              ".$strSep.$cost_id.$strSep.")";


    executeQueryInsert($query);
    return true;
}

function getAllVM()
{
    $querySelect = "SELECT `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`  FROM `vm`";

    $resultSelect = executeQuerySelect($querySelect);
    return $resultSelect;
}

function getEntityId($entityName){
    $strSep = '\'';

    $query = "SELECT entity_id FROM `entity` WHERE entityName = ". $strSep.$entityName.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getOsId($osName){
    $strSep = '\'';

    $query = "SELECT os_id FROM `os` WHERE osName = ". $strSep.$osName.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getSnapshotId($snapshotName){
    $strSep = '\'';

    $query = "SELECT snapshot_id FROM `snapshot` WHERE policy = ". $strSep.$snapshotName.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getBackupId($backupId){
    $strSep = '\'';

    $query = "SELECT backup_id FROM `backup` WHERE policy = ". $strSep.$backupId.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}
