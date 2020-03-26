<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the DB manager view
 */

function displayVM()
{
    $_GET['action'] = "vm";
    require 'view/vm.php';
}

function displayBackup()
{
    $_GET['action'] = "backup";
    require 'view/backup.php';
}

function displayBDDEntity()
{
    $_GET['action'] = "entity";
    require 'view/entity.php';
}

function displayOS()
{
    $_GET['action'] = "os";
    require 'view/os.php';
}

function displayPricing()
{
    $_GET['action'] = "pricing";
    require 'view/pricing.php';
}

function displaySnapshot()
{
    $_GET['action'] = "snapshot";
    require 'view/snapshot.php';
}

function displayUser()
{
    $_GET['action'] = "user";
    require 'view/user.php';
}