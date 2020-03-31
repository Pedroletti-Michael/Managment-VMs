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
    $cluster = null;
    $dateStart = $formVMRequest['inputComissioningDate'];
    $dateAnniversary = null;
    $dateEnd = $formVMRequest['inputEndDate'];
    $description = $formVMRequest['objective'];
    $ip = null;
    $dnsName = null;
    $redundance = null;
    $usageType = $formVMRequest['usingVM'];
    $criticity = $formVMRequest['securityFormControlSelect'];
    $cpu = $formVMRequest['inputCPU'];
    $ram = $formVMRequest['inputRAM'];
    $disk = $formVMRequest['inputSSD'];
    $network = $formVMRequest['networkFormControlSelect'];
    $domain = $formVMRequest['domainEINET'];
    $patch = null;
    $comment = $formVMRequest['ti'];
    $datacenter = null;
    $requestName = getUserId($formVMRequest['inputResquesterName']);
    $tmName = getUserId($formVMRequest['inputTMName']);
    $raName = getUserId($formVMRequest['inputRAName']);
    $entity_id = getEntityId($formVMRequest['disFormControlSelect']);
    $os_id = getOsId($formVMRequest['osFormControlSelect']);
    $snapshot_id = getSnapshotId($formVMRequest['snapshotsFormControlSelect']);
    $backup_id = getBackupId($formVMRequest['backupFormControlSelect']);
    $cost_id = null;

    $strSep = '\'';

    $query = "INSERT INTO vm (name, cluster, dateStart, dateAnniversary, dateEnd, description, ip, dnsName, redundance, usageType, criticity, cpu, ram, disk, network, domain, patch, comment, datacenter, customer, userRa, userRt, entity_id, os_id, snapshot_id, backup_id, cost_id) 
  
              VALUES(
              ".$strSep.$vmName.$strSep.",
              ".$strSep.$cluster.$strSep.",
              ".$strSep.$dateStart.$strSep.",
              ".$strSep.$dateAnniversary.$strSep.",
              ".$strSep.$dateEnd.$strSep.",
              ".$strSep.$description.$strSep.",
              ".$strSep.$ip.$strSep.",
              ".$strSep.$dnsName.$strSep.",
              ".$strSep.$redundance.$strSep.",
              ".$strSep.$usageType.$strSep.",
              ".$strSep.$criticity.$strSep.",
              ".$strSep.$cpu.$strSep.",
              ".$strSep.$ram.$strSep.",
              ".$strSep.$disk.$strSep.",
              ".$strSep.$network.$strSep.",
              ".$strSep.$domain.$strSep.",
              ".$strSep.$patch.$strSep.",
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


     return executeQueryInsert($query);
}
