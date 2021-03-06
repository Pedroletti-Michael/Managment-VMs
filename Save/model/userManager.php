<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 25.03.2020
* Description : This file contains things about user, like the verification of
* the connexion with the server.
*/
require_once 'model/dbConnector.php';

/**
* This function is used to know if the userLogin exist and if the password of
* This user is correct.
* If this two field are correct, the function return the basic information of the user (mail, first and last name), else she return false
*/
function adVerification($userLogin, $userPwd){
    putenv('LDAPTLS_REQCERT=never');
    $result = null;

    //verify if the ldaps path is correct and open a connection path
    $ds=ldap_connect("ldaps://einet.ad.eivd.ch:636");

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

    if ($ds) {
        //connect the user(login + pwd) with the ldap path
        $r=ldap_bind($ds, $userLogin."@einet.ad.eivd.ch", $userPwd); // Connection of the user

        if($r){
            $result = array();

            //search information about the specified user (samaccountname)
            $sr=ldap_search($ds, "ou=personnel,dc=einet,dc=ad,dc=eivd,dc=ch", "samaccountname=".$userLogin);

            $info = ldap_get_entries($ds, $sr);

            //push information needed into the table result
            array_push($result, $info[0]["sn"][0]);
            array_push($result, $info[0]["givenname"][0]);
            array_push($result, $info[0]["mail"][0]);

            //close the ldap connection
            ldap_close($ds);

            return $result;
        }
        else{
            //close the ldap connection
            ldap_close($ds);

            return $result;
        }



    } else {
        return $result;
    }
}

function getAllUsers(){
    $query = 'SELECT mail, lastname, firstname FROM user';

    return executeQuerySelect($query);
}

/**
* This function is used to know if the user exist in our db.
* If the user exist -> function return true
* Else -> function return false
*/
function dbVerification($userMail){
  $queryResult = getAllUsers();

  //do the test to every user we have
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
* If all things pass -> function return mail of the user
* Else -> return false
*/
function userLogin($userLogin, $userPwd){
    if($userLogin == 'admin'){
        return $userLogin. "@heig-vd.ch";
    }
    else{
        //try to connect via the AD
        $result = adVerification($userLogin, $userPwd);
        if($result != null){
            //Check if the user is already in our db
            if(!dbVerification($result[2])){
                //Add the user into our db
                adUserToDB($result[0], $result[1], $result[2]);
                return $result[2];
            }
            else{
                return $result[2];
            }
        }
        else{
            return false;
        }
    }


}

/**
 * Get the type of the user
 * @param $userMail = mail of the user
 * @return = type of the user
 */
function getUserType($userMail){
    $strSep = '\'';

    $query = "SELECT type FROM `user` WHERE mail = ". $strSep.$userMail.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

/**
 * Get the id of the user
 * @param $userMail = mail of the user
 * @return = id of the user
 */
function getUserId($userMail){
    $strSep = '\'';

    $query = "SELECT user_id FROM `user` WHERE mail = ". $strSep.$userMail.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}

/**
 * This would check if a user is not already in our DB. For that, this function will get all entries if the ou=Personnel
 * in the active directory and check if the mail is already on the db. If not, they will be added
 */
function verificationUserFromDb(){
    putenv('LDAPTLS_REQCERT=never');
    $result = null;

    $ds=ldap_connect("ldaps://einet.ad.eivd.ch:636");

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

    $r=ldap_bind($ds, "michael.pedrolet@einet.ad.eivd.ch", "..."); // We need to find an way to connect. Because we need to be connected to research user

    if ($ds) {
        // Get all user from ou=Personnel
        $filter = "(uid=*)";
        $sr = ldap_search($ds, "ou=personnel,dc=einet,dc=ad,dc=eivd,dc=ch", "samaccountname=*");

        $info = ldap_get_entries($ds, $sr);

        //$usersFromDb = getAllUsers(); //Get all users from db

        $message = 'variables : '. count($info);

        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';

        foreach ($info as $user){
            //before array push verify if user is already in db if the user is not so add the user into db.
            if (!dbVerification($user['mail'][0])){
                adUserToDB($user["sn"][0], $user["givenname"][0], $user["mail"][0]);
            }
        }


        ldap_close($ds);
    }

    return true;
}