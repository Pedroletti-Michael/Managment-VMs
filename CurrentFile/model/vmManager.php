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
    $os_id = getOsId($formVMRequest['osFormControlSelect']);
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


/**===GET-ID FROM TABLE===**/
function getEntityId($entityName){
    $strSep = '\'';

    $query = "SELECT entity_id FROM `entity` WHERE entityName = ". $strSep.$entityName.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getOsId($osName){
    $strSep = '\'';
    // CORRIGER LA FONCTION

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


/**===GET INFO OF ALL VM FORM VM TABLE===**/
function getAllVM()
{
    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE vmStatus = 2 OR vmStatus = 3";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['userRa'] = getInfoUser($vm['userRa']);
        $resultSelect[$i]['userRt'] = getInfoUser($vm['userRt']);
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $resultSelect[$i]['snapshot_id'] = getInfoSnapshot($vm['snapshot_id']);
        $resultSelect[$i]['backup_id'] = getInfoBackup($vm['backup_id']);
        $i++;
    }
    return $resultSelect;
}

function getInfoUser($id){
    $strSep = '\'';

    $query = "SELECT mail FROM `user` WHERE user_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getInfoEntity($id){
    $strSep = '\'';

    $query = "SELECT entityName FROM `entity` WHERE entity_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getInfoOs($id){
    $strSep = '\'';

    $query = "SELECT osName, osType FROM `os` WHERE os_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);
    return $result[0][1] . " " .$result[0][0];
}

function getInfoSnapshot($id){
    $strSep = '\'';

    $query = "SELECT policy FROM `snapshot` WHERE snapshot_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getInfoBackup($id){
    $strSep = '\'';

    $query = "SELECT policy FROM `backup` WHERE backup_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

/**===GET-User's VM FROM TABLE===**/
function getUserVM($userId)
{
    $strSep = '\'';

    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE customer = ". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['userRa'] = getInfoUser($vm['userRa']);
        $resultSelect[$i]['userRt'] = getInfoUser($vm['userRt']);
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $resultSelect[$i]['snapshot_id'] = getInfoSnapshot($vm['snapshot_id']);
        $resultSelect[$i]['backup_id'] = getInfoBackup($vm['backup_id']);
        $i++;
    }
    return $resultSelect;
}

/**===Get Information from VM's who need to be confirmed===**/
function getConfirmationVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE vmStatus = 0";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['userRa'] = getInfoUser($vm['userRa']);
        $resultSelect[$i]['userRt'] = getInfoUser($vm['userRt']);
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $resultSelect[$i]['snapshot_id'] = getInfoSnapshot($vm['snapshot_id']);
        $resultSelect[$i]['backup_id'] = getInfoBackup($vm['backup_id']);
        $i++;
    }
    return $resultSelect;
}

/**===GET A SPECIFIC VM VIA THE ID OF THIS VM**/
function getDataVM($idVM){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `patch`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus`  FROM `vm` WHERE id = ". $idVM;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['userRa'] = getInfoUser($vm['userRa']);
        $resultSelect[$i]['userRt'] = getInfoUser($vm['userRt']);
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $resultSelect[$i]['snapshot_id'] = getInfoSnapshot($vm['snapshot_id']);
        $resultSelect[$i]['backup_id'] = getInfoBackup($vm['backup_id']);
        $i++;
    }
    return $resultSelect;
}

/**===Update VM in DB===**/
function updateVMInformation($vmInformation, $id){
    require_once 'model/dbConnector.php';

    $strSep = '\'';

    $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.$vmInformation[''].$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateAnniversary = ". $strSep.$vmInformation[''].$strSep. ",
              dateEnd = ". $strSep.$vmInformation['inputEndDate'].$strSep. ",
              description = ". $strSep.$vmInformation['objective'].$strSep. ",
              ip = ". $strSep.$vmInformation[''].$strSep. ",
              dnsName = ". $strSep.$vmInformation[''].$strSep. ",
              redundance = ". $strSep.$vmInformation[''].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              criticity = ". $strSep.$vmInformation[''].$strSep. ",
              cpu = ". $strSep.$vmInformation['inputCPU'].$strSep. ",
              ram = ". $strSep.$vmInformation['inputRAM'].$strSep. ",
              disk = ". $strSep.$vmInformation['inputSSD'].$strSep. ",
              network = ". $strSep.$vmInformation['networkFormControlSelect'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              patch = ". $strSep.$vmInformation['securityFormControlSelect'].$strSep. ",
              comment = ". $strSep.$vmInformation['ti'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputResquesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. ",
              entity_id = ". $strSep.getEntityId($vmInformation['disFormControlSelect']).$strSep. ",
              os_id = ". $strSep.getOsId($vmInformation['osFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. ",
              vmStatus = ". $strSep.$vmInformation[''].$strSep. "
              WHERE id = ". $id;

    executeQuery($query);

    return true;
}