<?php

/**
* Function used to open connexion with an DB.
*/
// TODO Check all var field with the conf of the DB and complete empty field.
function openDBConnexion (){
  $tempConnexion = null;

  $sqlDriver = 'mysql';
  $hostname = ''; // Field to complete
  $port = 3306;
  $charset = 'utf8';
  $dbName = ''; // Field to complete
  $userName = ''; // Field to complete
  $userPwd = ''; // Field to complete
  $dsn = $sqlDriver . 'host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

  try{

  }
  catch (PDOException $exception){
    echo 'Connection failed: ' . $exception->getMessage();
  }
  return $tempConnexion;
}

/**
* Function used to execute a selet query.
* $query = query needed
* return = result of the query
*/
function executeQuerySelect($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();
  if ($$dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $statement->execute();
    $queryResult = $statement->fetchAll();
  }

  $dbConnexion = null;
  return $queryResult;
}

/**
* Function ued to execute a insert query
* $query = query needed
* return = result of the query
*/
function executeQueryInsert($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();
  if($dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $queryResult = $statement->execute();
  }
  $dbConnexion = null;
  return $queryResult;
}
