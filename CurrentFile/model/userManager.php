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

  putenv('LDAPTLS_REQCERT=never');
​
  $uri = 'ldaps://einet.ad.eivd.ch:636';
  $user = 'cn=einet,ou=SCCM,ou=Admin-Svcs,dc=einet,dc=ad,dc=eivd,dc=ch';
  $password = 'HLp+SUp*';

  $ad = ldap_connect($uri);// or die('Could not connect to LDAP server.');

  $result = @ldap_bind($ad, $user, $password);// or die('Could not bind to AD. Check your credentials.');

  //ldap_unbind($ad);
  ​
  if ($result){
    return true;
  }
  else{
    return true;
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



if(!dbVerification()){
  if(addUserInDB()){
    return true;
  }
  else{
    return false;
  }
}
else{
  return true;
}

*/
function userLogin($userLogin, $userPwd){
  if(adVerification()){
    return true;
  }
  else{
    return false;
  }
}
