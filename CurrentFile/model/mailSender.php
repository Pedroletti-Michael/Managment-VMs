<?php
/**
 * User: Michael Pedroletti
 * Date: 30.03.2020
 * Time: 10:39
 */
require_once "model/jsonConnector.php";

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
 * This mail contains a direct link to the request of the user and some basic information about the request.
 * This mail is going to be send to the request user and in copy to the administrator.
 */
function requestMail($userMail, $requestName, $rtMail, $raMail, $tableInfo){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['requestMail']) && $mailContent['requestMail'] != null || $mailContent['requestMail'] != ''){
        $messageToTreatment = $mailContent['requestMail'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7" && $value != "8" && $value != "9"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "3"){
                    $message .= " ".$rtMail." ";
                }
                if($value == "4"){
                    $message .= " ".$raMail." ";
                }
                if($value == "8"){
                    foreach($tableInfo as $key => $value){
                        $message .= $key. " : " . $value . "<br>";
                    }
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,
        <br><br>
        Nom de la demande : ". $requestName ."
        <br><br>
        Votre demande est en cours de validation, vous recevrez bientôt un mail de confirmation avec toutes les informations nécessaires.
        ";
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'BCC: '.$rtMail."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Function used to send a request with a direct link into the request to the administrator of the SI.
 */
function mailAdministrator($userMail, $requestName, $link, $tableInfo){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $administratorMail;

    // subject
    $subject = 'Résumé de la demande pour une VM : '. $requestName;

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['mailToAdminstratorRequest']) && $mailContent['mailToAdminstratorRequest'] != null || $mailContent['mailToAdminstratorRequest'] != ''){
        $messageToTreatment = $mailContent['mailToAdminstratorRequest'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7" && $value != "8" && $value != "9"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "5"){
                    $message .= " ".$link." ";
                }
                if($value == "8"){
                    foreach($tableInfo as $key => $value){
                        $message .= $key. " : " . $value . "<br>";
                    }
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,
        <br><br>
        Nom de la demande : ". $requestName ."
        <br><br>
        Une demande a été mise par l'utilisateur utilisant l'adresse mail : ". $userMail .".<br>
        Voici le lien pour accéder à la demande : <a href='". $link ."'>ici</a>
        ";
    }

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $administratorMail ."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

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
function validateRequestMail($userMail, $requestName, $link, $rtMail, $raMail, $tableInfo){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['validateRequestMail']) && $mailContent['validateRequestMail'] != null || $mailContent['validateRequestMail'] != ''){
        $messageToTreatment = $mailContent['validateRequestMail'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7" && $value != "8" && $value != "9"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "3"){
                    $message .= " ".$rtMail." ";
                }
                if($value == "4"){
                    $message .= " ".$raMail." ";
                }
                if($value == "5"){
                    $message .= " ".$link." ";
                }
                if($value == "9"){
                    foreach($tableInfo as $key => $value){
                        $message .= $key. " : " . $value . "<br>";
                    }
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,<br><br>
        Nom de la demande : ". $requestName ."
        <br><br>
        Votre commande a été validée. Vous pouvez donc vous rendre sous le lien ci-dessous pour obtenir toutes les informations nécessaires pour votre machine :<br>
        <a href='". $link ."'>ici</a>
        ";
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'BCC: '.$rtMail."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * This function used to send a json file with all information about a validate request. She used after a validation of
 * a vm request
 */
function administratorMailValidateRequest($requestName, $link, $dataFile){
    require_once 'model/jsonConnector.php';
    $jsonData = getJsonData(0);
    $sender = $jsonData['sender'];
    $administratorMail = $jsonData['mailAdmin'];

    // Recipient
    $to = $administratorMail;

    // Sender
    $from = $sender;
    $fromName = $sender;

    // Email subject
    $subject = 'Confirmation de validation requête : '.$requestName;

    // Attachment file
    $fileName = 'dataFrom'.$requestName.strtotime(date("Y-m-d H:i:s"));
    $file = 'data/'.$fileName.'.json';
    saveJsonData($dataFile, null, $file);

    // Email body content
    $mailContent = getJsonData(1);
    if(isset($mailContent['administratorMailValidateRequest']) && $mailContent['administratorMailValidateRequest'] != null || $mailContent['administratorMailValidateRequest'] != ''){
        $messageToTreatment = $mailContent['administratorMailValidateRequest'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $htmlContent = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7" && $value != "8" && $value != "9"){
                $htmlContent .= $value;
            }
            elseif($value != ''){
                if($value == "2"){
                    $htmlContent .= " ".$requestName." ";
                }
                if($value == "5"){
                    $htmlContent .= " ".$link." ";
                }
            }
        }
    }
    else{
        $htmlContent = ' 
        Bonjour,<br>
        <p>
        Vous venez de valider une VM, voici un mail de confirmation avec un fichier Json contenant toutes les données de la VM validée.<br>
        Vous pouvez directement vous rendre sur les détails de la requête depuis <a href="'.$link.'">ici</a>
        </p>
        ';
    }



    // Header for sender info
    $headers = "From: $fromName"." <".$from.">";

    // Boundary
    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    // Headers for attachment
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

    // Multipart boundary
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

    // Preparing attachment
    if(!empty($file) > 0){
        if(is_file($file)){
            $message .= "--{$mime_boundary}\n";
            $fp =    @fopen($file,"rb");
            $data =  @fread($fp,filesize($file));

            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
                "Content-Description: ".basename($file)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
    }
    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $from;

    // Send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath);

    if($mail){
        return true;
    }
    else{
        return false;
    }
}

/**
 * This function used to send the denied validation for a request of vm to an user
 */
function deniedRequestMail($userMail, $requestName, $reason = null){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $administratorMail;

    // subject
    $subject = 'La demande pour votre VM n\'a pas été validée';

    // message
    if($reason == null){
        $message = '
            <p>Nom de la demande : '. $requestName .' </p>
            <br>
            <p>Votre demande pour une VM n\'a pas été validée.</p>
            <br>
            <p>
                Nous ne pouvons malheureusement pas accéder à votre requête.
            </p>
            ';
    }
    else{
        $mailContent = getJsonData(1);
        if(isset($mailContent['deniedRequestMail']) && $mailContent['deniedRequestMail'] != null || $mailContent['deniedRequestMail'] != ''){
            $messageToTreatment = $mailContent['deniedRequestMail'];
            $messageToTreatment = explode("\\", $messageToTreatment);

            $message = '';
            foreach($messageToTreatment as $value){
                if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7"){
                    $message .= $value;
                }
                elseif($value != ''){
                    if($value == "1"){
                        $message .= " ".$userMail." ";
                    }
                    if($value == "2"){
                        $message .= " ".$requestName." ";
                    }
                    if($value == "6"){
                        $message .= " ".$reason." ";
                    }
                }
            }
        }
        else{
            $message = '
            <p>Nom de la demande : '. $requestName .' </p>
            <br>
            <p>Votre demande pour une VM n\'a pas été validée.</p>
            <br>
            <p>
                '.$reason.'
            </p>
            ';
        }
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }

}

/**
 * This function used to send an advert mail to the technical manager, administrator manager and the admin of the VMManager
 * When the vm need to be renew.
 */
function advertMail($userMail, $requestName, $link, $rtMail, $raMail, $timeLeft){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['advertMail']) && $mailContent['advertMail'] != null || $mailContent['advertMail'] != ''){
        $messageToTreatment = $mailContent['advertMail'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "3"){
                    $message .= " ".$rtMail." ";
                }
                if($value == "4"){
                    $message .= " ".$raMail." ";
                }
                if($value == "5"){
                    $message .= " ".$link." ";
                }
                if($value == "7"){
                    $message .= " ".$timeLeft." ";
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,<br><br>
        
        Nous vous envoyons ce mail pour vous informer que votre demande pour une VM arrive bientôt à échéance, il vous reste ".$timeLeft." jours.<br>
         
        Nom de la demande : ". $requestName ."<br>
        
        Nous nous permettons ainsi de vous envoyez ce mail afin que vous puissiez si vous le souhaitez renouveller votre demande, en suivant le lien ci-dessous :<br><br>
        
        <a href='https://vmman.heig-vd.ch/index.php?action=renewalVM'>Lien vers la page de renouvellements</a><br>
        
        <a href='". $link ."'>Lien des détails de votre machine</a><br><br>
        
        Toutes les informations nécessaires au renouvellement se trouve sur le lien, toutefois si vous avez une question vous pouvez nous contacter à cette adresse : vmmanger@heig-vd.ch<br><br>
        ";
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'BCC: '.$rtMail."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * This function used to send an advert mail to the technical manager, administrator manager and the admin of the VMManager
 * When the vm need to be renew.
 */
function nonrenewalMailAdvert($userMail, $requestName, $rtMail, $raMail){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Non-renouvellement de votre VM : '. $requestName;

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['nonrenewalMailAdvert']) && $mailContent['nonrenewalMailAdvert'] != null || $mailContent['nonrenewalMailAdvert'] != ''){
        $messageToTreatment = $mailContent['nonrenewalMailAdvert'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "3"){
                    $message .= " ".$rtMail." ";
                }
                if($value == "4"){
                    $message .= " ".$raMail." ";
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,<br><br>
        
        Nous vous envoyons ce mail pour vous informer que la date limite de votre VM est échue.<br>
         
        Nom de la demande : ". $requestName ."<br>
        
        Étant donné que vous n'avez pas voulu la renouvelée via le lien précédent nous allons donc supprimer votre VM.<br>
        Votre VM ne sera donc dès à présent plus disponible.
        
        Toutefois si vous avez une question vous pouvez nous contacter à cette adresse : vmmanger@heig-vd.ch<br><br>
        ";
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $raMail ."\r\n";
    $headers .= 'BCC: '.$rtMail.";$userMail;$administratorMail\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

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
function renewalMail($userMail, $requestName, $link, $rtMail, $raMail){
    // multiple recipients
    $jsonData = getJsonData(0);
    $administratorMail = $jsonData['mailAdmin'];

    $to  = $userMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $mailContent = getJsonData(1);
    if(isset($mailContent['renewalMail']) && $mailContent['renewalMail'] != null || $mailContent['renewalMail'] != ''){
        $messageToTreatment = $mailContent['renewalMail'];
        $messageToTreatment = explode("\\", $messageToTreatment);

        $message = '';
        foreach($messageToTreatment as $value){
            if($value != '' && $value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5" && $value != "6" && $value != "7" && $value != "8" && $value != "9"){
                $message .= $value;
            }
            elseif($value != ''){
                if($value == "1"){
                    $message .= " ".$userMail." ";
                }
                if($value == "2"){
                    $message .= " ".$requestName." ";
                }
                if($value == "3"){
                    $message .= " ".$rtMail." ";
                }
                if($value == "4"){
                    $message .= " ".$raMail." ";
                }
                if($value == "5"){
                    $message .= " ".$link." ";
                }
            }
        }
    }
    else{
        $message = "
        Bonjour,<br><br>
        Nom de la demande : ". $requestName ."
        <br><br>
        Votre commande a été validée. Vous pouvez donc vous rendre sous le lien ci-dessous pour obtenir toutes les informations nécessaires pour votre machine :<br>
        <a href='". $link ."'>ici</a>
        ";
    }


    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $userMail ."\r\n";
    $headers .= 'BCC: '.$rtMail."\r\n";
    $headers .= 'From: '.$jsonData['sender']."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

function isAnyMailToSend($idVm, $vmStatus, $userMail, $requestName, $rtMail, $raMail, $dateEndVm, $dateAnniversary){
    $link = 'https://vmman.heig-vd.ch/index.php?action=detailsVM&id='.$idVm;
    $today = strtotime(date('Y-m-d'));
    $dateAnniversary = strtotime($dateAnniversary);
    $dateEndVm = strtotime($dateEndVm);

    // Si le statut de la VM est égal a "à renouveler"
    if($vmStatus == 3){
        // Si la date de fin n'existe pas
        if($dateEndVm == null){
            // Si la date du jour est plus grande que la date d'anniversaire
            if($today > $dateAnniversary){
                // On pas la VM en status "non-renouvelée" et on envoie un mail
                updateStatusVM($idVm, 4);
                return false;
            }
            else{
                // Si la date du jour est plus petite on regarde de combien
                $diff = abs($dateAnniversary - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
                $dateDiff = array();

                $tmp = $diff;
                $dateDiff['second'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['second'])/60 );
                $dateDiff['minute'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['minute'])/60 );
                $dateDiff['hour'] = $tmp % 24;

                $tmp = floor( ($tmp - $dateDiff['hour'])  /24 );
                $dateDiff['day'] = $tmp;

                // Si le nombre de jour restant est égal à un des chiffre si-dessous alors on envoit un mail d'avertissement pour que l'utilisateur puisse aller renouveler sa demande
                switch ($dateDiff['day']){
                    case 1:
                    case 2:
                    case 3:
                    case 5:
                    case 10:
                    case 15:
                    case 20:
                    case 30:
                        advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        break;
                    default:
                        if($dateDiff['day'] == 30){
                            advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        }
                        break;
                }
                return true;
            }
        }
        else{
            if($today > $dateEndVm){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $rtMail, $raMail);
                return false;
            }
            else{
                $diff = abs($dateEndVm - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
                $dateDiff = array();

                $tmp = $diff;
                $dateDiff['second'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['second']) /60 );
                $dateDiff['minute'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['minute'])/60 );
                $dateDiff['hour'] = $tmp % 24;

                $tmp = floor( ($tmp - $dateDiff['hour'])  /24 );
                $dateDiff['day'] = $tmp;

                switch ($dateDiff['day']){
                    case 1:
                    case 2:
                    case 3:
                    case 5:
                    case 10:
                    case 15:
                    case 20:
                    case 30:
                        advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        break;
                    default:
                        if($dateDiff['day'] == 30){
                            advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        }
                        break;
                }
                return true;
            }
        }
    }
    else{
        if($dateEndVm == null){
            if($today > $dateAnniversary){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $rtMail, $raMail);
                return false;
            }
            else{
                $diff = abs($dateAnniversary - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
                $dateDiff = array();

                $tmp = $diff;
                $dateDiff['second'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['second'])/60 );
                $dateDiff['minute'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['minute'])/60 );
                $dateDiff['hour'] = $tmp % 24;

                $tmp = floor( ($tmp - $dateDiff['hour'])  /24 );
                $dateDiff['day'] = $tmp;

                switch ($dateDiff['day']){
                    case 1:
                    case 2:
                    case 3:
                    case 5:
                    case 10:
                    case 15:
                    case 20:
                    case 30:
                        if(updateStatusVM($idVm, 3)){
                            advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        }
                        break;
                    default:
                        if($dateDiff['day'] == 30){
                            if(updateStatusVM($idVm, 3)){
                                advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                            }
                        }
                        break;
                }
                return true;
            }
        }
        else{
            if($today > $dateEndVm){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $rtMail, $raMail);
                return false;
            }
            else{
                $diff = abs($dateEndVm - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
                $dateDiff = array();

                $tmp = $diff;
                $dateDiff['second'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['second']) /60 );
                $dateDiff['minute'] = $tmp % 60;

                $tmp = floor( ($tmp - $dateDiff['minute'])/60 );
                $dateDiff['hour'] = $tmp % 24;

                $tmp = floor( ($tmp - $dateDiff['hour'])  /24 );
                $dateDiff['day'] = $tmp;

                switch ($dateDiff['day']){
                    case 1:
                    case 2:
                    case 3:
                    case 5:
                    case 10:
                    case 15:
                    case 20:
                    case 30:
                        if(updateStatusVM($idVm, 3)){
                            advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                        }
                        break;
                    default:
                        if($dateDiff['day'] == 30){
                            if(updateStatusVM($idVm, 3)){
                                advertMail($userMail, $requestName, $link, $rtMail, $raMail, $dateDiff['day']);
                            }
                        }
                        break;
                }
                return true;
            }
        }
    }
}
