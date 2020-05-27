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
                    <input type="email" class="form-control form form text-lowercase" id="adminMail" name="adminMail" value="<?= $alertJsonData['mailAdmin']; ?>" aria-describedby="adminMailHelp" placeholder="Ex: vmmanager@heig-vd.ch" required>
                    <small id="adminMailHelp" class="form-text text-muted">Adresse e-mail qui est en copie de tous les e-mails générés depuis cette plateforme.</small>
                </div>
                <!--Mail of sender-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="senderMail" class="font-weight-bold">E-mail de l'expéditeur<a style="color: red"> *</a></label>
                    <input type="email" class="form-control form form text-lowercase" id="senderMail" name="senderMail" value="<?= $alertJsonData['sender']; ?>" aria-describedby="senderMailHelp" placeholder="Ex: vmmanager@heig-vd.ch" required>
                    <small id="senderMailHelp" class="form-text text-muted">Adresse e-mail de l'expéditeur pour tous les e-mails générés depuis cette plateforme.</small>
                </div>
            </div>

            <!--Submit-->
            <button type='submit' class='btn btn-primary'>Enregistrer</button>
            <button type="reset" style="margin-bottom: 10px;" class="btn btn-danger">Annuler</button>
        </form>
        <h4 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Contenus des e-mails</h4>
        <p class="text-center">
            Listes des variables utilisables dans les différents contenu de mail (format d'utilisation = \nb_var\):<br>
            1. e-mail de l'utilisateur | 2. nom de la requête | 3. e-mail du RT | 4. e-mail du RA | 5. lien vers la requête | 6. raison d'un refus | 7. temps restant<br>
            <span class="font-weight-bold">Veillez à prêter attention aux différentes variables utilisables selon le mail que vous écrivez. Cette information est disponible en dessous de l'espace pour écrire.</span><br>
            Exemple d'utilisation : La commande \2\ est prête...!
        </p>
        <form method="post" action="../index.php?action=saveContentMail" class="mb-4">
            <div class="d-inline-block w-100">
                <!--Content of request mail-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="requestMail" class="font-weight-bold">Contenu du mail de confirmation de requête<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="requestMail" name="requestMail" aria-describedby="requestMailHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['requestMail']; ?></textarea>
                    <small id="requestMailHelp" class="form-text text-muted font-weight-bold">Variables utilisables : 1. e-mail de l'utilisateur | 2. nom de la requête | 3. e-mail du RT | 4. e-mail du RA</small>
                </div>
                <!--Content mail Administrator for request-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="mailToAdminstratorRequest" class="font-weight-bold">Contenu du mail de confirmation de requête envoyer à l'administrateur<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="mailToAdminstratorRequest" name="mailToAdminstratorRequest" aria-describedby="mailToAdminstratorRequestHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['mailToAdminstratorRequest']; ?></textarea>
                    <small id="mailToAdminstratorRequestHelp" class="form-text text-muted">Variables utilisables : 1. e-mail de l'utilisateur | 2. nom de la requête | 5. lien vers la requête</small>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <!--Content of validation mail-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="validateRequestMail" class="font-weight-bold">Contenu du mail de validation d'une requête<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="validateRequestMail" name="validateRequestMail" aria-describedby="validateRequestMailHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['validateRequestMail']; ?></textarea>
                    <small id="validateRequestMailHelp" class="form-text text-muted">Contenu du mail envoyer lors de la validation d'une requête par un administrateur à destination des utilisateurs membres de la requête.</small>
                </div>
                <!--Content mail denied-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="deniedRequestMail" class="font-weight-bold">Contenu du mail de refus d'une requête<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="deniedRequestMail" name="deniedRequestMail" aria-describedby="deniedRequestMailHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['deniedRequestMail']; ?></textarea>
                    <small id="deniedRequestMailHelp" class="form-text text-muted">Contenu du mail de refus de la prise en charge d'une VM envoyer si l'administrateur n'a pas remplit de raison</small>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <!--Content mail advert for renewal-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="advertMail" class="font-weight-bold">Contenu du mail d'avertissement (renouvellement)<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="advertMail" name="advertMail" aria-describedby="advertMailHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['advertMail']; ?></textarea>
                    <small id="advertMailHelp" class="form-text text-muted">Contenu du mail d'avertissement lorsqu'une VM à besoin d'être renouvelée.</small>
                </div>
                <!--Content for nonrenewal request-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="nonrenewalMailAdvert" class="font-weight-bold">Contenu du mail de non-renouvellement d'une VM<a style="color: red"> *</a></label>
                    <textarea rows="15" style="resize: none" class="form-control form form text-lowercase" id="nonrenewalMailAdvert" name="nonrenewalMailAdvert" aria-describedby="nonrenewalMailAdvertHelp" placeholder="Ex: Bonjour,<br>..." required><?= $mailContentJsonData['nonrenewalMailAdvert']; ?></textarea>
                    <small id="nonrenewalMailAdvertHelp" class="form-text text-muted">Contenu du mail de non-renouvellement envoyer aux utilisateurs concernés</small>
                </div>
            </div>

            <!--Submit-->
            <button type='submit' class='btn btn-primary'>Enregistrer</button>
            <button type="reset" style="margin-bottom: 10px;" class="btn btn-danger">Annuler</button>
        </form>
    </div>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>