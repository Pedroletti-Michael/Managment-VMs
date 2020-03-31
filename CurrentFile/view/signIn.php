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
        <title>Sign In- HEIG-VD</title>
    </head>
    <body class="responsive-phone-bg">
    <div class="mr-auto ml-auto mb-auto responsive-phone" style="width: 700px; margin-top: 17%">
        <div class="d-inline-block bg-light pr-3 m-auto">
            <div class="float-left border-right display-laptop">
                <img src="../images/logo-heig-vd.png" style="max-height: 230px">
            </div>
            <div class="float-right pl-3">
                <form method="post" action="../index.php?action=RequestLogin">
                    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-2 pt-1">Se connecter</h3>
                    <div class="d-inline-block w-100 pt-2 mb-2">
                        <label for="inputLogin" class="font-weight-bold">Nom d'utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">einet \</div>
                            </div>
                            <input type="text" class="form-control" id="userLogin" name="userLogin" placeholder="login AAI" required>
                        </div>
                    </div>
                    <div class="d-inline-block w-100">
                        <label for="inputPassword" class="font-weight-bold">Mot de passe</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password" required>
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group btn btn-success disabled rounded-right">
                                    --->
                            </div>
                        </div>
                        </div>
                    <?php
                        if(isset($_POST['error']) && $_POST['error'] == "credentials"){
                            echo "<div>Identifiant ou mot de passe faux !</div>";
                        }
                        if(isset($_POST['error']) && $_POST['error'] == "fieldEmpty"){
                            echo "<div>Veuillez renseigner tous les champs !</div>";
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
