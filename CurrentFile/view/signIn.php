<?php

/**
 **/

ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign In- HEIG-VD</title>
    </head>
    <body>
    <div class="mr-auto ml-auto mb-auto" style="width: 700px; margin-top: 17%">
        <div class="d-inline-block bg-light pr-3 m-auto">
            <div class="float-left border-right">
                <img src="../images/logo-heig-vd.png" style="max-height: 230px">
            </div>
            <div class="float-right pl-3">
                <form method="post" action="RequestLogin" >
                    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-2 pt-1">Se connecter</h3>
                    <div class="d-inline-block w-100 pt-2 mb-2">
                        <label for="inputLogin" class="font-weight-bold">Nom d'utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">einet \</div>
                            </div>
                            <input type="text" class="form-control" id="userLogin" placeholder="login AAI">
                        </div>
                    </div>
                    <div class="d-inline-block w-100">
                        <label for="inputPassword" class="font-weight-bold">Mot de passe</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="password" class="form-control" id="userPassword" placeholder="Password">
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group btn btn-success disabled rounded-right">
                                    --->
                            </div>
                        </div>
                        </div>
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
