<?php
/**
 * Authors : Michael Pedroletti
 * CreationFile date : 20.05.2020
 **/
ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
        <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
        <script rel="javascript" src="../view/js/jquery.js"></script>
        <script rel="javascript" src="../view/js/script.js"></script>
        <script rel="javascript" src="../view/js/searchBox.js"></script>
        <meta charset="UTF-8">
        <title>Gestion VM - HEIG-VD</title>
    </head>
<body>
    <div class="container-fluid pt-3">
        <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Gestionnaire des alertes</h3>
        <form method="post" action="../index.php?action=saveAlertModification" class="mb-4">
            <div class="d-inline-block w-100">
                <!--Mail of administrator-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="adminMail" class="font-weight-bold">E-mail de l'administrateur<a style="color: red"> *</a></label>
                    <input type="email" class="form-control form form text-lowercase" id="adminMail" name="adminMail" value="<?= $jsonData['mailAdmin']; ?>" aria-describedby="adminMailHelp" placeholder="Ex: vmmanager@heig-vd.ch" required>
                    <small id="adminMailHelp" class="form-text text-muted">Adresse e-mail qui est en copie de tous les e-mails générés depuis cette plateforme.</small>
                </div>
                <!--Mail of sender-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="senderMail" class="font-weight-bold">E-mail de l'expéditeur<a style="color: red"> *</a></label>
                    <input type="email" class="form-control form form text-lowercase" id="senderMail" name="senderMail" value="<?= $jsonData['sender']; ?>" aria-describedby="senderMailHelp" placeholder="Ex: vmmanager@heig-vd.ch" required>
                    <small id="senderMailHelp" class="form-text text-muted">Adresse e-mail de l'expéditeur pour tous les e-mails générés depuis cette plateforme.</small>
                </div>
            </div>

            <!--Submit-->
            <button type='button' class='btn btn-primary'>Enregistrer</button>
            <button type="reset" style="margin-bottom: 10px;" class="btn btn-danger">Annuler</button>
        </form>
    </div>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>