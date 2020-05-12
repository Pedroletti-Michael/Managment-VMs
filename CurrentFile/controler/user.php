<?php
/**
* Author : Thomas Huguet
* CreationFile date : 17.03.2020
* Description : Contains all functions related to the user
**/

function displayHome()
{
    if(isset($_SESSION['userType'])&& $_SESSION['userType'] != null)
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
        $_GET['action'] = "signIn";
        require "view/signIn.php";
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

             if(isset($_SESSION['actionUser']) && $_SESSION['actionUser'] == "detailsVM")
             {
                 displayDetailsVM($_SESSION['idVM']);
             }
             else
             {
                 displayHome();
             }
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
    $_SESSION['userId'] = getUserId($userEmail);
}

function signOut()
{
    $_SESSION = array();
    session_destroy();

    displayHome();
}

function displayManagementUser(){
    require_once 'model/userManager.php';
    $allUsers = getAllUsers();

    require_once 'view/userManagement.php';
}

function refreshUser(){
    require_once 'model/userManager.php';
    if(verificationUserFromDb()){
        displayManagementUser();
    }
    else{
        displayManagementUser();
    }
}

function saveModificationAboutUsers($allData){
    require_once 'model/userManager.php';
    $allUsers = getAllUsers();

    $adminFromForm = explode(";", $allData['usersAfter']);
    foreach($adminFromForm as $adminForm){
        foreach($allUsers as $user){
            if($adminForm == $user['user_id']){
                if($user['type'] == 0){
                    updateType($user['user_id'], true);
                }
            }
        }
    }

    $adminFromDb = getAllAdmin();
    foreach($adminFromDb as $adminDb){
        $res = false;
        foreach($adminFromForm as $adminForm){
            if($adminForm == $adminDb['user_id']){
                $res = true;
            }
        }
        if(!$res){
            updateType($adminDb['user_id'], false);
        }
    }



    displayManagementUser();

    /*
    $k = array();
    for($i = 0; $i < count($allData); $i++){
        $k[$i] = key($allData);
        next($allData);
    }


    foreach($allUsers as $user){
        $field = "checkbox".$user['user_id'];
        for($i = 0; $i < count($k); $i++){
            if($k[$i] == $field){
                if($user['type'] == 0){
                    updateType($user['user_id'], true);
                    break;
                }
            }
            else{
                if($user['type'] == 1){
                    updateType($user['user_id'], false);
                    break;
                }
            }
        }
    }*/
}
