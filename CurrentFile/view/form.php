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
    <script>
        function checkName(){
            var i = 0;
            var vmNames = <?= json_encode($allVmName); ?>;
            var result = false;
            var name = document.getElementById("inputVMName").value;

            for (i = 0; i < vmNames.length; i++){
                if(vmNames[i] == name){
                    result = true;
                }
            }

            var inpt = document.getElementById("inputVMName");
            var subBtn = document.getElementById("submitButton");
            if(result){
                document.getElementById("alertVmName").style.display = "";
                inpt.style.boxShadow = "0 0 0 0.2rem rgba(223, 1, 7, 0.25)";
                inpt.style.borderColor = "#dc3545";
                subBtn.disabled= true;
            }
            else{
                inpt.style.borderColor = "#ced4da";
                document.getElementById("alertVmName").style.display = "none";
                inpt.style.boxShadow = "0 0 0 0.2rem rgba(0, 123, 255, 0.25)";
                subBtn.disabled= false;
            }
        }
    </script>
    <script>

    </script>
</head>
<body>
<div class="container-fluid pt-3">
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Formulaire de demande de VM</h3>
    <form method="post" action="../index.php?action=RequestVM" class="mb-4">
        <div class="d-inline-block w-100">
            <!--Name of the VM-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="inputVMName" class="font-weight-bold">Nom de la VM<a style="color: red"> *</a></label>
                <input type="vmName" class="form-control form form text-uppercase" id="inputVMName" name="inputVMName" aria-describedby="vmNameHelp" maxlength="15" required onkeyup="checkName()">
                <small id="vmNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Exemple : DPT-VM01)</small>

                <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertVmName" style="display: none;">
                    <strong>Attention!</strong> Ce nom est déjà utilisé. Veuillez en utiliser un autre !
                </div>
            </div>
            <!--Name of the requester-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputRequesterName" class="font-weight-bold">Demandeur<a style="color: red"> *</a></label>
                <input type="text" class="form-control form form" value="<?php echo $_SESSION['userEmail'] ?>" id="inputRequesterName" name="inputRequesterName" aria-describedby="requesterNameHelp" placeholder="Entrer un nom ou une addresse de messagerie" readonly>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <div class="form-group w-50 float-left pr-1">
                    <!--CPU-->
                    <label for="cpu" class="font-weight-bold">CPU<a style="color: red"> *</a></label>
                    <input type="number" class="form-control form form" id="inputCPU" name="inputCPU" aria-describedby="cpuHelp" min="1" max="99" required>
                </div>
                <div class="form-group w-50 float-right pl-1">
                    <!--RAM-->
                    <label for="RAM" class="font-weight-bold">RAM (GB)<a style="color: red"> *</a></label>
                    <input type="number" class="form-control form form" id="inputRAM" name="inputRAM" aria-describedby="ramHelp" min="1" max="256" required>
                </div>
                <br>
                <div class="form-group w-100 float-left mt-3">
                    <!--Stockages-->
                    <label for="SSD" class="font-weight-bold mr-2">Stockage SSD (GB)<a style="color: red"> *</a></label>
                    <div class="w-100 d-inline-block">
                        <div class="pr-2">
                            <input type="number" class="form-control form form w-25 float-left" id="inputSSD" name="inputSSD" aria-describedby="ssdHelp" min="20" max="1000" required>
                        </div>
                        <div class="pl-2">
                            <input type="text" class="form-control form form w-75 float-right" id="infoSSD" name="infoSSD" aria-describedby="ssdHelp" placeholder="Exemple : Disque 1 : 50 GB / Disque 2 : 100 GB">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <!--Name of the technical manager-->
                <div class="form-group w-50 float-left pr-1" id="responsiveDisplay">
                    <label for="inputTMNam" class="font-weight-bold">Responsable technique<a style="color: red"> *</a></label>
                    <input type="text" class="form-control form form" id="inputTMNam" name="inputTMNam" aria-describedby="tmNameHelp" placeholder="Sélectionner une personne" required onkeyup="searchFunctionTm()">
                    <small id="inputTMNameHelp" class="form-text text-muted">Personne qui va gérer la VM</small>
                    <ul id="tmNameUl" class="border border-light searchBoxUser list-group list-group-flush mt-2">
                        <?php
                        $id = 'liTm';
                        $i = 0;
                        $endSeparator = '';

                        foreach($users as $user){
                            echo '<li class="list-group-item list-group-item-action h-25 p-0 pl-2"><a class="unlink" href="#" onclick="displayIntoInputTm('.$i.', this.text)">'. $user[1]. ' ' .$user[2] .'</a></li>';
                            echo '<input type="hidden" value="'.$user[0].'" id="'.$id.$i.$endSeparator.'">';
                            $i++;
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="inputTMName" id="inputTMName" readonly required>
                </div>
                <div class="form-group w-50 float-right pl-1 mb-0" id="responsiveDisplay">
                    <!--Name of the responsible administrator-->
                    <label for="inputRANam" class="font-weight-bold">Responsable administratif<a style="color: red"> *</a></label>
                    <input type="text" class="form-control form form" id="inputRANam" name="inputRANam" aria-describedby="raNameHelp" placeholder="Sélectionner une personne" required onkeyup="searchFunctionRa()">
                    <small id="raNameHelp" class="form-text text-muted">Direction, Doyen , Directeur d'institut ou Chef de service</small>
                    <ul id="raNameUl" class="border border-light searchBoxUser list-group list-group-flush mt-2">
                        <?php
                        $id = 'liRa';
                        $i = 0;
                        $endSeparator = '';

                        foreach($users as $user){
                            echo '<li class="list-group-item list-group-item-action h-25 p-0 pl-2"><a class="unlink" href="#" onclick="displayIntoInputRa('.$i.', this.text)">'. $user[1]. ' ' .$user[2] .'</a></li>';
                            echo '<input type="hidden" value="'.$user[0].'" id="'.$id.$i.$endSeparator.'">';
                            $i++;
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="inputRAName" id="inputRAName" readonly required>
                </div>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--OS-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="osFormControlSelect" class="font-weight-bold">Système d'exploitation<a style="color: red"> *</a></label>
                <div class="w-100 d-inline-block">
                    <div class="pr-2">
                        <select class="form-control w-50 float-left" id="osTypeFormControlSelect" name="osTypeFormControlSelect" onchange="checkOS(this.value)" required>
                            <?php
                            $windows = 0;
                            $linux = 0;
                            foreach ($osNames as $value) {
                                if (($value['osType']=="Linux")&&$linux<1){
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
                        <select class="form-control w-50 float-right" id="windows" name="osFormNameControlSelectWin" required>
                            <?php

                            foreach ($osNames as $value) {
                                if($value['osType']=="Windows"){
                                    echo "<option class='windows'>".$value['osName']."</option>";
                                }
                            }
                            ?>
                        </select>
                        <select class="form-control w-50 float-right" style="display: none;" id="linux" name="osFormNameControlSelectLin" required>
                            <?php

                            foreach ($osNames as $value) {
                                if($value['osType']=="Linux"){
                                    echo "<option class='linux'>".$value['osName']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <small id="osHelp" class="form-text text-muted">Toutes les OS sont en anglais, 64 bits</small>
            </div>
            <!--Department / Institution / Service-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service<a style="color: red"> *</a></label>
                <select class="form-control" id="disFormControlSelect" name="disFormControlSelect" required>
                    <?php
                    foreach ($entityNames as $value) {
                        if($value['status'] == 0){
                            echo "<option>".$value['entityName']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--Network-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="networkFormControlSelect" class="font-weight-bold">Réseau<a style="color: red"> *</a></label>
                <select class="form-control" id="networkFormControlSelect" name="networkFormControlSelect" required>
                    <option>LAN</option>
                    <option>DMZ</option>
                    <option>DMZ avec adressage privé</option>
                </select>
                <small id="networkHelp" class="form-text text-muted">LAN : Machine accessible en interne ou via le VPN</small>
            </div>
            <!--Date of commissioning-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputComissioningDate" class="font-weight-bold">Date de mise en service<a style="color: red"> *</a></label>
                <input type="date" min="<?= date("Y-m-d"); ?>" class="form-control form form" id="inputComissioningDate" name="inputComissioningDate" aria-describedby="comissioningDateHelp" placeholder="Entrer un nom ou une addresse de messagerie"  required>
                <small id="comissioningDateHelp" class="form-text text-muted">Délai de 7 jours après validation</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--Using-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="inputDIS" class="font-weight-bold">Type d'utilisation<a style="color: red"> *</a></label>
                <div class="d-inline-block w-100">
                    <div class="w-50 float-left pr-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="Academique" name="Academique" onchange="checkUsingCheckbx()">
                            <label class="form-check-label" for="Academique">Académique</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="RaD" name="RaD" onchange="checkUsingCheckbx()">
                            <label class="form-check-label" for="RaD">Ra&D</label>
                        </div>
                    </div>
                    <div class="w-50 float-right pl-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="Operationnel" name="Operationnel" onchange="checkUsingCheckbx()">
                            <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="Test" name="Test" onchange="checkUsingCheckbx()">
                            <label class="form-check-label" for="Test">Test - Dev</label>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Date-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputEndDate" class="font-weight-bold">Date de fin</label>
                <input type="date" min="<?= strtotime(date("Y-m-d").'+ 1 DAY'); ?>" class="form-control form form" id="inputEndDate" name="inputEndDate" aria-describedby="EndDateHelp" onchange="checkField('alertEndDate')" placeholder="Entrer un nom ou une addresse de messagerie">
                <small id="EndDateHelp" class="form-text text-muted">Date de fin du projet, à laquelle la VM peut être arrêtée puis supprimée.</small>
                <small id="EndDateHelp" class="form-text text-muted">S'il n'y a pas d'échéance, une demande de renouvellement sera envoyée tous les 6 mois.</small>
                <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertEndDate" style="display: none;">
                    <strong>Attention!</strong> La date de fin doit être plus grande que la date de début !
                </div>
            </div>
        </div>

        <!--Objective-->
        <div class="form-group">
            <label for="objective" class="font-weight-bold">Description<a style="color: red"> *</a></label>
            <textarea class="form-control" rows="5" id="objective" name="objective" required maxlength="1000"></textarea>
            <small id="objectiveHelp" class="form-text text-muted">But du projet</small>
        </div>
        <!--Snapshots-->
        <div class="form-group">
            <label for="snapshotsFormControlSelect" class="font-weight-bold">Snapshots<a style="color: red"> *</a></label>
            <select class="form-control" id="snapshotsFormControlSelect" name="snapshotsFormControlSelect" required>
                <?php
                foreach ($snapshotPolicy as $value) {
                    echo "<option>".$value['name']." : ".$value['policy']."</option>";
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
                    echo "<option>".$value['name']." : ".$value['policy']."</option>";
                }
                ?>
            </select>
            <small id="backupHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Checkbox domain EINET-->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="domainEINET" name="domainEINET">
            <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
            <small id="domainEINETHelp" class="form-text text-muted">Pour serveur Windows uniquement</small>
        </div>
        <!--Security-->
        <div class="form-group">
            <label for="securityFormControlSelect" class="font-weight-bold">Sécurité<a style="color: red"> *</a></label>
            <select class="form-control" id="securityFormControlSelect" name="securityFormControlSelect" required>
                <option>Mises à jour installées par le responsable technique</option>
                <option>Mises à jour installées par le S-ISI de manière automatique</option>
            </select>
            <small id="securityHelp" class="form-text text-muted">Le S-ISI recommande de mettre à jour la VM tous les 90 jours au minimum</small>
        </div>
        <!--technical information-->
        <div class="form-group">
            <label for="ti" class="font-weight-bold">Informations techniques</label>
            <textarea class="form-control" rows="5" id="ti" name="ti" maxlength="1000"></textarea>
            <small id="tiHelp" class="form-text text-muted">Règles firewall, type de compte, justification DMZ ou configuration personnalisée, etc...</small>
        </div>

        <!--Error no checkbox selected (modal)-->
        <div class="modal fade" id="modalErrorUsingCheckbox" tabindex="-1" role="dialog" aria-labelledby="modalErrorUsingCheckbox" aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px"  role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Veuillez cocher au moins une case dans la section "Type d'utilisation"</h6>
                            <button type="submit" class="btn btn-danger float-right btn-close-phone" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Submit-->
        <button type='button' id='alertButton' class='btn btn-primary' onclick="checkUsingCheckbx()">Envoyer</button>

        <button type='submit' id='submitButton' class='btn btn-primary' style="display: none;">Envoyer</button>
        <script>
            function checkUsingCheckbx()
            {
                var checkbxAcademique = document.getElementById("Academique").checked;
                var checkbxRaD = document.getElementById("RaD").checked;
                var checkbxOperationnel = document.getElementById("Operationnel").checked;
                var checkbxTest = document.getElementById("Test").checked;
                var alertButton = document.getElementById("alertButton");
                var submitButton = document.getElementById("submitButton");

                if(checkbxAcademique !== true && checkbxRaD !== true && checkbxOperationnel !== true && checkbxTest !== true)
                {
                    submitButton.setAttribute("style", "display:none");
                    alertButton.setAttribute("style", "display:block");
                    $('.modal').modal('show')
                }
                else
                {
                    submitButton.setAttribute("style", "display:block");
                    alertButton.setAttribute("style", "display:none");
                    $('.modal').modal('hide')
                }
            }
        </script>
        <!--Cancel-->
        <button type="reset" class="btn btn-danger float-right">Annuler</button>
    </form>
</div>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
