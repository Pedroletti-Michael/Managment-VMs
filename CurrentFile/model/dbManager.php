<?php
/**
 * User: Pedroletti Michael
 * Date: 26.03.2020
 * Time: 10:05
 */
require 'model/dbConnector.php';

function addAttribute($tableName, $attributeName, $attributeType){
    $query = 'ALTER TABLE '. $tableName .'ADD '. $attributeName .' '. $attributeType;

    executeQuery($query);
}

function deleteAttribute($tableName, $attributeName){
    $query = 'ALTER TABLE '. $tableName .'DROP COLUMN '. $attributeName;

    executeQuery($query);
}

function addTable(){

}

function deleteTable(){
    
}