<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 26.03.2020
* Description : Contains all functions related to the user
**/

function displayHome()
{
    if(isset($_SESSION['userEmail']))
    {
        require_once 'model/userManager.php';
        $userId = getUserId($_SESSION['userEmail']);

        require_once "model/vmManager.php";
        $userVM = getUserVM($userId);

        $_GET['action'] = "home";
        require_once "view/home.php";
    }
    else
    {
        $userVM = "";
        $_GET['action'] = "home";
        require_once "view/home.php";
    }
}

function displaySignIn()
{
    $_GET['action'] = "signIn";
    require 'view/signIn.php';
}

function login($loginRequest)
{
  if (isset($loginRequest['userLogin']) && $loginRequest['userLogin'] != null && isset($loginRequest['userPassword']) && $loginRequest['userPassword'] != null)
     {
         $userLogin= $loginRequest['userLogin'];
         $userPwd = $loginRequest['userPassword'];

         require_once "model/userManager.php";

         $userEmail = userLogin($userLogin, $userPwd);

         if ($userEmail!=null || $userEmail!=false)
         {
             createSession($userEmail);
             displayHome();
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

function createSession($userEmail)
{
    $_SESSION['userEmail'] = $userEmail;
    $_SESSION['userType'] = getUserType($userEmail);
}

function signOut()
{
    $_SESSION = array();
    session_destroy();

    displayHome();
}
