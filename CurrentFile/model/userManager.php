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

/**
 * Get all users from DB
 */
function getAllUsers(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user ORDER BY lastname ASC';

    return executeQuerySelect($query);
}

/**
 * Get all users from DB sort by name (A-Z)
 */
function getAllUsersAscendant(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user ORDER BY lastname ASC';

    return executeQuerySelect($query);
}

/**
 * Get all users from DB sort by name (Z-A)
 */
function getAllUsersDescendant(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user ORDER BY lastname DESC';

    return executeQuerySelect($query);
}

/**
 * @return array|null
 */
function getAllAdmin(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user WHERE type = 1 ORDER BY lastname ASC';

    return executeQuerySelect($query);
}

function getAllViewer(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user WHERE type = 2 ORDER BY lastname ASC';

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
 * Get all user id from db and return into a table
 */
function getAllUserId(){
    $query = "SELECT user_id FROM `user`";

    return executeQuery($query);
}

/**
 * Update the type of the user.
 * If $type == true, update type of the user into an admin
 * else update user into an user
 * $userId is the id of the target
 * return true
 */
function updateType($userId, $type){
    if($type == 2){
        //viewer query
        $query = "UPDATE user SET type = 2 WHERE user_id = ". $userId;

        executeQuery($query);
    }
    elseif($type == true){
        //admin query
        $query = "UPDATE user SET type = 1 WHERE user_id = ". $userId;

        executeQuery($query);
    }
    else{
        //user query
        $query = "UPDATE user SET type = 0 WHERE user_id = ". $userId;

        executeQuery($query);
    }
    return true;
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

    require_once 'model/encryption.php';
    $uncodePwd = decrypt("mkHndhU83csnUia.Dhjc73jhSExwK1NVcCo=");

    $r=ldap_bind($ds, "einetjoin@einet.ad.eivd.ch", $uncodePwd); // We need to find an way to connect. Because we need to be connected to research user

    if ($ds) {
        // Get all user from ou=Personnel
        $filter = "(uid=*)";

        $sr = ldap_search($ds, "ou=personnel,dc=einet,dc=ad,dc=eivd,dc=ch", "samaccountname=*");

        $info = ldap_get_entries($ds, $sr);

        $message = 'variables : '. count($info);

        $newUser = 0;
        foreach ($info as $user){
            //before array push verify if user is already in db if the user is not so add the user into db.
            if (!dbVerification($user['mail'][0])){
                adUserToDB($user["sn"][0], $user["givenname"][0], $user["mail"][0]);
                $newUser++;
            }
        }

        $newUser -= 3;

        if($newUser == 0){
            echo '<script type="text/javascript">window.alert("'.$message.' utilisateurs récupéré de l\'AD. Aucun nouvel utilisateur ajouté. Base de données à jour.");</script>';
        }
        elseif($newUser == 1){
            echo '<script type="text/javascript">window.alert("'.$message.' utilisateurs récupéré de l\'AD. 1 nouvel utilisateur ajouté. Base de données à jour.");</script>';
        }
        else{
            echo '<script type="text/javascript">window.alert("'.$message.' utilisateurs récupéré de l\'AD. '.$newUser.' utilisateurs ajoutés. Base de données à jour.");</script>';
        }

        ldap_close($ds);
    }

    return true;
}

function userRtVerification(){
    //get all user from db

    //get all userRt and cluster from requestVm in db

    //compare
}