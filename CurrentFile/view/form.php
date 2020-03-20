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
        <form method="post" action="RequestVM" class="mb-4">
            <div class="d-inline-block w-100">
                <!--Name of the VM-->
                <div class="form-group w-50 float-left pr-4">
                    <label for="inputVMName" class="font-weight-bold">Nom de la VM</label>
                    <input type="vmName" class="form-control form form" id="inputVMName" aria-describedby="vmNameHelp" maxlength="15" required>
                    <small id="vmNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Ex: VM-01)</small>
                </div>
                <!--Name of the requester-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="inputResquesterName" class="font-weight-bold">Demandeur</label>
                    <input type="requesterName" class="form-control form form" id="inputResquesterName" aria-describedby="requesterNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <div class="form-group w-50 float-left pr-4">
                    <!--CPU-->
                    <label for="cpu" class="font-weight-bold">Nombre de CPU</label>
                    <input type="number" class="form-control form form" id="inputCPU" aria-describedby="cpuHelp" min="1" max="99" required>
                    <small id="cpuHelp" class="form-text text-muted">Maximum : 99</small>
                </div>
                <!--Name of the technical manager-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="inputTMName" class="font-weight-bold">Responable technique</label>
                    <input type="tmName" class="form-control form form" id="inputTMName" aria-describedby="tmNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <div class="form-group w-50 float-left pr-4">
                    <!--RAM-->
                    <label for="RAM" class="font-weight-bold mr-2">Nombre de RAM (GB)</label>
                    <input type="number" class="form-control form form mr-3" id="inputRAM" aria-describedby="ramHelp" min="2" max="256" required>
                    <small id="ramHelp" class="form-text text-muted">Maximum : 256 GB</small>
                </div>
                <!--Name of the responsible administrator-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="inputRAName" class="font-weight-bold">Responsable administrateur</label>
                    <input type="raName" class="form-control form form" id="inputRAName" aria-describedby="raNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                    <small id="raNameHelp" class="form-text text-muted">Direction, Doyen , Directeur d'institut oou Chef de service</small>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <div class="form-group w-50 float-left pr-4">
                    <!--Stockages-->
                    <label for="SSD" class="font-weight-bold mr-2">Stockage SSD (GB)</label>
                    <input type="number" class="form-control form form" id="inputSSD" aria-describedby="ssdHelp" min="0" max="1000" required>
                    <small id="ssdHelp" class="form-text text-muted">Maximum : 1000 GB</small>
                </div>
                <!--Department / Institution / Service-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
                    <select class="form-control" id="disFormControlSelect" required>
                        <option>S-ISI</option>
                        <option>SIPA</option>
                        <option>COMEM+</option>
                        <option>EC+G</option>
                        <option>FORMATION CONTINUE</option>
                        <option>HEG</option>
                        <option>TIC</option>
                        <option>TIN</option>
                        <option>HE&E</option>
                        <option>COMATEC</option>
                        <option>INSIT</option>
                        <option>IAI</option>
                        <option>IESE</option>
                        <option>IDE</option>
                        <option>IGT</option>
                        <option>IICT</option>
                        <option>MECATRONIX</option>
                        <option>MEI</option>
                        <option>MEI</option>
                        <option>REDS</option>
                        <option>SWI</option>
                    </select>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <!--OS-->
                <div class="form-group w-50 float-left pr-4">
                    <label for="osFormControlSelect" class="font-weight-bold">Système d'exploitation</label>
                    <select class="form-control" id="osFormControlSelect" required>
                        <option>Windows Server 2016</option>
                        <option>Windows Server 2019</option>
                        <option>Windows Server 2019 Core</option>
                        <option>Linux Ubuntu Server 16.04 LTS</option>
                        <option>Linux Ubuntu Server 18.04 LTS</option>
                    </select>
                    <small id="osHelp" class="form-text text-muted">Toutes les OS sont en anglais, 64 bits</small>
                </div>
                <!--Date of commissioning-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="inputComissioningDate" class="font-weight-bold">Date de mise en service</label>
                    <input type="date" class="form-control form form" id="inputComissioningDate" aria-describedby="comissioningDateHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                    <small id="comissioningDateHelp" class="form-text text-muted">Délai d'une semaine pour les VM de type Silver &amp; Gold. Deux semaines pour les autres configurations.</small>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <!--Network-->
                <div class="form-group w-50 float-left pr-4">
                    <label for="networkFormControlSelect" class="font-weight-bold">Réseau</label>
                    <select class="form-control" id="networkFormControlSelect" required>
                        <option>LAN</option>
                        <option>DMZ</option>
                        <option>DMZ avec adressage privé</option>
                    </select>
                    <small id="networkHelp" class="form-text text-muted">LAN : Machine accessible en interne ou via le VPN</small>
                    <small id="networkHelp" class="form-text text-muted">DMZ : Accessible depuis l'extérieur via une IP publique (à justifier)</small>
                </div>
                <!--End Date-->
                <div class="form-group w-50 float-right pl-4">
                    <label for="inputEndDate" class="font-weight-bold">Date de fin</label>
                    <input type="date" class="form-control form form" id="inputEndDate" aria-describedby="EndDateHelp" placeholder="Entrer un nom ou une addresse de messagerie" required>
                    <small id="EndDateHelp" class="form-text text-muted">Date de fin du projet, à laquelle la VM peut être arrêté puis supprimée.</small>
                    <small id="EndDateHelp" class="form-text text-muted">S'il n'y a pas d'échéance, une demande de renouvellement sera envoyée chaque année.</small>
                </div>
            </div>
            <!--Using-->
            <label for="inputDIS" class="font-weight-bold">Département / Institution / Service</label>
            <div class="d-inline-block w-100">
                <div class="form-group form-check-inline" style="width: 32%;">
                    <input type="checkbox" class="form-check-input" id="Academique" required>
                    <label class="form-check-label" for="Academique">Académique</label>
                </div>

                <div class="form-group form-check-inline" style="width: 32%;">
                    <input type="checkbox" class="form-check-input" id="RaD" required>
                    <label class="form-check-label" for="RaD">Ra&D</label>
                </div>

                <div class="form-group form-check-inline" style="width: 32%;">
                    <input type="checkbox" class="form-check-input" id="Operationnel" required>
                    <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
                </div>
            </div>
            <!--Objective-->
            <div class="form-group">
                <label for="objective" class="font-weight-bold">Description</label>
                <textarea class="form-control" rows="5" id="objective" required></textarea>
                <small id="objectiveHelp" class="form-text text-muted">But du projet</small>
            </div>
            <!--Snapshots-->
            <div class="form-group">
                <label for="snapshotsFormControlSelect" class="font-weight-bold">Snapshots</label>
                <select class="form-control" id="snapshotsFormControlSelect" required>
                    <option>1) 1 fois/heure - rétention 1 jour, 1 fois/jour - rétention 7 jours, site local & site distant</option>
                    <option>2) 1 fois/jour - rétention 7 jours, site local & site distant</option>
                    <option>3) 2 fois/semaine - rétention 7 jours, site local & site distant</option>
                    <option>4) Aucune snapshot</option>
                </select>
                <small id="snapshotsHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
            </div>
            <!--Backup-->
            <div class="form-group">
                <label for="backupFormControlSelect" class="font-weight-bold">Backup</label>
                <select class="form-control" id="backupFormControlSelect" required>
                    <option>Quotidien / backup local & backup distant / Rétention de 4 semaines</option>
                </select>
                <small id="backupHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
            </div>
            <!--Checkbox domain EINET-->
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="domainEINET">
                <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
                <small id="domainHelp" class="form-text text-muted">Uniquement si réseau LAN</small>
            </div>
            <!--Security-->
            <div class="form-group">
                <label for="securityFormControlSelect" class="font-weight-bold">Sécurité</label>
                <select class="form-control" id="securityFormControlSelect" required>
                    <option>OS mis à jour par le responsable technique</option>
                    <option>OS mis à jour par le SI (update automatiques)</option>
                </select>
                <small id="securityHelp" class="form-text text-muted">Le S-ISI recommande de patcher les VM tous les 90 jours au moins.</small>
            </div>
            <!--technical information-->
            <div class="form-group">
                <label for="ti" class="font-weight-bold">Informations techniques</label>
                <textarea class="form-control" rows="5" id="ti"></textarea>
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