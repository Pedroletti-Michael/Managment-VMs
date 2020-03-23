<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 19.03.2020
* ModificationFile date : 19.03.2020
* Description : File used to manage VMs to add a VM in db or just to get info
* from db.
*/

require 'model/dbConnector.php'

/**
* This function add a VM into the db
*/
function addVMToDB($formVMRequest)
{
  // Here i need to create the query to send to db connector
 $vmName = $formVMRequest['inputVMName'];
 $numberCPU = $formVMRequest['inputCPU'];
 $numberRAM = $formVMRequest['inputRAM'];
 $sizeSSD = $formVMRequest['inputSSD'];
 $OS = $formVMRequest['osFormControlSelect'];
 $network = $formVMRequest['networkFormControlSelect'];

 $requestName = $formVMRequest['inputResquesterName'];
 $tmName = $formVMRequest['inputTMName'];
 $raName = $formVMRequest['inputAMName'];
 $department = $formVMRequest['disFormControlSelect'];
 $comissionDate = $formVMRequest['inputComissioningDate'];
 $endDate = $formVMRequest['inputEndDate'];

 $usingVM = $formVMRequest['usingVM'];
 $description = $formVMRequest['objective'];
 $snapshot = $formVMRequest['snapshotsFormControlSelect'];
 $backup = $formVMRequest['backupFormControlSelect'];
 $domaineEinet = $formVMRequest['domainEINET'];
 $security = $formVMRequest['securityFormControlSelect'];
 $technicalInformations = $formVMRequest['ti'];

  $addVMQuery = "INSERT INTO 'vm' 'name', 'cluster', 'dateStart', 'dateEnd', 'description', 'usageType', 'cpu', 'ram', 'disk', 'network' VALUES '.$vmName.','.$department.','.$comissionDate.','.$endDate.','.$description.','.$usingVM.','.$numberCPU.','.$numberRAM.','.$sizeSSD.','.$network;

  return executeQueryInsert($addVMQuery);
}
