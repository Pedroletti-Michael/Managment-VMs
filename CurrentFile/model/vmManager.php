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
    if($dateEnd == null || $dateEnd == ''){
        $dateEnd = 'null';
        $dateAnniversary = date('Y-m-d', strtotime($dateStart. ' + 183 days'));
    }
    else{
        $dateAnniversary = 'null';
    }
    $description = $formVMRequest['objective'];
    $ip = 'null';
    $dnsName = 'null';
    $redundance = 'null';
    $usageType = $formVMRequest['usingVM'];
    $cpu = $formVMRequest['inputCPU'];
    $ram = $formVMRequest['inputRAM'];
    $disk = $formVMRequest['inputSSD'];
    $descDisk = $formVMRequest['infoSSD'];
    $network = $formVMRequest['networkFormControlSelect'];
    $domain = $formVMRequest['domainEINET'];
    if($formVMRequest['ti'] == null || $formVMRequest['ti'] == ''){
        $comment = 'null';
    }
    else{
        $comment = $formVMRequest['ti'];
    }

    $datacenter = 'null';
    $requestName = getUserId($_SESSION['userEmail']);
    $tmName = getUserId($formVMRequest['inputTMName']);
    $raName = getUserId($formVMRequest['inputRAName']);
    $entity_id = getEntityId($formVMRequest['disFormControlSelect']);
    if($formVMRequest['osTypeFormControlSelect'] == "Windows"){
        $os_id = getOsId($formVMRequest['osFormNameControlSelectWin'], $formVMRequest['osTypeFormControlSelect']);
    }
    else{
        $os_id = getOsId($formVMRequest['osFormNameControlSelectLin'], $formVMRequest['osTypeFormControlSelect']);
    }

    $snapshot_id = getSnapshotId($formVMRequest['snapshotsFormControlSelect']);
    $backup_id = getBackupId($formVMRequest['backupFormControlSelect']);
    $cost_id = 1;

    $strSep = '\'';

    $query = "INSERT INTO vm (name, cluster, dateStart, dateAnniversary, dateEnd, description, ip, dnsName, redundance, usageType, cpu, ram, disk, descriptionDisk, network, domain, comment, datacenter, customer, userRa, userRt, entity_id, os_id, snapshot_id, backup_id, cost_id) 
  
              VALUES(
              ".$strSep.$vmName.$strSep.",";
    if($cluster == 'null' || $cluster == null){
        $query = $query.$cluster.",
        ".$strSep.$dateStart.$strSep.",";
    }
    else{
        $query = $query.$strSep.$cluster.$strSep.",
        ".$strSep.$dateStart.$strSep.",";
    }

    if($dateAnniversary == 'null' || $dateAnniversary == null){
        $dateAnniversary = 'null';
        $query = $query.$dateAnniversary.",
              ".$strSep.$dateEnd.$strSep.",
              ".$strSep.$description.$strSep.",
              ".$ip.",
              ".$dnsName.",
              ".$redundance.",
              ".$strSep.$usageType.$strSep.",
              ".$strSep.$cpu.$strSep.",
              ".$strSep.$ram.$strSep.",
              ".$strSep.$disk.$strSep.",";
    }
    else{
        $dateEnd = 'null';
        $query = $query.$strSep.$dateAnniversary.$strSep.",
              ".$dateEnd.",
              ".$strSep.$description.$strSep.",
              ".$ip.",
              ".$dnsName.",
              ".$redundance.",
              ".$strSep.$usageType.$strSep.",
              ".$strSep.$cpu.$strSep.",
              ".$strSep.$ram.$strSep.",
              ".$strSep.$disk.$strSep.",";
    }

    if($descDisk == null || $descDisk == ""){
        $descDisk = 'null';
        $query = $query.$descDisk.",
              ".$strSep.$network.$strSep.",
              ".$strSep.$domain.$strSep.",";
    }
    else{
        $query = $query.$strSep.$descDisk.$strSep.",
              ".$strSep.$network.$strSep.",
              ".$strSep.$domain.$strSep.",";
    }

    if($comment == 'null' || $comment == null){
        $query = $query.$comment.",
              ".$datacenter.",
              ".$strSep.$requestName.$strSep.",
              ".$strSep.$raName.$strSep.",
              ".$strSep.$tmName.$strSep.",
              ".$strSep.$entity_id.$strSep.",
              ".$strSep.$os_id.$strSep.",
              ".$strSep.$snapshot_id.$strSep.",
              ".$strSep.$backup_id.$strSep.",
              ".$strSep.$cost_id.$strSep.")";
    }
    else{
        $query = $query.$strSep.$comment.$strSep.",
              ".$datacenter.",
              ".$strSep.$requestName.$strSep.",
              ".$strSep.$raName.$strSep.",
              ".$strSep.$tmName.$strSep.",
              ".$strSep.$entity_id.$strSep.",
              ".$strSep.$os_id.$strSep.",
              ".$strSep.$snapshot_id.$strSep.",
              ".$strSep.$backup_id.$strSep.",
              ".$strSep.$cost_id.$strSep.")";
    }


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

