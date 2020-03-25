<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 23.03.2020
* Description : This file contains things about user, like the verification of
* the connexion with the server.
*/
require 'model/dbConnector.php';

/**
* This function is used to know if the userLogin exist and if the password of
* This user is correct.
* If this two field are correct, the function return true, else she return false
*/
function adVerification($userLogin, $userPwd){
  $uri = 'ldaps://einet.ad.eivd.ch:636';
  $baseDN = "dc=einet,dc=ad,dc=eivd,dc=ch";
  $password = $userPwd;
  $data = null;
/*
  $ad = ldap_connect($uri)
        or die('Could not connect to LDAP server.');

  ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

  $result = @ldap_bind($ad, $userLogin . '@einet.ad.eivd.ch', $password)
            or die('Could not bind to AD. Check your credentials.');*/
  $result = true;

  if($result){
    /*
    $filter = "samaccountname=" . $userLogin;
    $justThese = array('sn', 'givenname', 'mail');

    $read = ldap_search($ad, $baseDN, $filter, $justThese)
            or die('research does not work !');
    $data = ldap_get_entries($ad, $read);
            or die('research does not work 2 !');

    ldap_unbind($ad);
    return $data;*/
    //ldap_unbind($ad);
    return true;
  }
  else{
    //ldap_unbind($ad);
    return false;
  }
}

/**
* This function is used to know if the user exist in our db.
* If the user exist -> function return true
* Else -> function return false
*/
function dbVerification($userMail){
  $query = 'SELECT mail FROM user';

  $queryResult = executeQuerySelect($query); //array('banane', 'orange', 'mandarine');

  foreach ($queryResult as $value) {
    echo $value['mail'];
  }

  return false;
}

/**
* Function used to add an user into data base
* return the query result
*/
function adUserToDB($lastname, $firstname, $mail){
  $strSep = '\'';

  $query = "INSERT INTO user (lastname, firstname, mail) VALUES(".$strSep.$lastname.$strSep.",".$strSep.$firstname.$strSep.",".$strSep.$mail.$strSep.")";

  return executeQuery($query);
}

/**
* This function use different function to connect user. And if this is the first
* connection for the user, the function ad user into our db.
* We only need to use this function in controller to know if the user success to
* connect or not.
* If all things pass -> function return true
* Else -> return false
*/
function userLogin($userLogin, $userPwd){
  $result = adVerification($userLogin, $userPwd);
  if($result){
    if(!dbVerification("michael.pedroletti@heig-vd.ch")){
      return false;/*
        if(adUserToDB("Pedroletti", "Michael", "michael.pedroletti@heig-vd.ch")){
          return true;
        }
        else{
          return false;
        }*/

    }
    else{
      return true;
    }
  }
  else{
    return false;
  }
}
