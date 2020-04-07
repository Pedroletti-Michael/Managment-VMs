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
                <input type="vmName" class="form-control form form" value="<?php echo $dataVM[0]['name'] ?>" id="inputVMName" name="inputVMName" aria-describedby="vmNameHelp" maxlength="15" required>
                <small id="vmNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Ex: VM-01)</small>
            </div>
            <!--Name of the requester-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputResquesterName" class="font-weight-bold">Demandeur<a style="color: red"> *</a></label>
                <input type="requesterName" class="form-control form form" value="<?php echo $dataVM[0]['customer'] ?>" id="inputResquesterName" name="inputResquesterName" aria-describedby="requesterNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" disabled>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--CPU-->
                <label for="cpu" class="font-weight-bold">Nombre de CPU<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form"  value="<?php echo $dataVM[0]['cpu'] ?>" id="inputCPU" name="inputCPU" aria-describedby="cpuHelp" min="1" max="99" required>
            </div>
            <!--Name of the technical manager-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputTMName" class="font-weight-bold">Responable technique<a style="color: red"> *</a></label>
                <input type="tmName" class="form-control form form"  value="<?php echo $dataVM[0]['userRt'] ?>" id="inputTMName" name="inputTMName" aria-describedby="tmNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--RAM-->
                <label for="RAM" class="font-weight-bold mr-2">Nombre de RAM (GB)<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form mr-3" value="<?php echo $dataVM[0]['ram'] ?>" id="inputRAM" name="inputRAM" aria-describedby="ramHelp" min="1" max="256" required>
            </div>
            <!--Name of the responsible administrator-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputRAName" class="font-weight-bold">Responsable administratif<a style="color: red"> *</a></label>
                <input type="raName" class="form-control form form" value="<?php echo $dataVM[0]['userRa'] ?>" id="inputRAName" name="inputRAName" aria-describedby="raNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                <small id="raNameHelp" class="form-text text-muted">Direction, Doyen , Directeur d'institut ou Chef de service</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4">
                <!--Stockages-->
                <label for="SSD" class="font-weight-bold mr-2">Stockage SSD (GB)<a style="color: red"> *</a></label>
                <input type="number" class="form-control form form" value="<?php echo $dataVM[0]['disk'] ?>" id="inputSSD" name="inputSSD" aria-describedby="ssdHelp" min="20" max="1000" required>
            </div>
            <!--Department / Institution / Service-->
            <div class="form-group w-50 float-right pl-4">
                <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service<a style="color: red"> *</a></label>
                <select class="form-control" id="disFormControlSelect" name="disFormControlSelect" required>
                    <?php
                    foreach ($entityNames as $value) {
                        if($dataVM[0]['entity_id'] == $value['entityName']){
                                echo "<option selected>".$value['entityName']."</option>";}
                            else{
                                echo "<option>".$value['entityName']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--OS-->
            <div class="form-group w-50 float-left pr-4">
                <label for="osFormControlSelect" class="font-weight-bold">Système d'exploitation<a style="color: red"> *</a></label>
                <select class="form-control"  value="<?php echo $dataVM[0]['os'] ?>" id="osFormControlSelect" name="osFormControlSelect" required>
                    <?php
                    foreach ($osNames as $value) {
                        if($dataVM[0]['os_id'] == $value['osType']." ".$value['osName']){
                            echo "<option selected>".$value['osType']." ".$value['osName']."</option>";}
                        else{
                            echo "<option>".$value['osType']." ".$value['osName']."</option>";
                        }
                    }
                    ?>
                </select>
                <small id="osHelp" class="form-text text-muted">Toutes les OS sont en anglais, 64 bits</small>
            </div>
            <!--Date of commissioning-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputComissioningDate" class="font-weight-bold">Date de mise en service<a style="color: red"> *</a></label>
                <input type="date" min="<?php date("Y-m-d") ?>" class="form-control form form" value="<?php echo $dataVM[0]['dateStart'] ?>" id="inputComissioningDate" name="inputComissioningDate" aria-describedby="comissioningDateHelp" placeholder="Entrer un nom ou une addresse de messagerie"  required>
                <small id="comissioningDateHelp" class="form-text text-muted">Délai d'une semaine pour les VM de type Silver &amp; Gold. Deux semaines pour les autres configurations.</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--Network-->
            <div class="form-group w-50 float-left pr-4">
                <label for="networkFormControlSelect" class="font-weight-bold">Réseau<a style="color: red"> *</a></label>
                <select class="form-control" id="networkFormControlSelect" name="networkFormControlSelect" required>
                    <?php
                    $networkNames = array("LAN", "DMZ", "DMZ avec adressage privé");
                    for($i = 0; $i<3; $i++){
                        if($dataVM[0]['network'] == $networkNames[$i]){
                            echo "<option selected>".$networkNames[$i]."</option>";}
                        else{
                            echo "<option>".$networkNames[$i]."</option>";
                        }
                    }
                    ?>
                </select>
                <small id="networkHelp" class="form-text text-muted">LAN : Machine accessible en interne ou via le VPN</small>
                <small id="networkHelp" class="form-text text-muted">DMZ Privée : Accessible depuis l'extérieur mais uniquement par son nom DNS (exemple : vm-01.heig-vd.ch)</small>
            </div>
            <!--End Date-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputEndDate" class="font-weight-bold">Date de fin</label>
                <input type="date" class="form-control form form" value="<?php echo $dataVM[0]['dateEnd'] ?>" id="inputEndDate" name="inputEndDate" aria-describedby="EndDateHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                <small id="EndDateHelp" class="form-text text-muted">Date de fin du projet, à laquelle la VM peut être arrêtée puis supprimée.</small>
                <small id="EndDateHelp" class="form-text text-muted">S'il n'y a pas d'échéance, une demande de renouvellement sera envoyée chaque année.</small>
            </div>
        </div>
        <!--Using-->
        <label for="inputDIS" class="font-weight-bold">Type d'utilisation<a style="color: red"> *</a></label>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if($dataVM[0]['usageType']=="Academique"){echo "checked";} ?> id="Academique" name="Academique">
            <label class="form-check-label" for="Academique">Académique</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if($dataVM[0]['usageType']=="RaD"){echo "checked";} ?> id="RaD" name="RaD">
            <label class="form-check-label" for="RaD">Ra&D</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if($dataVM[0]['usageType']=="Operationnel"){echo "checked";} ?> id="Operationnel" name="Operationnel">
            <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if($dataVM[0]['usageType']=="Test"){echo "checked";} ?> id="Test" name="Test">
            <label class="form-check-label" for="Test">Test - Dev</label>
        </div>
        <!--Objective-->
        <div class="form-group">
            <label for="objective" class="font-weight-bold">Description<a style="color: red"> *</a></label>
            <textarea class="form-control" rows="5" id="objective" name="objective" required><?php echo $dataVM[0]['description'] ?></textarea>
            <small id="objectiveHelp" class="form-text text-muted">But du projet</small>
        </div>
        <!--Snapshots-->
        <div class="form-group">
            <label for="snapshotsFormControlSelect" class="font-weight-bold">Snapshots<a style="color: red"> *</a></label>
            <select class="form-control" id="snapshotsFormControlSelect" name="snapshotsFormControlSelect" required>
                <?php
                foreach ($snapshotPolicy as $value) {
                    if ($dataVM[0]['snapshot_id'] == $value['policy']) {
                        echo "<option selected>" . $value['policy'] . "</option>";
                    } else {
                        echo "<option>" . $value['policy'] . "</option>";
                    }
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
                    if($dataVM[0]['backup_id'] == $value['policy']){
                        echo "<option selected>".$value['policy']."</option>";}
                    else{
                        echo "<option>".$value['policy']."</option>";
                    }
                }
                ?>
            </select>
            <small id="backupHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Checkbox domain EINET-->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if($dataVM[0]['domain']==1){echo "checked";} ?> id="domainEINET" name="domainEINET">
            <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
        </div>
        <!--Security-->
        <div class="form-group">
            <label for="securityFormControlSelect" class="font-weight-bold">Sécurité<a style="color: red"> *</a></label>
            <select class="form-control" id="securityFormControlSelect" name="securityFormControlSelect" required>
                <?php
                $securityNames = array("OS mis à jour par le responsable technique", "OS mis à jour par le SI (update automatiques)");
                for($i = 0; $i<2; $i++){
                    if($dataVM[0]['network'] == $securityNames[$i]){
                        echo "<option selected>".$securityNames[$i]."</option>";}
                    else{
                        echo "<option>".$securityNames[$i]."</option>";
                    }
                }
                ?>
            </select>
            <small id="securityHelp" class="form-text text-muted">Le S-ISI recommande de patcher les VM tous les 90 jours au moins.</small>
        </div>
        <!--technical information-->
        <div class="form-group">
            <label for="ti" class="font-weight-bold">Informations techniques</label>
            <textarea class="form-control" rows="5" id="ti" name="ti"><?php echo $dataVM[0]['comment'] ?></textarea>
            <small id="tiHelp" class="form-text text-muted">Règles firewall, type de compte, justification DMZ ou configuration personnalisée, etc...</small>
        </div>
        <!------------------ Admin informations ---------------------->
        <div class="w-100 text-center mt-5"><h5>Info admin</h5></div>
        <hr class="">
        <div class="d-inline-block w-100">
            <!--Cluster-->
            <div class="form-group w-50 float-left pr-4">
                <label for="editCluster" class="font-weight-bold">Cluster</label>
                <input type="cluster" class="form-control form form" value="<?php echo $dataVM[0]['cluster'] ?>" id="editCluster" name="editCluster" aria-describedby="clusterHelp">
            </div>
            <!--Date anniversary-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputEndDate" class="font-weight-bold">Date d'anniversaire</label>
                <input type="date" class="form-control form form" value="<?php echo $dataVM[0]['dateAnniversary'] ?>" id="editDateAnniversary" name="editDateAnniversary" aria-describedby="anniversaryDateHelp">
            </div>
        </div>

        <div class="d-inline-block w-100">
            <!--IP-->
            <div class="form-group w-50 float-left pr-4">
                <label for="editIP" class="font-weight-bold">IP</label>
                <input class="form-control form form" value="<?php echo $dataVM[0]['ip'] ?>" id="editIP" name="editIP" aria-describedby="ipHelp">
            </div>
            <!--dnsName-->
            <div class="form-group w-50 float-right pl-4">
                <label for="inputEndDate" class="font-weight-bold">Nom du DNS</label>
                <input class="form-control form form" value="<?php echo $dataVM[0]['dnsName'] ?>" id="editDnsName" name="editDnsName" aria-describedby="dnsNameHelp">
            </div>
        </div>

        <div class="d-inline-block w-100">
            <!--Redundance-->
            <div class="form-group w-50 float-left pr-4">
                <label for="editRedundance" class="font-weight-bold">Redondance</label>
                <input class="form-control form form" value="<?php echo $dataVM[0]['redundance'] ?>" id="editRedundance" name="editRedundance" aria-describedby="redundanceHelp">
            </div>
            <!--Criticity-->
            <div class="form-group w-50 float-right pl-4">
                <label for="editCriticity" class="font-weight-bold">Critique</label>
                <input class="form-control form form" value="<?php echo $dataVM[0]['criticity'] ?>" id="editCriticity" name="editCriticity" aria-describedby="criticityHelp">
            </div>
        </div>


        <!--Save the modifications-->
        <a href="index.php?action=updateVM&id=<?php echo $idVM?>"><button type="submit" class="btn btn-primary m-auto d-inline">Enregistrer les modifications</button></a>


        <?php if($dataVM[0]['vmStatus']==0): ?>
        <!--Accepted-->
        <a href="index.php?action=vmAccepted&id=<?php echo $idVM?>"><button type="submit" class="btn btn-success float-right ml-1">Confirmer la demande</button></a>
        <!--Refused-->
        <a href="index.php?action=vmRefused&id=<?php echo $idVM?>"><button type="submit" class="btn btn-danger float-right">Refuser la demande</button></a>
        <?php endif; ?>
    </form>
</div>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
