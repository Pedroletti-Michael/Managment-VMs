<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 18.03.2020
* Description : File used to create a connection with the db and send query
*/
require 'model/encryption.php';

/**
* Function used to open connexion with an DB.
*/
function openDBConnexion(){
  $tempConnexion = null;

  $sqlDriver = 'mysql';
  $hostname = 'eips19.heig-vd.ch'; // Field to complete
  $port = 3306;
  $charset = 'utf8';
  $dbName = 'heigvdch_vmman'; // Field to complete
  $userName = 'heigvdch_vmman'; // Field to complete
  $userPwd = decrypt("mkHndhU83csnUia.Dhjc73jhRzh6UDRNTjJUOQ=="); // Field to complete
  $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

  try{
    $tempDbConnexion = new PDO($dsn, $userName, $userPwd);$
    echo 'Salem, ta réussi a te co';
  }
  catch (PDOException $exception){
    echo 'Connection failed: ' . $exception->getMessage() . ' ' . $userPwd;
  }
  return $tempConnexion;
}

/**
* Function used to execute a query.
* $query = query needed
* return = result of the query
*/
function executeQuery($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();

  if ($dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $statement->execute();
    $queryResult = $statement->fetchAll();
  }

  $dbConnexion = null;
  return $queryResult;
}
