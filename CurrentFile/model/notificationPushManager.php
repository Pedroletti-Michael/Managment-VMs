<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 09.07.2020
 * Description : File used to manage all function used to make a notification, get a notification, etc...
 */

function addNotificationPush($action = "unknow"){
    require_once 'model/userManager.php';
    require_once 'model/jsonConnector.php';
    $user = getUserCompleteName($_SESSION['userId']);
    $userType = $_SESSION['userType'];
    $message = "";

    if($userType == 0){
        $message = $user[0][0]." ".$user[0][1]." étant connecté comme utilisateur à fait ".$action.", à ".date("H:i:s Y-m-d");
    }
    elseif($userType == 1){
        $message = $user[0][0]." ".$user[0][1]." étant connecté comme administrateur à fait ".$action.", à ".date("H:i:s Y-m-d");
    }
    elseif ($userType == 2){
        $message = $user[0][0]." ".$user[0][1]." étant connecté comme viewer à fait ".$action.", à ".date("H:i:s Y-m-d");
    }

    $actualJsonData = getJsonData(9);
    $actualNotificationPush = $actualJsonData['notifications'];

    array_push($actualNotificationPush, $message);

    $actualJsonData['id'] = $actualJsonData['id'] + 1;


    if($actualJsonData['id'] > 200){
        for($i = 0; $i < 200; $i++){
            array_push($actualJsonData['notifications'], $actualNotificationPush[$actualJsonData['id']-$i]);
        }
    }
    else{
        $actualJsonData['notifications'] = $actualNotificationPush;
    }

    return saveJsonData($actualJsonData, 9);
}

function getFiveNotificationPush(){
    require_once 'model/jsonConnector.php';
    $actualJsonData = getJsonData(9);
    $actualNotificationPush = $actualJsonData['notifications'];

    $theFiveNotifications = array();

    for($i = 0; $i < 5; $i++){
        array_push($theFiveNotifications, $actualNotificationPush[$actualJsonData['id'] - $i - 1]);
    }
    return $theFiveNotifications;
}

function getAllNotificationPush(){
    require_once 'model/jsonConnector.php';
    $actualJsonData = getJsonData(9);
    $actualNotificationPush = $actualJsonData['notifications'];

    return $actualNotificationPush;
}