<?php

/**
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Demande VM - HEIG-VD</title>
</head>
<body>
<div class="container-fluid pt-3">
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Formulaire de demande de VM</h3>
    <form method="post" action="../index.php?action=RequestVM" class="mb-4">
        <div class="d-inline-block w-100">
            <!--Name of the VM-->
            <div class="form-group w-50 float-left pr-4">
                <label for="inputVMName" class="font-weight-bold">Nom de la VM<a style="color: red"> *</a></label>
                <input type="vmName" class="form-control form form" id="inputVMName" name="inputVMName" aria-describedby="vmNameHelp" maxlength="15" required>
                <small id="vmNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Ex: VM-01)</small>
            </div>
            <!--Name of the requester-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputRequesterName" class="font-weight-bold">Demandeur<a style="color: red"> *</a></label>
                <input type="requesterName" class="form-control form form" value="<?php echo $_SESSION['userEmail'] ?>" id="inputRequesterName" name="inputRequesterName" aria-describedby="requesterNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" disabled>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--CPU-->
                <label for="cpu" class="font-weight-bold">Nombre de CPU<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form" id="inputCPU" name="inputCPU" aria-describedby="cpuHelp" min="1" max="99" required>
            </div>
            <!--Name of the technical manager-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputTMName" class="font-weight-bold">Responable technique<a style="color: red"> *</a></label>
                <input type="tmName" class="form-control form form" id="inputTMName" name="inputTMName" aria-describedby="tmNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--RAM-->
                <label for="RAM" class="font-weight-bold mr-2">Nombre de RAM (GB)<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form mr-3" id="inputRAM" name="inputRAM" aria-describedby="ramHelp" min="1" max="256" required>
            </div>
            <!--Name of the responsible administrator-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputRAName" class="font-weight-bold">Responsable administratif<a style="color: red"> *</a></label>
                <input type="raName" class="form-control form form" id="inputRAName" name="inputRAName" aria-describedby="raNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                <small id="raNameHelp" class="form-text text-muted">Direction, Doyen , Directeur d'institut ou Chef de service</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--Stockages-->
                <label for="SSD" class="font-weight-bold mr-2">Stockage SSD (GB)<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form" id="inputSSD" name="inputSSD" aria-describedby="ssdHelp" min="20" max="1000" required>
            </div>
            <!--Department / Institution / Service-->
            <div class="form-group w-50 float-right pl-4">
                <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service<a style="color: red"> *</a></label>
                <select class="form-control" id="disFormControlSelect" name="disFormControlSelect" required>
                    <?php
                    foreach ($entityNames as $value) {
                        echo "<option>".$value['entityName']."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--OS-->
            <div class="form-group w-50 float-left pr-4">
                <label for="osFormControlSelect" class="font-weight-bold">Système d'exploitation<a style="color: red"> *</a></label>
                <div class="w-100 d-inline-block">
                    <div class="pr-2">
                        <select class="form-control w-50 float-left" id="osTypeFormControlSelect" name="osTypeFormControlSelect" required>
                            <?php
                            $windows = 0;
                            $linux = 0;
                            foreach ($osNames as $value) {
                                if (($value['osType']=="Linux / Ubuntu ")&&$linux<1){
                                    echo "<option>".$value['osType']."</option>";
                                    $linux++;
                                }
                                if (($value['osType']=="Windows")&&$windows<1){
                                    echo "<option>".$value['osType']."</option>";
                                    $windows++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="pl-2">
                        <select class="form-control w-50 float-right" id="osFormNameControlSelect" name="osFormNameControlSelect" required>
                            <?php
                            foreach ($osNames as $value) {
                                if($value['osType'])
                                echo "<option>".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <small id="osHelp" class="form-text text-muted">Toutes les OS sont en anglais, 64 bits</small>
            </div>
            <!--Date of commissioning-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputComissioningDate" class="font-weight-bold">Date de mise en service<a style="color: red"> *</a></label>
                <input type="date" min="<?php date("Y-m-d") ?>" class="form-control form form" id="inputComissioningDate" name="inputComissioningDate" aria-describedby="comissioningDateHelp" placeholder="Entrer un nom ou une addresse de messagerie"  required>
                <small id="comissioningDateHelp" class="form-text text-muted">Délai d'une semaine pour les VM de type Silver &amp; Gold. Deux semaines pour les autres configurations.</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--Network-->
            <div class="form-group w-50 float-left pr-4">
                <label for="networkFormControlSelect" class="font-weight-bold">Réseau<a style="color: red"> *</a></label>
                <select class="form-control" id="networkFormControlSelect" name="networkFormControlSelect" required>
                    <option>LAN</option>
                    <option>DMZ</option>
                    <option>DMZ avec adressage privé</option>
                </select>
                <small id="networkHelp" class="form-text text-muted">LAN : Machine accessible en interne ou via le VPN</small>
                <small id="networkHelp" class="form-text text-muted">DMZ Privée : Accessible depuis l'extérieur mais uniquement par son nom DNS (exemple : vm-01.heig-vd.ch)</small>
            </div>
            <!--End Date-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputEndDate" class="font-weight-bold">Date de fin</label>
                <input type="date" class="form-control form form" id="inputEndDate" name="inputEndDate" aria-describedby="EndDateHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                <small id="EndDateHelp" class="form-text text-muted">Date de fin du projet, à laquelle la VM peut être arrêtée puis supprimée.</small>
                <small id="EndDateHelp" class="form-text text-muted">S'il n'y a pas d'échéance, une demande de renouvellement sera envoyée chaque année.</small>
            </div>
        </div>
        <!--Using-->
        <label for="inputDIS" class="font-weight-bold">Type d'utilisation<a style="color: red"> *</a></label>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="Academique" name="Academique">
            <label class="form-check-label" for="Academique">Académique</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="RaD" name="RaD">
            <label class="form-check-label" for="RaD">Ra&D</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="Operationnel" name="Operationnel">
            <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
        </div>
        <!--Objective-->
        <div class="form-group">
            <label for="objective" class="font-weight-bold">Description<a style="color: red"> *</a></label>
            <textarea class="form-control" rows="5" id="objective" name="objective" required></textarea>
            <small id="objectiveHelp" class="form-text text-muted">But du projet</small>
        </div>
        <!--Snapshots-->
        <div class="form-group">
            <label for="snapshotsFormControlSelect" class="font-weight-bold">Snapshots<a style="color: red"> *</a></label>
            <select class="form-control" id="snapshotsFormControlSelect" name="snapshotsFormControlSelect" required>
                <?php
                foreach ($snapshotPolicy as $value) {
                    echo "<option>".$value['policy']."</option>";
                }
                ?>
            </select>
            <small id="snapshotsHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Backup-->
        <div class="form-group">
            <label for="backupFormControlSelect" class="font-weight-bold">Backup<a style="color: red"> *</a></label>
            <select class="form-control" id="backupFormControlSelect" name="backupFormControlSelect" required>
                <?php
                foreach ($backupPolicy as $value) {
                    echo "<option>".$value['policy']."</option>";
                }
                ?>
            </select>
            <small id="backupHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Checkbox domain EINET-->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="domainEINET" name="domainEINET">
            <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
        </div>
        <!--Security-->
        <div class="form-group">
            <label for="securityFormControlSelect" class="font-weight-bold">Sécurité<a style="color: red"> *</a></label>
            <select class="form-control" id="securityFormControlSelect" name="securityFormControlSelect" required>
                <option>OS mis à jour par le responsable technique</option>
                <option>OS mis à jour par le SI (update automatiques)</option>
            </select>
            <small id="securityHelp" class="form-text text-muted">Le S-ISI recommande de patcher les VM tous les 90 jours au moins.</small>
        </div>
        <!--technical information-->
        <div class="form-group">
            <label for="ti" class="font-weight-bold">Informations techniques</label>
            <textarea class="form-control" rows="5" id="ti" name="ti"></textarea>
            <small id="tiHelp" class="form-text text-muted">Règles firewall, type de compte, justification DMZ ou configuration personnalisée, etc...</small>
        </div>
        <!--Submit-->
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <!--Cancel-->
        <button type="reset" class="btn btn-danger float-right">Annuler</button>
    </form>
</div>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
