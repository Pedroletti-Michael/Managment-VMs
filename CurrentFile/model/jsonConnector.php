<?php
/**
 * Author : Michael Pedroletti
 * Date : 19.05.2020
 */

function getJsonData($n) {
    if($n == 0){
        $file = 'data/alertManagementData.json';
    }
    else{
        $file = 'data/mailContent.json';
    }

    return json_decode(file_get_contents($file), true);
}

function saveJsonData($dataToWrite, $n, $newFile = null) {
    if($newFile == null){
        if($n == 0){
            $file = 'data/alertManagementData.json';
        }
        else{
            $file = 'data/mailContent.json';
        }

        if(file_put_contents($file, json_encode($dataToWrite, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT))){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        if(file_put_contents($newFile, json_encode($dataToWrite, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT))){
            return true;
        }
        else{
            return false;
        }
    }


}