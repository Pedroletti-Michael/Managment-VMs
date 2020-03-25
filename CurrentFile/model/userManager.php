<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 25.03.2020
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
    putenv('LDAPTLS_REQCERT=never');
    $result = null;

    $ds=ldap_connect("ldaps://einet.ad.eivd.ch:636");

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

    if ($ds) {
        $r=ldap_bind($ds, $userLogin."@einet.ad.eivd.ch", $userPwd); // Connection of the user

        if($r){
            $result = array();

            // Search samaccountname of the user
            $sr=ldap_search($ds, "dc=einet,dc=ad,dc=eivd,dc=ch", "samaccountname=".$userLogin);

            $info = ldap_get_entries($ds, $sr);

            array_push($result, $info[0]["sn"][0]);
            array_push($result, $info[0]["givenname"][0]);
            array_push($result, $info[0]["mail"][0]);

            ldap_close($ds);

            return $result;
        }
        else{
            return $result;
        }



    } else {
        return $result;
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
    if ($userMail == $value[0]){
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
  if($result != null){
    if(!dbVerification($result[2])){
        adUserToDB($result[0], $result[1], $result[2]);
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
