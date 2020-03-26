<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 19.03.2020
* ModificationFile date : 19.03.2020
* Description : File used to manage VMs to add a VM in db or just to get info
* from db.
*/

require 'model/dbConnector.php';

/**
* This function add a VM into the db
*/
function addVMToDB($formVMRequest)
{
    // Here i need to create the query to send to db connector
    $vmName = $formVMRequest['inputVMName'];
    $cluster = null; //à demander à Benj
    $dateStart = $formVMRequest['inputComissioningDate'];
    $dateAnniversary = null; //regarder Benj
    $dateEnd = $formVMRequest['inputEndDate'];
    $description = $formVMRequest['objective'];
    $ip = null; //regarder avec Benj
    $dnsName = null; //regarder avec Benj
    $redundance = null; //regarder avec Benj
    $usageType = $formVMRequest['usingVM'];
    $criticity = $formVMRequest['securityFormControlSelect']; //regarder avec Benj
    $cpu = $formVMRequest['inputCPU'];
    $ram = $formVMRequest['inputRAM'];
    $disk = $formVMRequest['inputSSD'];
    $network = $formVMRequest['networkFormControlSelect'];
    $domain = $formVMRequest['domainEINET'];
    $patch = null; //regarder avec Benj
    $comment = $formVMRequest['ti'];
    $datacenter = null; //regarder avec Benj
    $user_id = null;
    $entity_id = $formVMRequest['disFormControlSelect']; //departement
    $os_id = $formVMRequest['osFormControlSelect'];
    $snapshot_id = $formVMRequest['snapshotsFormControlSelect'];
    $backup_id = $formVMRequest['backupFormControlSelect'];
    $cost_id = null;


    /**
     * A regarder comment on va s'organiser pour les users si on rajoute des liaison ou si on les classes juste avec une séparation par des ;
     */
    $requestName = $formVMRequest['inputResquesterName']; //requérant
    $tmName = $formVMRequest['inputTMName']; // responsable technique
    $raName = $formVMRequest['inputAMName']; // responsable administratif


    $strSep = '\'';

    $query = "INSERT INTO vm (name, cluster, dateStart, dateAnniversary, dateEnd, descritpion, ip, dnsName, redundance, usageType, criticity, cpu, ram, disk, network, domain, patch, comment, datacenter, user_id, entity_id, os_id, snapshot_id, backup_id, cost_id) 
  
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
              ".$strSep.$user_id.$strSep.",
              ".$strSep.$entity_id.$strSep.",
              ".$strSep.$os_id.$strSep.",
              ".$strSep.$snapshot_id.$strSep.",
              ".$strSep.$backup_id.$strSep.",
              ".$strSep.$cost_id.$strSep.")";


     return executeQueryInsert($query);
}
