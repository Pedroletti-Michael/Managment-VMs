<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* ModifFile date : 17.03.2020
* Description : Contains all functions related to the user
**/

function displayAccueil()
{
    require 'view/accueil.php';
}

function login($loginRequest)
{
  if (isset($loginRequest['login']) && isset($loginRequest['password']))
     {
         $userLogin= $loginRequest['login'];
         $userPwd = $loginRequest['password'];

         require_once "model/userManager.php";

         if (userLogin($userLogin, $userPwd))
         {
             $_GET['action'] = "home";
             require "view/home.php";
         }
         else
         {
             $_GET['action'] = "signIn";
             require "view/signIn.php";
         }
     }
     else
     {
         $_GET['action'] = "signIn";
         require "view/signIn.php";
     }
}

function displaySignIn()
{
    require 'view/signIn.php';
}
