<?php
/**
 * Author : Thomas Huguet
 * CreationFile date : 20.03.2020
 * ModifFile date : 26.03.2020
 * Description : Contains all functions related to the DB manager view
 */

function displayVM()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "vm";
                require 'view/vm.php';
                break;
            case 3:
                $_GET['action'] = "vm";
                require 'view/vm.php';
                break;
            case 4:
                $_GET['action'] = "vm";
                require 'view/vm.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displayBackup()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "backup";
                require 'view/backup.php';
                break;
            case 3:
                $_GET['action'] = "backup";
                require 'view/backup.php';
                break;
            case 4:
                $_GET['action'] = "backup";
                require 'view/backup.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displayBDDEntity()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "entity";
                require 'view/entity.php';
                break;
            case 3:
                $_GET['action'] = "entity";
                require 'view/entity.php';
                break;
            case 4:
                $_GET['action'] = "entity";
                require 'view/entity.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displayOS()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "os";
                require 'view/os.php';
                break;
            case 3:
                $_GET['action'] = "os";
                require 'view/os.php';
                break;
            case 4:
                $_GET['action'] = "os";
                require 'view/os.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displayPricing()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "pricing";
                require 'view/pricing.php';
                break;
            case 3:
                $_GET['action'] = "pricing";
                require 'view/pricing.php';
                break;
            case 4:
                $_GET['action'] = "pricing";
                require 'view/pricing.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displaySnapshot()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "snapshot";
                require 'view/snapshot.php';
                break;
            case 3:
                $_GET['action'] = "snapshot";
                require 'view/snapshot.php';
                break;
            case 4:
                $_GET['action'] = "snapshot";
                require 'view/snapshot.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }
}

function displayUser()
{
    if(isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType'])
        {
            case 1:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
            case 2:
                $_GET['action'] = "user";
                require 'view/user.php';
                break;
            case 3:
                $_GET['action'] = "user";
                require 'view/user.php';
                break;
            case 4:
                $_GET['action'] = "user";
                require 'view/user.php';
                break;
            default:
                $_GET['action'] = "home";
                require 'view/home.php';
                break;
        }
    }
    else
    {
        $_GET['action'] = "home";
        require 'view/home.php';
    }

}