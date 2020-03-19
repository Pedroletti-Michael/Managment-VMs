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
function addVMToDB($string){
  // Here i need to create the query to send to db connector
  return $pwdK . base64_encode($string);
}
