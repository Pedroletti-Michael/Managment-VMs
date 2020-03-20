<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 18.03.2020
* Description : This file contains things about user, like the verification of
* the connexion with the server.
*/

/**
* This function is used to know if the userLogin exist and if the password of
* This user is correct.
* If this two field are correct, the function return true, else she return false
*/
function adVerification($userLogin, $userPwd){
  $uri = 'ldaps://einet.ad.eivd.ch:636';
  $password = $userPwd;

  $ad = ldap_connect($uri)
        or die('Could not connect to LDAP server.');

  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

  $result = @ldap_bind($ad, $userLogin . '@einet.ad.eivd.ch', $password)
            or die('Could not bind to AD. Check your credentials.');

  ldap_unbind($ad);

  if($result){
    return true;
  }
  else{
    return false;
  }
}

/**
* Function to return all users from db.
* Return all users from db.
*/
function getUserFromDB(){
  //TODO get all users form db stock them in table and return them
  return $users;
}

/**
* This function is used to know if the user exist in our db.
* If the user exist -> function return true
* Else -> function return false
*/
function dbVerification($userLogin){
  return true;

  //TODO
  // foreach user in db
  // if $userLogin == userDB
  // return true
  // else return false
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
  if(adVerification($userLogin, $userPwd)){
    return true;
  }
  else{
    return false;
  }
}