function getClusterId($clusterName){
    $strSep = '\'';

    $query = "SELECT id FROM `cluster` WHERE name = ". $strSep.$clusterName.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getOsId($osName, $osType){
    $strSep = '\'';

    $query = "SELECT os_id FROM `os` WHERE osName = ". $strSep.$osName.$strSep ." AND osType = ". $strSep.$osType.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

function getSnapshotId($snapshotName){
    $strSep = '\'';

    $typeSnapshot = explode(" ", $snapshotName);

    $query = "SELECT name, snapshot_id FROM `snapshot`";

    $snapshots = executeQuery($query);

    $result = null;
    foreach ($snapshots as $snapshot){
        if($snapshot['name'] == $typeSnapshot[0]){
            $result = $snapshot[1];
        }
    }

    return $result;
}

function getBackupId($backupName){
    $strSep = '\'';

    $typeBackup = explode(" ", $backupName);

    $query = "SELECT name, backup_id FROM `backup`";

    $backups = executeQuery($query);

    $result = null;
    foreach ($backups as $backup){
        if($backup[0] == $typeBackup[0]){
            $result = $backup[1];
        }
    }

    return $result;
}

/**===GET INFO OF ALL VM===**/
function getAllVM()
{
    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm`";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM TABLE===**/
function getInfoUser($id){
    $strSep = '\'';

    $query = "SELECT lastname, firstname FROM `user` WHERE user_id = ". $strSep.$id.$strSep;

    $user = executeQuery($query);
    $result = $user[0][0] . " " .$user[0][1];
    return $result;
}

function getMailUser($id){
    $strSep = '\'';

    $query = "SELECT mail FROM `user` WHERE user_id = ". $strSep.$id.$strSep;

    $user = executeQuery($query);
    return $user[0][0];
}

function getNameAndSurnameUser($id){
    $strSep = '\'';

    $query = "SELECT lastname, firstname FROM `user` WHERE user_id = ". $strSep.$id.$strSep;

    $user = executeQuery($query);
    return $user;
}

function getEmailUser($id){
    $strSep = '\'';

    $query = "SELECT mail FROM `user` WHERE user_id = ". $strSep.$id.$strSep;

    $userEmail = executeQuery($query);
    return $userEmail;
}

function getCluster($id){
    $strSep = '\'';

    if(isset($id) && $id != '' && $id != null && $id != 'null'){
        $query = "SELECT name, id_site FROM `cluster` WHERE id = ". $strSep.$id.$strSep;

        $result = executeQuery($query);

        $query = "SELECT name FROM `site` WHERE id = ". $strSep.$result[0]['id_site'].$strSep;

        $nameSite = executeQuery($query);
        $finalResult = array('name' => $result[0][0], 'nameSite' => $nameSite[0][0]);
    }
    else{
        $finalResult = array('name' => '', 'nameSite' => '');
    }

    return $finalResult;
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
    $returnResult = array();
    array_push($returnResult, $result[0][0]);
    array_push($returnResult, $result[0][1]);
    return $returnResult;
}

function getInfoSnapshot($id){
    $strSep = '\'';

    $query = "SELECT policy, name FROM `snapshot` WHERE snapshot_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);

    $returnResult = array();
    array_push($returnResult, $result[0][0]);
    array_push($returnResult, $result[0][1]);

    return $returnResult;
}

function getInfoBackup($id){
    $strSep = '\'';

    $query = "SELECT policy, name FROM `backup` WHERE backup_id = ". $strSep.$id.$strSep;

    $result = executeQuery($query);

    $returnResult = array();
    array_push($returnResult, $result[0][0]);
    array_push($returnResult, $result[0][1]);

    return $returnResult;
}

/**===GET USER'S VM INFO===**/
function getUserVM($userId)
{
    $strSep = '\'';

    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus`  FROM `vm` WHERE customer = ". $strSep.$userId.$strSep ." OR userRa =". $strSep.$userId.$strSep ." OR userRt =". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM VM WHO NEED TO BE CONFIRMED===**/
function getConfirmationVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `timestampAdd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 0";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

function getUserConfirmationVM($userId){
    require_once 'model/dbConnector.php';

    $strSep = '\'';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `timestampAdd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 0 AND customer = ". $strSep.$userId.$strSep ." OR vmStatus = 0 AND userRa =". $strSep.$userId.$strSep ." OR vmStatus = 0 AND userRt =". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM VM WHO NEED TO BE RENEWAL===**/
function getRenewalVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 3";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

function getUserRenewalVM($userId){
    require_once 'model/dbConnector.php';

    $strSep = '\'';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `timestampAdd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 3 AND customer = ". $strSep.$userId.$strSep ." OR vmStatus = 3 AND userRa =". $strSep.$userId.$strSep ." OR vmStatus = 3 AND userRt =". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM VM WHO ARE VALIDATED===**/
function getValidatedVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 2";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

function getUserValidatedVM($userId){
    require_once 'model/dbConnector.php';

    $strSep = '\'';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `timestampAdd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 2 AND customer = ". $strSep.$userId.$strSep ." OR vmStatus = 2 AND userRa =". $strSep.$userId.$strSep ." OR vmStatus = 2 AND userRt =". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM VM WHO ARE VALIDATED===**/
function getDeletedOrUnrenewalVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 5";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

function getUserDeletedOrUnrenewalVM($userId){
    require_once 'model/dbConnector.php';

    $strSep = '\'';
    $querySelect = "SELECT `id`, `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `timestampAdd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus` FROM `vm` WHERE vmStatus = 5 AND customer = ". $strSep.$userId.$strSep ." OR vmStatus = 5 AND userRa =". $strSep.$userId.$strSep ." OR vmStatus = 5 AND userRt =". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM VM WHO NEED TO BE RENEW===**/
/** A supprimer -> remplacer par getRenewalVM**/
function getVmToRenew(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE vmStatus = 3";

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO FROM WHO NEED TO BE RENEW FROM A USER===**/
function getRenewFromAUser($userId){
    require_once 'model/dbConnector.php';
    $strSep = '\'';

    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus`  FROM `vm` WHERE vmStatus = 3 AND customer = ". $strSep.$userId.$strSep ."OR vmStatus = 3 AND userRa = ". $strSep.$userId.$strSep ."OR vmStatus = 3 AND userRt = ". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getInfoUser($vm['customer']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
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

/**===GET INFO OF A SPECIFIC VM VIA THE ID OF THIS VM**/
function getDataVM($idVM){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `name`, `cluster`, `dateStart`, `dateAnniversary`, `dateEnd`, `description`, `ip`, `dnsName`, `redundance`, `usageType`, `criticity`, `cpu`, `ram`, `disk`, `descriptionDisk`, `network`, `domain`, `patch`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`, `vmStatus`  FROM `vm` WHERE id = ". $idVM;

    $resultSelect = executeQuerySelect($querySelect);
    $i = 0;

    foreach ($resultSelect as $vm){
        $userRa = getNameAndSurnameUser($vm['userRa']);
        $userRt = getNameAndSurnameUser($vm['userRt']);
        $userEmailRa = getEmailUser($vm['userRa']);
        $userEmailRt = getEmailUser($vm['userRt']);
        $resultSelect[$i]['cluster'] = getCluster($vm['cluster']);
        $resultSelect[$i]['customer'] = getMailUser($vm['customer']);
        $resultSelect[$i]['userRa'] = $userRa[0]['lastname']." ".$userRa[0]['firstname'];
        $resultSelect[$i]['userRt'] = $userRt[0]['lastname']." ".$userRt[0]['firstname'];
        $resultSelect[$i]['userEmailRa'] = $userEmailRa[0]['mail'];
        $resultSelect[$i]['userEmailRt'] = $userEmailRt[0]['mail'];
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $resultSelect[$i]['snapshot_id'] = getInfoSnapshot($vm['snapshot_id']);
        $resultSelect[$i]['backup_id'] = getInfoBackup($vm['backup_id']);
        $i++;
    }
    return $resultSelect;
}

/**===UPDATE INFO OF A VM===**/
function updateVMInformation($vmInformation, $id){
    require_once 'model/dbConnector.php';
    require_once  'model/userManager.php';

    $strSep = '\'';

    if(isset($vmInformation['editDateAnniversary'])){
        if($vmInformation['osTypeFormControlSelect'] == "Windows"){
            $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.getClusterId($vmInformation['editCluster']).$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateAnniversary = ". $strSep.$vmInformation['editDateAnniversary'].$strSep. ",
              description = ". $strSep.$vmInformation['objective'].$strSep. ",
              ip = ". $strSep.$vmInformation['editIP'].$strSep. ",
              dnsName = ". $strSep.$vmInformation['editDnsName'].$strSep. ",
              redundance = ". $strSep.$vmInformation['editRedundance'].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              criticity = ". $strSep.$vmInformation['editCriticity'].$strSep. ",
              cpu = ". $strSep.$vmInformation['inputCPU'].$strSep. ",
              ram = ". $strSep.$vmInformation['inputRAM'].$strSep. ",
              disk = ". $strSep.$vmInformation['inputSSD'].$strSep. ",
              network = ". $strSep.$vmInformation['networkFormControlSelect'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              patch = ". $strSep.$vmInformation['securityFormControlSelect'].$strSep. ",
              comment = ". $strSep.$vmInformation['ti'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputRequesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. ",
              entity_id = ". $strSep. getEntityId($vmInformation['disFormControlSelect']).$strSep. ",
              os_id = ". $strSep.getOsId($vmInformation['osFormNameControlSelectWin'], $vmInformation['osTypeFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. "
              WHERE id = ". $id;
        }
        else{
            $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.getClusterId($vmInformation['editCluster']).$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateAnniversary = ". $strSep.$vmInformation['editDateAnniversary'].$strSep. ",
              description = ". $strSep.$vmInformation['objective'].$strSep. ",
              ip = ". $strSep.$vmInformation['editIP'].$strSep. ",
              dnsName = ". $strSep.$vmInformation['editDnsName'].$strSep. ",
              redundance = ". $strSep.$vmInformation['editRedundance'].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              criticity = ". $strSep.$vmInformation['editCriticity'].$strSep. ",
              cpu = ". $strSep.$vmInformation['inputCPU'].$strSep. ",
              ram = ". $strSep.$vmInformation['inputRAM'].$strSep. ",
              disk = ". $strSep.$vmInformation['inputSSD'].$strSep. ",
              network = ". $strSep.$vmInformation['networkFormControlSelect'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              patch = ". $strSep.$vmInformation['securityFormControlSelect'].$strSep. ",
              comment = ". $strSep.$vmInformation['ti'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputRequesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. ",
              entity_id = ". $strSep. getEntityId($vmInformation['disFormControlSelect']).$strSep. ",
              os_id = ". $strSep.getOsId($vmInformation['osFormNameControlSelectLin'], $vmInformation['osTypeFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. "
              WHERE id = ". $id;

        }
    }
    else{
        if($vmInformation['osTypeFormControlSelect'] == "Windows"){
            $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.getClusterId($vmInformation['editCluster']).$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateEnd = ". $strSep.$vmInformation['inputEndDate'].$strSep. ",
              description = ". $strSep.$vmInformation['objective'].$strSep. ",
              ip = ". $strSep.$vmInformation['editIP'].$strSep. ",
              dnsName = ". $strSep.$vmInformation['editDnsName'].$strSep. ",
              redundance = ". $strSep.$vmInformation['editRedundance'].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              criticity = ". $strSep.$vmInformation['editCriticity'].$strSep. ",
              cpu = ". $strSep.$vmInformation['inputCPU'].$strSep. ",
              ram = ". $strSep.$vmInformation['inputRAM'].$strSep. ",
              disk = ". $strSep.$vmInformation['inputSSD'].$strSep. ",
              network = ". $strSep.$vmInformation['networkFormControlSelect'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              patch = ". $strSep.$vmInformation['securityFormControlSelect'].$strSep. ",
              comment = ". $strSep.$vmInformation['ti'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputRequesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. ",
              entity_id = ". $strSep. getEntityId($vmInformation['disFormControlSelect']).$strSep. ",
              os_id = ". $strSep.getOsId($vmInformation['osFormNameControlSelectWin'], $vmInformation['osTypeFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. "
              WHERE id = ". $id;
        }
        else{
            $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.getClusterId($vmInformation['editCluster']).$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateEnd = ". $strSep.$vmInformation['inputEndDate'].$strSep. ",
              description = ". $strSep.$vmInformation['objective'].$strSep. ",
              ip = ". $strSep.$vmInformation['editIP'].$strSep. ",
              dnsName = ". $strSep.$vmInformation['editDnsName'].$strSep. ",
              redundance = ". $strSep.$vmInformation['editRedundance'].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              criticity = ". $strSep.$vmInformation['editCriticity'].$strSep. ",
              cpu = ". $strSep.$vmInformation['inputCPU'].$strSep. ",
              ram = ". $strSep.$vmInformation['inputRAM'].$strSep. ",
              disk = ". $strSep.$vmInformation['inputSSD'].$strSep. ",
              network = ". $strSep.$vmInformation['networkFormControlSelect'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              patch = ". $strSep.$vmInformation['securityFormControlSelect'].$strSep. ",
              comment = ". $strSep.$vmInformation['ti'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputRequesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. ",
              entity_id = ". $strSep. getEntityId($vmInformation['disFormControlSelect']).$strSep. ",
              os_id = ". $strSep.getOsId($vmInformation['osFormNameControlSelectLin'], $vmInformation['osTypeFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. "
              WHERE id = ". $id;

        }
    }


    executeQuery($query);

    //TODO ADD A VERIFICATION => GET DATA FROM DB AND COMPARE WITH DATA WE HAVE HERE AND AFTER THAT RETURN TRUE OR FALSE
    return true;
}

/**===UPDATE INFO OF A VM===**/
function updateVMInformationForUser($vmInformation, $id){
    require_once 'model/dbConnector.php';
    require_once  'model/userManager.php';

    $strSep = '\'';

    $query = "UPDATE vm SET
              dateEnd = ". $strSep.$vmInformation['inputEndDate'].$strSep. ",
              usageType = ". $strSep.$vmInformation['usingVM'].$strSep. ",
              domain = ". $strSep.$vmInformation['domainEINET'].$strSep. ",
              customer = ". $strSep.getUserId($vmInformation['inputRequesterName']).$strSep. ",
              userRa = ". $strSep.getUserId($vmInformation['inputRAName']).$strSep. ",
              userRt = ". $strSep.getUserId($vmInformation['inputTMName']).$strSep. "
              WHERE id = ". $id;

    executeQuery($query);

    return true;
}

/**===UPDATE STATUS OF THE VM===**/
function updateStatusVM($id, $vmStatus, $reason = null, $vmInformation = null){
    require_once 'model/dbConnector.php';
    require_once 'model/mailSender.php';
    $status = 0;
    $strSep = '\'';
    $result = false;

    if($vmStatus == 4){
        $status = 4;
    }
    elseif($vmStatus == 3){
        $status = 3;
    }
    elseif($vmStatus == true){
        $status = 2;
    }
    else{
        $status = 1;
    }


    $query = "UPDATE vm SET vmStatus = ". $status ." WHERE id = ". $id;

    executeQuery($query);

    $link = 'https://vmman.heig-vd.ch/index.php?action=detailsVM&id='.$id;
    $info = getInformationForMailAboutVM($id);
    if($status == 1){
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $newVmName = $info[0].$randomString;
        $query = "UPDATE vm SET name = ". $strSep.$newVmName.$strSep ." WHERE id = ". $id;

        executeQuery($query);

        $query = "SELECT `vmStatus` FROM `vm` WHERE id =". $id;
        $selectResult = executeQuery($query);
        if($selectResult[0][0] == 1){
            if(deniedRequestMail($info[1], $info[0], $reason)){
                $result = 2;
            }
            else{
                $result = 1;
            }
        }
    }
    elseif($status == 2){
        $query = "SELECT `vmStatus` FROM `vm` WHERE id =". $id;
        $selectResult = executeQuery($query);
        if($selectResult[0][0] == 2){
            if($reason == "renewal"){
                if(renewalMail($info[1], $info[0], $link, $info[3], $info[2])){
                    $result = 2;
                }
                else{
                    $result = 1;
                }
            }
            else{
                if(validateRequestMail($info[1], $info[0], $link, $info[3], $info[2], $vmInformation) && administratorMailValidateRequest($info[0],$link,$vmInformation)){
                    $result = 2;
                }
                else{
                    $result = 1;
                }
            }
        }
    }
    elseif($status == 3){
        $query = "SELECT `vmStatus` FROM `vm` WHERE id =". $id;
        $selectResult = executeQuery($query);
        if($selectResult[0][0] == 3){
            $result = true;
        }
    }
    elseif($status == 4){
        $query = "SELECT `vmStatus` FROM `vm` WHERE id =". $id;
        $selectResult = executeQuery($query);
        if($selectResult[0][0] == 4){
            if(nonrenewalMailAdvert($info[1], $info[0], $info[3], $info[2])){
                $result = 2;
            }
            else{
                $result = 1;
            }
        }
    }

    return $result;
}

/**===Verify datas to update VM===**/
function getFirstAndLastNameUser($email)
{
    $strSep = '\'';

    $query = "SELECT lastname, firstname FROM `user` WHERE mail = ". $strSep.$email.$strSep;

    $user = executeQuery($query);

    $name = $user[0]["lastname"]." ".$user[0]["firstname"];

    return $name;
}

/**===GET INFORMATION FOR THE UPDATE OF THE STATUS VM===**/
function getInformationForMailAboutVM($id){
    $querySelect = "SELECT `name`, `customer`, `userRa`, `userRt` FROM `vm` WHERE id = ". $id;

    $resultSelect = executeQuerySelect($querySelect);
    $arrayResult = array();
    $i = 0;

    foreach ($resultSelect as $vm){
        array_push($arrayResult, $vm['name']);
        array_push($arrayResult, getMailUser($vm['customer']));
        array_push($arrayResult, getMailUser($vm['userRa']));
        array_push($arrayResult, getMailUser($vm['userRt']));
        $i++;
    }
    return $arrayResult;
}

/**===GET ID BY NAME OF A VM===**/
function getIdOfVmByName($vmName){
    $strSep = '\'';
    $querySelect = "SELECT `id` FROM `vm` WHERE name = ". $strSep.$vmName.$strSep;

    $resultSelect = executeQuerySelect($querySelect);

    return $resultSelect[0][0];
}

function getAllVmNameAndId(){
    $querySelect = "SELECT `name`, `id` FROM `vm` ";

    return executeQuerySelect($querySelect);
}

function getVmNameAndIdByName($vmName){
    $strSep = '\'';
    $querySelect = "SELECT `id`, `name` FROM `vm` WHERE name = ". $strSep.$vmName.$strSep;

    return  executeQuerySelect($querySelect);
}

function researchVm($inputResearch){
    $query = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `usageType`, `cpu`, `ram`, `disk`, `network`, `userRt`, `entity_id`, `os_id`, `vmStatus`  FROM `vm` WHERE vm.name LIKE '%".$inputResearch."%'";

    $resultSelect = executeQuerySelect($query);
    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['userRt'] = getInfoUser($vm['userRt']);
        $resultSelect[$i]['entity_id'] = getInfoEntity($vm['entity_id']);
        $resultSelect[$i]['os_id'] = getInfoOs($vm['os_id']);
        $i++;
    }
    return $resultSelect;
}

function getVmName(){
    require_once 'model/dbConnector.php';
    $query = "SELECT `name` FROM `vm`";

    $resultSelect = executeQuerySelect($query);

    return $resultSelect;
}

function getAllVmForCheckSendingMail(){
    $strSep = '\'';
    $querySelect = "SELECT `id`,`name`,`dateAnniversary`,`dateEnd`,`customer`,`userRa`,`userRt`,`vmStatus` FROM `vm` WHERE vmStatus = 2 OR vmStatus = 3";

    $resultSelect =executeQuerySelect($querySelect);

    $i = 0;

    foreach ($resultSelect as $vm){
        $resultSelect[$i]['customer'] = getMailUser($vm['customer']);
        $resultSelect[$i]['userRa'] = getMailUser($vm['userRa']);
        $resultSelect[$i]['userRt'] = getMailUser($vm['userRt']);
        $i++;
    }

    return $resultSelect;
}

function exportVMToExcel($allVM){
    $fields = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18','19','20','21','22','23','24','25');
    $i=0;
    foreach ($allVM as $value){
        foreach ($fields as $field){
            unset($allVM[$i][$field]);
        }
        $i++;
    }
    $filename='HEIG-VD_VM_Inventory_'.date('d.m.Y/G.i.s');
    CSV::export($allVM,$filename);
}

function countConfirmationVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT COUNT(*) FROM vm WHERE vmStatus = 0";

    $resultSelect = executeQuerySelect($querySelect);

    return $resultSelect[0][0];
}
function countRenewalVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT COUNT(*) FROM vm WHERE vmStatus = 3";

    $resultSelect = executeQuerySelect($querySelect);

    return $resultSelect[0][0];
}

function countUserConfirmationVM($userId){
    require_once 'model/dbConnector.php';
    $strSep = '\'';

    $querySelect = "SELECT COUNT(*) FROM vm WHERE vmStatus = 0 AND customer = ". $strSep.$userId.$strSep. " OR vmStatus = 0 AND userRt = ". $strSep.$userId.$strSep. " OR vmStatus = 0 AND userRa = ". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);

    return $resultSelect[0][0];
}
function countUserRenewalVM($userId){
    require_once 'model/dbConnector.php';
    $strSep = '\'';

    $querySelect = "SELECT COUNT(*) FROM vm WHERE vmStatus = 3 AND customer = ". $strSep.$userId.$strSep. " OR vmStatus = 3 AND userRt = ". $strSep.$userId.$strSep. " OR vmStatus = 3 AND userRa = ". $strSep.$userId.$strSep;

    $resultSelect = executeQuerySelect($querySelect);

    return $resultSelect[0][0];
}

class CSV{
    static function export($allVM,$filename){
        header('Content-Type: text/csv;');
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        $i = 0;
        foreach ($allVM as $data){
            if($i==0){
                echo '"'.implode('";"',array_keys($data)).'"'."\n";
                $i++;
            }
            $data['cluster'] = $data['cluster']['name'];
            $data['os_id']= $data['os_id'][1]." : ".$data['os_id'][0];
            $data['backup_id']= $data['backup_id'][1]." : ".$data['backup_id'][0];
            $data['snapshot_id']= $data['snapshot_id'][1]." : ".$data['snapshot_id'][0];
            echo '"'.implode('";"',$data).'"'."\n";
        }
    }
}