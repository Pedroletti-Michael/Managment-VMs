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

  $ldapconfig['host'] = 'dceinet1.einet.ad.eivd.ch';//CHANGE THIS TO THE CORRECT LDAP SERVER
  $ldapconfig['port'] = '389';
  $ldapconfig['basedn'] = 'dc=einet,dc=ad,dc=eivd,dc=ch';//CHANGE THIS TO THE CORRECT BASE DN
  $ldapconfig['usersdn'] = 'cn=einetjoin';//CHANGE THIS TO THE CORRECT USER OU/CN
  $ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
  ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

  $dn="uid=".$userLogin.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
  if(isset($_POST['username'])){
    if ($bind=ldap_bind($ds, $dn, $userPwd))
      echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
      return true;
    }
    else {
      echo "Login Failed: Please check your username or password";
      return false
    }
  }


/**
  $ldap_dn = "uid=" . $userLogin . ", dc=einet, dc=ad, dc=eivd, dc=ch";
	$ldap_password = $userPwd;

	$ldap_con = ldap_connect("dceinet1.einet.ad.eivd.ch", 389)
    or die ("Connexion failed");

  ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

	if(ldap_bind($ldap_con,$ldap_dn,$ldap_password)){
    return true;
  }
	else{
    return false;
  }*/
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
  if(adVerification){
    if(!dbVerification){
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
  }
  else{
    return false;
  }
}
