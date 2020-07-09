<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 09.07.2020
 * Description : File used to manage all function used to make a notification, get a notification, etc...
 */

function addNotificationPush($action = "unknow"){
    $user = getUserCompleteName($_SESSION['userId']);
    $userType = $_SESSION['userType'];

    if($userType == 0){
        $message = $user[0][0]." ".$user[0][1]." étant un ";
    }
    elseif($userType == 1){
        $message = $user[0][0]." ".$user[0][1]." étant un ";
    }
    elseif ($userType == 2){
        $message = $user[0][0]." ".$user[0][1]." étant connecté comme viewer à fait ".$action.", à ".date("H:i:s Y-m-d");
    }
}