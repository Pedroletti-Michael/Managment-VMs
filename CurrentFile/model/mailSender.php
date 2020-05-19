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
 * This mail contains a direct link to the request of the user and some basic information about the request.
 * This mail is going to be send to the request user and in copy to the administrator.
 */
function requestMail($userMail, $requestName, $rtMail, $raMail){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $rtMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,
    <br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Votre demande est en cours de validation, vous recevrez bientôt un mail de confirmation avec toutes les informations nécessaires.
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
 * Function used to send a request with a direct link into the request to the administrator of the SI.
 */
function mailAdministrator($userMail, $requestName, $link){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $administratorMail;

    // subject
    $subject = 'Résumé de la demande pour une VM : '. $requestName;

    // message
    $message = "
    Bonjour,
    <br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Une demande a été mise par l'utilisateur utilisant l'adresse mail : ". $userMail .".<br>
    Voici le lien pour accéder à la demande : <a href='". $link ."'>ici</a>
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
function validateRequestMail($userMail, $requestName, $link, $rtMail, $raMail){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $rtMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,<br><br>
    Nom de la demande : ". $requestName ."
    <br><br>
    Votre commande a été validée. Vous pouvez donc vous rendre sous le lien ci-dessous pour obtenir toutes les informations nécessaires pour votre machine :<br>
    <a href='". $link ."'>ici</a>
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
 * This function used to send the denied validation for a request of vm to an user
 */
function deniedRequestMail($userMail, $requestName, $reason = null){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

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
 * This function used to send an advert mail to the technical manager, administrator manager and the admin of the VMManager
 * When the vm need to be renew.
 */
function advertMail($userMail, $requestName, $link, $rtMail, $raMail, $timeLeft){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $rtMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Résumé de votre demande pour une VM';

    // message
    $message = "
    Bonjour,<br><br>
    
    Nous vous envoyons ce mail pour vous informer que votre demande pour une VM arrive bientôt à échéance, il vous reste ".$timeLeft." jours.<br>
     
    Nom de la demande : ". $requestName ."<br>
    
    Nous nous permettons ainsi de vous envoyez ce mail afin que vous puissiez si vous le souhaitez renouveller votre demande, en suivant le lien ci-dessous :<br><br>
    
    ". $link ."<br><br>
    
    Toutes les informations nécessaires au renouvellement se trouve sur le lien, toutefois si vous avez une question vous pouvez nous contacter à cette adresse : vmmanger@heig-vd.ch<br><br>
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
 * This function used to send an advert mail to the technical manager, administrator manager and the admin of the VMManager
 * When the vm need to be renew.
 */
function nonrenewalMailAdvert($userMail, $requestName, $rtMail, $raMail){
    // multiple recipients
    $administratorMail = 'michael.pedroletti@heig-vd.ch';

    $to  = $userMail . ', ' . $rtMail . ', ' . $raMail . ', ' . $administratorMail;

    // subject
    $subject = 'Non-renouvellement de votre VM : '. $requestName;

    // message
    $message = "
    Bonjour,<br><br>
    
    Nous vous envoyons ce mail pour vous informer que la date limite de votre VM est échue.<br>
     
    Nom de la demande : ". $requestName ."<br>
    
    Étant donné que vous n'avez pas voulu la renouvelée via le lien précédent nous allons donc supprimer votre VM.<br>
    Votre VM ne sera donc dès à présent plus disponible.
    
    Toutefois si vous avez une question vous pouvez nous contacter à cette adresse : vmmanger@heig-vd.ch<br><br>
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

function isAnyMailToSend($idVm, $vmStatus, $userMail, $requestName, $rtMail, $raMail, $dateEndVm, $dateAnniversary){
    $link = 'http://vmman.heig-vd.ch/index.php?action=detailsVM&id='.$idVm;
    $today = date('Y-m-d');

    // Faire le check to les 6 mois
    if($vmStatus == 3){
        //Ex: Si aujourd'hui == à 12.04.2020 et que dateEnd == à 11.04.2020
        if($dateEndVm == null){
            if(strtotime($today) > strtotime($dateAnniversary)){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $link, $rtMail, $raMail);
                return true;
            }
            else{
                $diff = abs($dateAnniversary - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
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
                            break;
                        }
                        break;
                }
                return true;
            }
        }
        else{
            if($today > $dateEndVm){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $link, $rtMail, $raMail);
                return true;
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
                            break;
                        }
                        break;
                }
                return true;
            }
        }
    }
    else{
        if($dateEndVm == null){
            if(strtotime($today) > strtotime($dateAnniversary)){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $link, $rtMail, $raMail);
                return true;
            }
            else{
                $diff = abs($dateAnniversary - $today); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
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
                            break;
                        }
                        break;
                }
                return true;
            }
        }
        else{
            if($today > $dateEndVm){
                updateStatusVM($idVm, 4);
                nonrenewalMailAdvert($userMail, $requestName, $link, $rtMail, $raMail);
                return true;
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
                            break;
                        }
                        break;
                }
                return true;
            }
        }
    }
}
