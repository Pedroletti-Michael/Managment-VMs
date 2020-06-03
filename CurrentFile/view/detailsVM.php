<?php

/**
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails VM - HEIG-VD</title>
    <script>
        function checkName() {
            var i = 0;
            var vmNames = <?= json_encode($allVmName); ?>;
            var actualName = "<?= $dataVM[0]['name']; ?>";
            var result = false;
            var name = document.getElementById("inputVMName").value;

            for (i = 0; i < vmNames.length; i++) {
                if (vmNames[i] == name) {
                    result = true;
                }
            }

            if (actualName == name) {
                result = false;
            }

            var txtHelp = document.getElementById("vmNameHelp");
            var inpt = document.getElementById("inputVMName");
            var subBtn = document.getElementById("submitButton");
            if (result) {
                txtHelp.color = "#dc3545";
                txtHelp.textContent = "Nom déjà utilisé ! Veuillez en utiliser un autre !";
                inpt.style.boxShadow = "0 0 0 0.2rem rgba(223, 1, 7, 0.25)";
                inpt.style.borderColor = "#dc3545";
                subBtn.disabled = true;
            } else {
                inpt.style.borderColor = "#ced4da";
                inpt.style.boxShadow = "0 0 0 0.2rem rgba(0, 123, 255, 0.25)";
                txtHelp.color = "#495057";
                txtHelp.textContent = "15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Ex: VM-01)";
                subBtn.disabled = false;
            }
        }
    </script>
</head>
<body>
<!--Confirmation update VM modal)-->
<?php if (isset($_SESSION['$displayModalConfirm']) && $_SESSION['$displayModalConfirm'] == true) : ?>
    <div class="modal fade" id="confirmationUpdateVM" tabindex="-1" role="dialog" aria-labelledby="confirmationUpdateVM"
         aria-hidden="true">
        <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
            <div class="modal-content w-100">
                <div class="modal-body">
                    <div class="w-100">
                        <h6 class="float-left pt-2 text-center">Les modifications ont été enregistrées</h6>
                        <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>$('.modal').modal('show')</script>
<?php endif; ?>

<!--Confirmation update VM modal)-->
<?php if (isset($_SESSION['displayErrorModification']) && $_SESSION['displayErrorModification'] == true) : ?>
    <div class="modal fade" id="displayErrorModification" tabindex="-1" role="dialog"
         aria-labelledby="displayErrorModification" aria-hidden="true">
        <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
            <div class="modal-content w-100">
                <div class="modal-body">
                    <div class="w-100">
                        <h6 class="float-left pt-2 text-center">Une erreur est survenu lors de la mise à jour des
                            données de votre VM. Veuillez réessayer.</h6>
                        <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>$('.modal').modal('show')</script>
    <?php unset($_SESSION['displayErrorModification']); endif; ?>

<div class="container-fluid pt-3 mb-3">
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">Tous les détails de la
        VM</h3>
    <form method="post" action="../index.php?action=updateVM" id="formDetailsVm">
        <div class="d-inline-block w-100">
            <!--Name of the VM-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="inputVMName" class="font-weight-bold">Nom de la VM<a style="color: red"> *</a></label>
                <input type="vmName" class="form-control form form" value="<?php echo $dataVM[0]['name'] ?>"
                       id="inputVMName" name="inputVMName" aria-describedby="vmNameHelp" maxlength="15"
                       style="text-transform: uppercase" onkeyup="checkName()" required
                       <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {echo "readonly";} ?>>
                <small id="vmNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement (Exemple : DPT-VM01)</small>
            </div>
            <!--Name of the requester-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputRequesterName" class="font-weight-bold">Demandeur<a style="color: red"> *</a></label>
                <input type="requesterName" class="form-control form form" value="<?php echo $dataVM[0]['customer'] ?>"
                       id="inputRequesterName" name="inputRequesterName" aria-describedby="requesterNameHelp"
                       placeholder="Entrer un nom ou une addresse de messagerie" readonly>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <div class="form-group w-50 float-left pr-1">
                    <!--CPU-->
                    <label for="cpu" class="font-weight-bold">CPU<a style="color: red"> *</a></label>
                    <input type="number" class="form-control form form" value="<?php echo $dataVM[0]['cpu'] ?>"
                           id="inputCPU" name="inputCPU" aria-describedby="cpuHelp" min="1" max="99"
                           required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                        echo "readonly";
                    } ?>>
                </div>
                <div class="form-group w-50 float-right pl-1">
                    <!--RAM-->
                    <label for="RAM" class="font-weight-bold mr-2">RAM (GB)<a style="color: red"> *</a></label>
                    <input type="number" class="form-control form form mr-3" value="<?php echo $dataVM[0]['ram'] ?>"
                           id="inputRAM" name="inputRAM" aria-describedby="ramHelp" min="1" max="256"
                           required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                        echo "readonly";
                    } ?>>
                </div>
                <br>
                <div class="form-group w-100 float-left mt-3">
                    <!--Stockages-->
                    <label for="SSD" class="font-weight-bold mr-2">Stockage SSD (GB)<a style="color: red"> *</a></label>
                    <div class="w-100 d-inline-block">
                        <div class="pr-2">
                            <input type="number" class="form-control form form w-25 float-left"
                                   value="<?php echo $dataVM[0]['disk'] ?>" id="inputSSD" name="inputSSD"
                                   aria-describedby="ssdHelp" min="20" max="1000"
                                   required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                        </div>
                        <div class="pl-2">
                            <input type="text" class="form-control form form w-75 float-right"
                                   value="<?php echo $dataVM[0]['descriptionDisk'] ?>" id="infoSSD" name="infoSSD"
                                   aria-describedby="ssdHelp"
                                   placeholder="Exemple : Disque 1: 50 GB / Disque 2 : 100GB" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group w-50 float-right pl-4 mb-0" id="responsiveDisplay">
                <div class="form-group w-50 float-left pr-1" id="responsiveDisplay">
                    <!--Name of the technical manager-->
                    <label for="inputTMNam" class="font-weight-bold">Responsable technique<a style="color: red">
                            *</a></label>
                    <input type="text" class="form-control form form" value="<?php echo $dataVM[0]['userRt'] ?>"
                           id="inputTMNam" name="inputTMNam" aria-describedby="tmNameHelp"
                           placeholder="Entrer une adresse de messagerie" required
                           onkeyup="searchFunctionTm()" <?php if ($_SESSION['userType'] == 2) {
                        echo "readonly";
                    } ?>>
                    <small id="inputTMNameHelp" class="form-text text-muted">Personne qui va gérer la VM</small>
                    <?php if ($_SESSION['userType'] != 2) : ?>
                        <ul id="tmNameUl" class="border border-light searchBoxUser list-group list-group-flush mt-2">
                            <?php
                            $id = 'liTm';
                            $i = 0;
                            $endSeparator = '';

                            foreach ($users as $user) {
                                echo '<li class="list-group-item list-group-item-action h-25 p-0 pl-2"><a class="unlink" href="#" onclick="displayIntoInputTm(' . $i . ', this.text)">' . $user[1] . ' ' . $user[2] . '</a></li>';
                                echo '<input type="hidden" value="' . $user[0] . '" id="' . $id . $i . $endSeparator . '">';
                                $i++;
                            }
                            ?>
                        </ul>
                        <input type="hidden" name="inputTMName" id="inputTMName"
                               value="<?php echo $dataVM[0]['userRt'] ?>" readonly required>
                    <?php endif; ?>
                </div>
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <!--Name of the responsible administrator-->
                    <label for="inputRANam" class="font-weight-bold">Responsable administratif<a style="color: red">
                            *</a></label>
                    <input type="text" class="form-control form form" value="<?php echo $dataVM[0]['userRa'] ?>"
                           id="inputRANam" name="inputRANam" aria-describedby="raNameHelp"
                           placeholder="Entrer une adresse de messagerie" required
                           onkeyup="searchFunctionRa()" <?php if ($_SESSION['userType'] == 2) {
                        echo "readonly";
                    } ?>>
                    <small id="raNameHelp" class="form-text text-muted">Direction, Doyen , Directeur d'institut ou Chef
                        de service
                    </small>
                    <?php if ($_SESSION['userType'] != 2) : ?>
                        <ul id="raNameUl" class="border border-light searchBoxUser list-group list-group-flush mt-2">
                            <?php
                            $id = 'liRa';
                            $i = 0;
                            $endSeparator = '';

                            foreach ($users as $user) {
                                echo '<li class="list-group-item list-group-item-action h-25 p-0 pl-2"><a class="unlink" href="#" onclick="displayIntoInputRa(' . $i . ', this.text)">' . $user[1] . ' ' . $user[2] . '</a></li>';
                                echo '<input type="hidden" value="' . $user[0] . '" id="' . $id . $i . $endSeparator . '">';
                                $i++;
                            }
                            ?>
                        </ul>
                        <input type="hidden" name="inputRAName" id="inputRAName"
                               value="<?php echo $dataVM[0]['userRa'] ?>" readonly required>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--OS-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <label for="osFormControlSelect" class="font-weight-bold">Système d'exploitation<a style="color: red">
                        *</a></label>
                <div class="w-100 d-inline-block">
                    <div class="pr-2">
                        <select class="form-control w-50 float-left" id="osTypeFormControlSelect"
                                name="osTypeFormControlSelect" onchange="checkOS(this.value)"
                                required <?php if ($_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                            <?php
                            if ($dataVM[0]['os_id'][1] == "Windows") {
                                echo "<option selected>Windows</option>";
                                echo "<option>Linux</option>";
                            } elseif ($dataVM[0]['os_id'][1] == "Linux") {
                                echo "<option>Windows</option>";
                                echo "<option selected>Linux</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="pl-2">

                        <select class="form-control w-50 float-right"
                                id="windows" <?php if ($dataVM[0]['os_id'][1] == "Linux") {
                            echo 'style="display: none;"';
                        } ?> name="osFormNameControlSelectWin" required <?php if ($_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                            <?php
                            foreach ($osNames as $value) {
                                if ($value['osType'] == "Windows") {
                                    if ($dataVM[0]['os_id'][0] == $value['osName']) {
                                        echo "<option class='windows' selected>" . $value['osName'] . "</option>";
                                    } else {
                                        echo "<option class='windows'>" . $value['osName'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>

                        <select class="form-control w-50 float-right"
                                id="linux" <?php if ($dataVM[0]['os_id'][1] == "Windows") {
                            echo 'style="display: none;"';
                        } ?> name="osFormNameControlSelectLin" required <?php if ($_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                            <?php
                            foreach ($osNames as $value) {
                                if ($value['osType'] == "Linux") {
                                    if ($dataVM[0]['os_id'][0] == $value['osName']) {
                                        echo "<option class='linux' selected>" . $value['osName'] . "</option>";
                                    } else {
                                        echo "<option class='linux'>" . $value['osName'] . "</option>";
                                    }
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
                <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service<a
                            style="color: red"> *</a></label>
                <select class="form-control" id="disFormControlSelect" name="disFormControlSelect"
                        required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                    echo "readonly";
                } ?>>
                    <?php
                    foreach ($entityNames as $value) {
                        if ($dataVM[0]['entity_id'] == $value['entityName']) {
                            echo "<option selected>" . $value['entityName'] . "</option>";
                        } else {
                            if($value['status'] == 0){
                                echo "<option>" . $value['entityName'] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <!--OS-->
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <!--Network-->
                <label for="networkFormControlSelect" class="font-weight-bold">Réseau<a style="color: red">
                        *</a></label>
                <select class="form-control" id="networkFormControlSelect" name="networkFormControlSelect"
                        required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                    echo "readonly";
                } ?>>
                    <?php
                    $networkNames = array("LAN", "DMZ", "DMZ avec adressage privé");
                    for ($i = 0; $i < 3; $i++) {
                        if ($dataVM[0]['network'] == $networkNames[$i]) {
                            echo "<option selected>" . $networkNames[$i] . "</option>";
                        } else {
                            echo "<option>" . $networkNames[$i] . "</option>";
                        }
                    }
                    ?>
                </select>
                <small id="networkHelp" class="form-text text-muted">LAN : Machine accessible en interne ou via le VPN
                </small>
            </div>
            <!--Date of commissioning-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputComissioningDate" class="font-weight-bold">Date de mise en service<a
                            style="color: red"> *</a></label>
                <input type="date" min="<?php date("Y-m-d") ?>" class="form-control form form"
                       value="<?php echo $dataVM[0]['dateStart'] ?>" id="inputComissioningDate"
                       name="inputComissioningDate" aria-describedby="comissioningDateHelp"
                       placeholder="Entrer un nom ou une addresse de messagerie"
                       required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                    echo "readonly";
                } ?>>
                <small id="comissioningDateHelp" class="form-text text-muted">Délai de 7 jours après validation</small>
            </div>
        </div>
        <div class="d-inline-block w-100">
            <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                <!--Using-->
                <?php if($_SESSION['userType'] == 1) :?>
                <label for="inputDIS" class="font-weight-bold">Type d'utilisation<a style="color: red"> *</a></label>
                <div class="d-inline-block w-100">
                    <div class="w-50 float-left pr-4">
                        <div class="form-group form-check">
                            <input type="checkbox"
                                   class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Academique") {
                                echo "checked";
                            } ?> id="Academique"
                                   name="Academique" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                            <label class="form-check-label" for="Academique">Académique</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox"
                                   class="form-check-input" <?php if ($dataVM[0]['usageType'] == "RaD") {
                                echo "checked";
                            } ?> id="RaD"
                                   name="RaD" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                            <label class="form-check-label" for="RaD">Ra&D</label>
                        </div>
                    </div>
                    <div class="w-50 float-right pl-4">
                        <div class="form-group form-check">
                            <input type="checkbox"
                                   class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Operationnel") {
                                echo "checked";
                            } ?> id="Operationnel"
                                   name="Operationnel" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                            <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox"
                                   class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Test") {
                                echo "checked";
                            } ?> id="Test"
                                   name="Test" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                                echo "readonly";
                            } ?>>
                            <label class="form-check-label" for="Test">Test - Dev</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php else :?>
            <label for="inputDIS" class="font-weight-bold">Type d'utilisation<a style="color: red"> *</a></label>
            <div class="d-inline-block w-100">
                <div class="w-50 float-left pr-4">
                    <div class="form-group form-check">
                        <input type="checkbox" disabled="disabled"
                               class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Academique") {
                            echo "checked";
                        } ?> id="Academique"
                               name="Academique" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                        <label class="form-check-label" for="Academique">Académique</label>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" disabled="disabled"
                               class="form-check-input" <?php if ($dataVM[0]['usageType'] == "RaD") {
                            echo "checked";
                        } ?> id="RaD"
                               name="RaD" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                        <label class="form-check-label" for="RaD">Ra&D</label>
                    </div>
                </div>
                <div class="w-50 float-right pl-4">
                    <div class="form-group form-check">
                        <input type="checkbox" disabled="disabled"
                               class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Operationnel") {
                            echo "checked";
                        } ?> id="Operationnel"
                               name="Operationnel" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                        <label class="form-check-label" for="Operationnel">Opérationnel - Production</label>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" disabled="disabled"
                               class="form-check-input" <?php if ($dataVM[0]['usageType'] == "Test") {
                            echo "checked";
                        } ?> id="Test"
                               name="Test" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                            echo "readonly";
                        } ?>>
                        <label class="form-check-label" for="Test">Test - Dev</label>
                    </div>
                </div>
            </div>
        </div>
            <?php endif;?>
            <!--End Date-->
            <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                <label for="inputEndDate" class="font-weight-bold">Date de fin</label>
                <input type="date" class="form-control form form" value="<?php echo $dataVM[0]['dateEnd'] ?>"
                       id="inputEndDate" name="inputEndDate" aria-describedby="EndDateHelp"
                       placeholder="Entrer un nom ou une addresse de messagerie" <?php if ($_SESSION['userType'] == 2) {
                    echo "readonly";
                } ?>>
                <small id="EndDateHelp" class="form-text text-muted">Date de fin du projet, à laquelle la VM peut être
                    arrêtée puis supprimée.
                </small>
                <small id="EndDateHelp" class="form-text text-muted">S'il n'y a pas d'échéance, une demande de
                    renouvellement sera envoyée tous les 6 mois.
                </small>
            </div>
        </div>
        <!--Objective-->
        <div class="form-group">
            <label for="objective" class="font-weight-bold">Description<a style="color: red"> *</a></label>
            <textarea class="form-control" rows="5" id="objective" maxlength="1000" name="objective"
                      required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>><?php echo $dataVM[0]['description'] ?></textarea>
            <small id="objectiveHelp" class="form-text text-muted">But du projet</small>
        </div>
        <!--Snapshots-->
        <div class="form-group">
            <label for="snapshotsFormControlSelect" class="font-weight-bold">Snapshots<a style="color: red">
                    *</a></label>
            <select class="form-control" id="snapshotsFormControlSelect" name="snapshotsFormControlSelect"
                    required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>>
                <?php
                foreach ($snapshotPolicy as $value) {
                    if ($dataVM[0]['snapshot_id'][1] == $value['name']) {
                        echo "<option selected>" . $value['name'] . " : " . $value['policy'] . "</option>";
                    } else {
                        echo "<option>" . $value['name'] . " : " . $value['policy'] . "</option>";
                    }
                }
                ?>
            </select>
            <small id="snapshotsHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Backup-->
        <div class="form-group">
            <label for="backupFormControlSelect" class="font-weight-bold">Backup<a style="color: red"> *</a></label>
            <select class="form-control" id="backupFormControlSelect" name="backupFormControlSelect"
                    required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>>
                <?php
                foreach ($backupPolicy as $value) {
                    if ($dataVM[0]['backup_id'][1] == $value['name']) {
                        echo "<option selected>" . $value['name'] . " : " . $value['policy'] . "</option>";
                    } else {
                        echo "<option>" . $value['name'] . " : " . $value['policy'] . "</option>";
                    }
                }
                ?>
            </select>
            <small id="backupHelp" class="form-text text-muted">Non disponible sur l'infrastructure de DEV</small>
        </div>
        <!--Checkbox domain EINET-->
        <?php if($_SESSION['userType'] == 1) :?>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" <?php if ($dataVM[0]['domain'] == 1) {
                echo "checked";
            } ?> id="domainEINET"
                   name="domainEINET" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>>
            <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
            <small id="domainEINETHelp" class="form-text text-muted">Pour serveur Windows uniquement</small>
        </div>
        <?php else :?>
        <div class="form-group form-check">
            <input type="checkbox" disabled="disabled" class="form-check-input" <?php if ($dataVM[0]['domain'] == 1) {
                echo "checked";
            } ?> id="domainEINET"
                   name="domainEINET" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>>
            <label class="form-check-label font-weight-bold" for="domainEINET">Domaine EINET</label>
            <small id="domainEINETHelp" class="form-text text-muted">Pour serveur Windows uniquement</small>
        </div>
        <?php endif;?>
        <!--Security-->
        <div class="form-group">
            <label for="securityFormControlSelect" class="font-weight-bold">Sécurité<a style="color: red"> *</a></label>
            <select class="form-control" id="securityFormControlSelect" name="securityFormControlSelect"
                    required <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>>
                <?php
                $securityNames = array("Mises à jour installées par le responsable technique", "Mises à jour installées par le S-ISI de manière automatique");
                for ($i = 0; $i < 2; $i++) {
                    if ($dataVM[0]['network'] == $securityNames[$i]) {
                        echo "<option selected>" . $securityNames[$i] . "</option>";
                    } else {
                        echo "<option>" . $securityNames[$i] . "</option>";
                    }
                }
                ?>
            </select>
            <small id="securityHelp" class="form-text text-muted">Le S-ISI recommande de mettre à jour la VM tous les 90
                jours au minimum
            </small>
        </div>
        <!--technical information-->
        <div class="form-group">
            <label for="ti" class="font-weight-bold">Informations techniques</label>
            <textarea class="form-control" rows="5" id="ti" name="ti"
                      maxlength="1000" <?php if ($_SESSION['userType'] == 0 || $_SESSION['userType'] == 2) {
                echo "readonly";
            } ?>><?php echo $dataVM[0]['comment'] ?></textarea>
            <small id="tiHelp" class="form-text text-muted">Règles firewall, type de compte, justification DMZ ou
                configuration personnalisée, etc...
            </small>
        </div>
        <?php if ($_SESSION['userType'] == 1): ?>
            <!------------------ Admin informations ---------------------->
            <div class="w-100 text-center mt-5"><h5>Informations réservées aux administrateurs</h5></div>
            <hr class="">
            <div class="d-inline-block w-100">
                <!--Cluster-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="editCluster" class="font-weight-bold">Cluster</label>
                    <select class="form-control form form" id="editCluster" name="editCluster"
                            aria-describedby="clusterHelp">
                        <?php
                        $clusterNames = array("PROD-CH", "PROD-YP", "DEV-CH");
                        for ($i = 0; $i < 3; $i++) {
                            if ($dataVM[0]['cluster'] == $clusterNames[$i]) {
                                echo "<option selected>" . $clusterNames[$i] . "</option>";
                            } else {
                                echo "<option>" . $clusterNames[$i] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <!--Date anniversary-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="inputEndDate" class="font-weight-bold">Date d'anniversaire</label>
                    <input type="date" class="form-control form form"
                           value="<?php echo $dataVM[0]['dateAnniversary'] ?>" id="editDateAnniversary"
                           name="editDateAnniversary"
                           aria-describedby="anniversaryDateHelp" <?php if (isset($dataVM[0]['dateEnd']) && $dataVM[0]['dateEnd'] != null || $dataVM[0]['dateEnd'] != false || $dataVM[0]['dateEnd'] != '') {
                        echo 'disabled';
                    } ?>>
                </div>
            </div>

            <div class="d-inline-block w-100">
                <!--IP-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="editIP" class="font-weight-bold">IP</label>
                    <input class="form-control form form" value="<?php echo $dataVM[0]['ip'] ?>" id="editIP"
                           name="editIP" aria-describedby="ipHelp">
                </div>
                <!--dnsName-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="inputEndDate" class="font-weight-bold">Nom DNS</label>
                    <input class="form-control form form" value="<?php echo $dataVM[0]['dnsName'] ?>" id="editDnsName"
                           name="editDnsName" aria-describedby="dnsNameHelp">
                </div>
            </div>

            <div class="d-inline-block w-100">
                <!--Redundance-->
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <label for="editRedundance" class="font-weight-bold">Redondance</label>
                    <select class="js-example-basic-multiple form-control form form" multiple="multiple"
                            id="select2Redundance">
                        <?php
                        $dataRedundances = explode(";", $dataVM[0]['redundance']);

                        foreach ($vms as $vm) {
                            $res = false;
                            for ($i = 0; $i < count($dataRedundances); $i++) {
                                if ($vm[1] == $dataRedundances[$i] || $vm[0] == $dataRedundances[$i]) {
                                    echo '<option value="' . $vm[1] . '" selected>' . $vm[0] . '</option>';
                                    $res = true;
                                }
                            }
                            if (!$res) {
                                echo '<option value="' . $vm[1] . '">' . $vm[0] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="hidden" name="editRedundance" id="editRedundance"
                           value="<?php echo $dataVM[0]['redundance'] ?>" readonly required>
                </div>
                <!--Criticity-->
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <label for="editCriticity" class="font-weight-bold">Criticité</label>
                    <select class="form-control form form" id="editCriticity" name="editCriticity"
                            aria-describedby="criticityHelp">
                        <?php
                        $criticityNames = array("1", "2", "3");
                        for ($i = 0; $i < 3; $i++) {
                            if ($dataVM[0]['criticity'] == $criticityNames[$i]) {
                                echo "<option selected>" . $criticityNames[$i] . "</option>";
                            } else {
                                echo "<option>" . $criticityNames[$i] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['userEmail'] == $dataVM[0]['customer'] || $_SESSION['userType'] == 1): ?>
            <!--Save the modifications-->
            <a onclick="getValue(false)">
                <button type="submit" id="submitButton" class="btn btn-primary m-auto d-inline responsiveDisplay">
                    Enregistrer les modifications
                </button>
            </a>
        <?php endif; ?>

        <?php if ($dataVM[0]['vmStatus'] == 0 && isset($_SESSION['userType']) && $_SESSION['userType'] == 1): ?>
        <div style="top: -38px;position: relative!important;">
            <!-- Accepted -->
            <a onclick="getValue(true)" id="submitButton">
                <button type="submit" class="btn btn-success float-right ml-1 responsiveDisplay">Confirmer la demande
                </button>
            </a>
    </form>
    <!-- Refused -->
    <form method="post" action="../index.php?action=vmRefused">
        <button type="button" class="btn btn-danger float-right responsiveDisplay" data-toggle="modal"
                data-target="#requestDenied">Refuser la demande
        </button>
        <div class="modal fade" id="requestDenied" tabindex="-1" role="dialog" aria-labelledby="requestDeniedLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestDenied">Raison du refus de la demande</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" rows="5" id="deniedRequestInformation"
                                  name="deniedRequestInformation" maxlength="1000" required></textarea>
                        <small id="deniedRequestInformationHelp" class="form-text text-muted">Veuillez décrire la raison
                            du refus de la demande dans le champs texte ci-dessus.
                        </small>
                    </div>
                    <div class="modal-footer">
                        <a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </a>
                        <a>
                            <button type="submit" class="btn btn-primary" style="margin-bottom: 0px !important;">
                                Envoyer
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
</div>
</body>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
