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
    $requestName = getUserId($_SESSION['userEmail']);
    $tmName = getUserId($formVMRequest['inputTMName']);
    $raName = getUserId($formVMRequest['inputRAName']);
    $entity_id = getEntityId($formVMRequest['disFormControlSelect']);
    $os_id = getOsId($formVMRequest['osFormNameControlSelect'], $formVMRequest['osTypeFormControlSelect']);
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

function getOsId($osName, $osType){
    $strSep = '\'';

    $query = "SELECT os_id FROM `os` WHERE osName = ". $strSep.$osName.$strSep ." AND osType = ". $strSep.$osType.$strSep;

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

/**===GET INFO OF ALL VM===**/
function getAllVM()
{
    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm`";

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

/**===GET INFO FROM TABLE===**/
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
    $returnResult = array();
    array_push($returnResult, $result[0][0]);
    array_push($returnResult, $result[0][1]);
    return $returnResult;
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

/**===GET USER'S VM INFO===**/
function getUserVM($userId)
{
    $strSep = '\'';

    require_once 'model/dbConnector.php';
    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE customer = ". $strSep.$userId.$strSep ." OR userRa =". $strSep.$userId.$strSep ." OR userRt =". $strSep.$userId.$strSep;

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

/**===GET INFO FROM VM WHO NEED TO BE CONFIRMED===**/
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

/**===GET INFO FROM VM WHO ARE VALIDATED===**/
function getValidatedVM(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE vmStatus = 2";

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

/**===GET INFO FROM VM WHO NEED TO BE RENEW===**/
function getVmToRenew(){
    require_once 'model/dbConnector.php';

    $querySelect = "SELECT `id`, `name`, `dateStart`, `dateEnd`, `description`, `usageType`, `cpu`, `ram`, `disk`, `network`, `domain`, `comment`, `customer`, `userRa`, `userRt`, `entity_id`, `os_id`, `snapshot_id`, `backup_id`  FROM `vm` WHERE vmStatus = 3";

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

/**===GET INFO OF A SPECIFIC VM VIA THE ID OF THIS VM**/
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

/**===UPDATE INFO OF A VM===**/
function updateVMInformation($vmInformation, $id){
    require_once 'model/dbConnector.php';
    require_once  'model/userManager.php';

    $strSep = '\'';

    $query = "UPDATE vm SET
              name = ". $strSep.$vmInformation['inputVMName'].$strSep. ",
              cluster = ". $strSep.$vmInformation['editCluster'].$strSep. ",
              dateStart = ". $strSep.$vmInformation['inputComissioningDate'].$strSep. ",
              dateAnniversary = ". $strSep.$vmInformation['editDateAnniversary'].$strSep. ",
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
              os_id = ". $strSep.getOsId($vmInformation['osFormNameControlSelect'], $vmInformation['osTypeFormControlSelect']).$strSep. ",
              snapshot_id = ". $strSep.getSnapshotId($vmInformation['snapshotsFormControlSelect']).$strSep. ",
              backup_id = ". $strSep.getBackupId($vmInformation['backupFormControlSelect']).$strSep. "
              WHERE id = ". $id;

    executeQuery($query);

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
function updateStatusVM($id, $vmStatus){
    require_once 'model/dbConnector.php';
    require_once 'model/mailSender.php';
    $status = 1;

    if($vmStatus){
        $status = 2;
    }
    else{
        $status = 1;
    }

    $query = "UPDATE vm SET vmStatus = ". $status ." WHERE id = ". $id;

    executeQuery($query);

    $link = 'http://vmman.heig-vd.ch/action=detailedVM&ID='.$id;
    $info = getInformationForMailAboutVM($id);
    if($status == 1){
        deniedRequestMail($info[1], $info[0]);
    }
    elseif($vmStatus == 2){
        validateRequestMail($info[1], $info[0], $link, $info[3], $info[2]);
    }

    return true;
}

/**===GET INFORMATION FOR THE UPDATE OF THE STATUS VM===**/
function getInformationForMailAboutVM($id){
    $querySelect = "SELECT `name`, `customer`, `userRa`, `userRt` FROM `vm` WHERE id = ". $id;

    $resultSelect = executeQuerySelect($querySelect);
    $arrayResult = array();
    $i = 0;

    foreach ($resultSelect as $vm){
        array_push($arrayResult, $vm['name']);
        array_push($arrayResult, getInfoUser($vm['customer']));
        array_push($arrayResult, getInfoUser($vm['userRa']));
        array_push($arrayResult, getInfoUser($vm['userRt']));
        $i++;
    }
    return $arrayResult;
}