<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 17.03.2020
* Description : Contains all functions related to the user
**/

function displayHome()
{
    $_GET['action'] = "home";
    require "view/home.php";
}

function login($loginRequest)
{
  if (isset($loginRequest['userLogin']) && $loginRequest['userLogin'] != null && isset($loginRequest['userPassword']) && $loginRequest['userPassword'] != null)
     {
         $userLogin= $loginRequest['userLogin'];
         $userPwd = $loginRequest['userPassword'];

         require_once "model/userManager.php";

         if (userLogin($userLogin, $userPwd))
         {
             $_GET['action'] = "home";
             require "view/home.php";
         }
         else
         {
             $_GET['action'] = "signIn";
             $_POST['error'] = "credentials";
             require "view/signIn.php";
         }
     }
     else
     {
         $_GET['action'] = "signIn";
         $_POST['error'] = "fieldEmpty";
         require "view/signIn.php";
     }
}

function signOut()
{
    $_SESSION = array();
    session_destroy();
    $_GET["action"] = "home";
    displayHome();
}

function displaySignIn()
{
    require 'view/signIn.php';
}
