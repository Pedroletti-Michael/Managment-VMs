<?php

/**
 * Authors : Théo Cook
 * CreationFile date : 17.03.2020
 * ModifFile date : 31.03.2020
 **/

ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign In - HEIG-VD</title>
    </head>
    <body class="responsive-phone-bg fixed-top">
    <div class="mr-auto ml-auto responsive-phone" style="width: 700px; margin-top: 17%;">
        <div class="d-inline-block bg-light m-auto">
            <div class="p-2">
                <img src="../images/logo-gabarit.png" class="w-100 h-auto" ">
            </div>
            <div class="w-100 pl-3 pr-3">
                <form method="post" action="../index.php?action=RequestLogin">
                    <div class="d-inline-block w-100 pt-2 mb-2">
                        <label for="inputLogin" class="font-weight-bold">Nom d'utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 ">
                            <input type="text" class="form-control" id="userLogin" name="userLogin" placeholder="Login AAI" required>
                        </div>
                    </div>
                    <div class="d-inline-block w-100 pb-2">
                        <label for="inputPassword" class="font-weight-bold">Mot de passe</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="password" class="form-control w-100" id="userPassword" name="userPassword" placeholder="Mot de passe" required>
                        </div>
                        <div class="w-100 mb-2"><a>Un problème pour vous connecter ? Contactez le <a href="mailto:helpdesk@heig-vd.ch?subject=Plateforme GVM : [Titre de votre message]">helpdesk</a></a></div>
                        <button type="submit" class="input-group btn btn-success w-auto m-auto w3-center">Connexion</button>
                    </div>
                    <?php
                        if(isset($_POST['error']) && $_POST['error'] == "credentials"){
                            echo "<div style='color: red'>Indentifiant ou mot de passe invalide.</div>";
                        }
                        if(isset($_POST['error']) && $_POST['error'] == "fieldEmpty"){
                            echo "<div style='color: red'>Veuillez renseigner tous les champs !</div>";
                        }
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
