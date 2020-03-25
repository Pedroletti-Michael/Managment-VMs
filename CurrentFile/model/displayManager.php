<?php
/**
 * Created by PhpStorm.
 * User: Théo
 * Date: 25.03.2020
 * Time: 11:30
 */

require 'model/dbConnector.php';

function displayEntity(){

    $query = "SELECT `entityName` FROM `entity`";

    executeQuery($query);
}