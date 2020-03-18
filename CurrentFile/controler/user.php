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
         $userLog= $loginRequest['login'];
         $userPsw = $loginRequest['password'];
     }
}
