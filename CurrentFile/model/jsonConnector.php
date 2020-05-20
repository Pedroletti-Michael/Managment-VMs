<?php
/**
 * Author : Michael Pedroletti
 * Date : 19.05.2020
 */

function getJsonData() {
    return json_decode(file_get_contents('data/alertManagementData.json'), true);
}

function saveJsonData($dataToWrite) {
    file_put_contents('data/alertManagementData.json', json_encode($dataToWrite, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}