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

      $vmName = $formVMRequest['inputVMName'];
      $requestName = $formVMRequest['inputResquesterName'];
      $numberCPU = $formVMRequest['inputCPU'];
      $tmName = $formVMRequest['inputTMName'];
      $numberRAM = $formVMRequest['inputRAM'];
      $raName = $formVMRequest['inputRAName'];
      $memory = $formVMRequest['inputMemory'];
      $department = $formVMRequest['disFormControlSelect'];
      $OS = $formVMRequest['osFormControlSelect'];
      $comissionDate = $formVMRequest['$comissionDate'];
  }
}
