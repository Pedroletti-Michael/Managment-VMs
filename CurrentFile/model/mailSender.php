<?php
/**
 * User: Michael Pedroletti
 * Date: 30.03.2020
 * Time: 10:39
 */

/**
 * function used to send the mail and return true or false
 * @param $to = the user who receive the mail
 * @param $subject = subject of the mail
 * @param $message = the message of the mail
 * @param $headers = the headers of the mail
 * @return bool = True = successfully sending | False = Failed to send
 */
function sendMail($to, $subject, $message, $headers){

    if (mail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Function used to send a request to the administrator of the SI.
 * This mail contains a direct link to the request of the user and some basic information about the request.
 */
function requestMail($userMail){
    // Mise en page du mail
}

/**
 * This function used to send the validation for a request of vm to an user.
 */
function validateRequestMail($userMail){
    // Mise en page du mail
}

/**
 * This function used to send the declined validation for a request of vm to an user
 */
function deniedRequestMail($userMail){
    //TODO Modifier la fonciton afin qu'elle correspondent aux attentes.

    // multiple recipients
    $to  = $userMail . ', ' . 'michael.pedroletti@heig-vd.ch';

    // subject
        $subject = 'Demande pour votre VM refusée';

    // message
        $message = '
    <html>
    <head>
      <title>Demande pour votre VM <bold>refusée</bold></title>
    </head>
    <body>
      <p>Votre demande pour une VM a été refusée.</p>
      <table>
        <tr>
          <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
        </tr>
        <tr>
          <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
        </tr>
        <tr>
          <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
        </tr>
      </table>
    </body>
    </html>
    ';

    // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
        $headers .= 'To: '. $userMail ."\r\n";
        $headers .= 'From: VMManager <vmManager@heig-vd.ch>' . "\r\n";
}