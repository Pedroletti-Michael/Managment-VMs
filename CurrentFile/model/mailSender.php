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
 * This mail is going to be send to the request user and in copy to the administrator.
 */
function requestMail($userMail, $requestName){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,
    <br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Votre demande est en cours de validation, vous recevrez bientôt un mail de confirmation avec toutes les informations nécessaires.
    <br><br>
    Meilleures salutations.
    VmManager
    ";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'From: VMManager <vmManager@heig-vd.ch>' . "\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}


function mailAdministrator($userMail, $requestName, $link){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,
    <br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Une demande a été mise par l'utilisateur utilisant l'adresse mail : ". $userMail .".<br>
    Voici le lien pour accéder à la demande : ". $link .".
    <br><br>
    Meilleures salutations
    <br>
    VmManager
    ";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $administratorMail ."\r\n";
    $headers .= 'From: VMManager <vmManager@heig-vd.ch>' . "\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}


/**
 * This function used to send the validation for a request of vm to an user.
 */
function validateRequestMail($userMail, $requestName, $link){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,<br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Votre commande a été validée. Vous pouvez donc vous rendre sous le lien ci-dessous pour obtenir toutes les informations nécessaires pour votre machine :<br>
    ". $link ."
    <br><br>
    Meilleures salutations.
    VmManager
    ";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'From: VMManager <vmManager@heig-vd.ch>' . "\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * This function used to send the declined validation for a request of vm to an user
 */
function deniedRequestMail($userMail, $requestName){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $administratorMail;

    // subject
    $subject = 'Demande pour votre VM refusée';

    // message
        $message = '
    <html>
    <head>
        <title>Demande pour votre VM <bold>refusée</bold></title>
    </head>
    <body>
        <p>Nom de la demande : '. $requestName .' </p>
        <br>
        <p>Votre demande pour une VM a été refusée.</p>
        <br>
        <p>
            Nous ne pouvons malheureusement pas accéder à votre requête.
        </p>
        <br>
        <p>
            Meilleures salutations.
            VmManager
        </p>
    </body>
    </html>
    ';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'From: VMManager <vmManager@heig-vd.ch>' . "\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }

}