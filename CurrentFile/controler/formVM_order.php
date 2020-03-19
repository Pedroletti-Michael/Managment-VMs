<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 17.03.2020
* Description : Contains all functions related to the formVM_order
**/

function displayForm()
{
    require 'view/form.php';
}

function formVM($formVMRequest)
{
  foreach ($formVMRequest as $field)
  {
      if(!isset($formVMRequest[$field]))
      {
          $_GET['action'] = "form";
          require "view/form.php";
      }
  }

        $vmName = $formVMRequest['inputVMName'];
        $numberCPU = $formVMRequest['inputCPU'];
        $numberRAM = $formVMRequest['inputRAM'];
        $memory = $formVMRequest['inputMemory'];
        $OS = $formVMRequest['osFormControlSelect'];
        $network = $formVMRequest['networkFormControlSelect'];

        $requestName = $formVMRequest['inputResquesterName'];
        $tmName = $formVMRequest['inputTMName'];
        $raName = $formVMRequest['inputRAName'];
        $department = $formVMRequest['disFormControlSelect'];
        $comissionDate = $formVMRequest['comissionDate'];
        $endDate = $formVMRequest['inputEndDate'];

        $usingVM = $formVMRequest['usingFormControlSelect'];
        $description = $formVMRequest['objective'];
        $snapshot = $formVMRequest['snapshotsFormControlSelect'];
        $backup = $formVMRequest['backupFormControlSelect'];
        $domaineEinet = $formVMRequest['domainEINET'];
        $security = $formVMRequest['securityFormControlSelect'];
        $technicalInformations = $formVMRequest['ti'];
}
