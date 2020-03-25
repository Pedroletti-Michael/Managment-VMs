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
  $baseDN = "ou=SI,ou=Personnel,dc=einet,dc=ad,dc=eivd,dc=ch";
  $password = $userPwd;
  $data = null;

  $ad = ldap_connect($uri)
        or die('Could not connect to LDAP server.');

  ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

  $result = @ldap_bind($ad, $userLogin . '@einet.ad.eivd.ch', $password)
            or die('Could not bind to AD. Check your credentials.');

  if($result){
    $filter = "(&(objectClass=user)(samaccountname=". $userLogin ."))";
    $justThese = array('sn', 'givenname', 'mail');

    $read = ldap_search($ad, $baseDN, $filter, $justThese)
            or die('research does not work !');
    $data = ldap_get_entries($ad, $read)
            or die('research does not work !');

    ldap_unbind($ad);
    return $data;
    //return true;
  }
  else{
    ldap_unbind($ad);
    return $data;
  }
}

/**
* This function is used to know if the user exist in our db.
* If the user exist -> function return true
* Else -> function return false
*/
function dbVerification($userMail){
  $query = 'SELECT mail FROM user';

  $queryResult = executeQuerySelect($query);

  foreach ($queryResult as $value) {
    if ($userMail == $value){
        return true;
    }
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
    if(!dbVerification($result[3])){
        adUserToDB($result[1], $result[2], $result[3]);
        return true;
    }
    else{
      return true;
    }
  }
  else{
    return false;
  }
}
