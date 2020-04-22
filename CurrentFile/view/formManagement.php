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
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="../view/js/jquery.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <meta charset="UTF-8">
    <title>Gestion form - HEIG-VD</title>
</head>
<body>
<div class="container-fluid pt-3">
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">
        Gestion du formulare
    </h3>
    <!--Buttons-->
    <div class="d-inline-block w-100">
        <div class="w-50 float-left p-3" style="height: 200px">
            <!--Department / Institution / Service-->
            <button type="button" class="btn btn-primary w-100 h-100" data-toggle="modal" data-target="#modalEntity">
                <h5>Entity</h5>
            </button>
        </div>
        <div class="w-50 float-right p-3" style="height: 200px">
            <!--OS-->
            <button type="button" class="btn btn-primary w-100 h-100" data-toggle="modal" data-target="#modalOS">
                <h5>OS</h5>
            </button>
        </div>
    </div>
    <div class="d-inline-block  w-100">
        <div class="w-50 float-left p-3" style="height: 200px">
            <!--Snapshots-->
            <button type="button" class="btn btn-primary w-100 h-100" data-toggle="modal" data-target="#modalSnapshots">
                <h5>Snapshots</h5>
            </button>
        </div>
        <div class="w-50 float-right p-3" style="height: 200px">
            <!--Backup-->
            <button type="button" class="btn btn-primary w-100 h-100" data-toggle="modal" data-target="#modalBackup">
                <h5>Backup</h5>
            </button>
        </div>
    </div>

    <!--Department / Institution / Service-->
    <div class="modal fade" id="modalEntity" tabindex="-1" role="dialog" aria-labelledby="modalEntity" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editEntity">
                    <div class="form-group" name="formulaire" id="form_Entity">
                        <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
                        <select multiple class="form-control mb-3" id="value" name="value">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left" data-toggle="modal" data-target="#addEntity" style="width: 20%!important;" value="add" name="add" id="add">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left" style="width: 20%!important;" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left" data-toggle="modal" data-target="#modifyEntity" style="width: 20%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Department / Institution / Service (add modal)-->
    <div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntity" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editEntity">
                    <div class="form-group" name="formulaire" id="form_Entity">
                        <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
                        <select multiple class="form-control mb-3" id="value" name="value">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>

                        <input type="text" class="form-control float-left" style="width: 40%!important;" id="txt" name="txt" placeholder="Nom">
                        <button type="submit" class="btn btn-success float-left" style="width: 20%!important;" value="add" name="add" id="add">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Department / Institution / Service (modify modal)-->
    <div class="modal fade" id="modifyEntity" tabindex="-1" role="dialog" aria-labelledby="modifyEntity" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editEntity">
                    <div class="form-group" name="formulaire" id="form_Entity">
                        <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
                        <select multiple class="form-control mb-3" id="value2" name="value2" onChange="getSelectedValue()">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>
                        <input type="text" class="form-control float-left w-50" id="txt2" name="txt2" placeholder="Nouvelle valeur">
                        <script>function getSelectedValue() {document.getElementById("txt2").value = document.getElementById("value2").value}</script>
                        <button type="submit" class="btn btn-warning float-left w-25" value="modify" name="modify" id="modify">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--OS-->
    <div class="modal fade" id="modalOS" tabindex="-1" role="dialog" aria-labelledby="modalOS" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editOS">
                    <div class="form-group" name="formulaire" id="form_OS">
                        <label for="disFormControlSelect" class="font-weight-bold">OS</label>
                        <select multiple class="form-control mb-3" id="value" name='value'>
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 63.36%!important;">
                            <select class="form-control float-left" style="width: 30%!important;" id="type" name="type">
                                <option>Windows</option>
                                <option>Linux / Ubuntu</option>
                            </select>
                            <input type="text" class="form-control float-left" style="width: 42.5%!important;" id="txt" name="txt" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left" style="width: 18%!important;" value="add" name="add" id="add">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left" style="width: 18%!important;" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left" data-toggle="modal" data-target="#modifyOS" style="width: 18%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--OS (modify modal)-->
    <div class="modal fade" id="modifyOS" tabindex="-1" role="dialog" aria-labelledby="modifyOS" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editOS">
                    <div class="form-group" name="formulaire" id="form_OS">
                        <label for="disFormControlSelect" class="font-weight-bold">OS</label>
                        <select multiple class="form-control mb-3" id="value2" name='value2'>
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 63.36%!important;">
                            <select class="form-control float-left" style="width: 30%!important;" id="type" name="type">
                                <option>Windows</option>
                                <option>Linux / Ubuntu</option>
                            </select>
                            <input type="text" class="form-control float-left w-50" id="txt2" name="txt2" placeholder="Nouvelle valeur">
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25" value="modify" name="modify" id="modify">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Snapshots-->
    <div class="modal fade" id="modalSnapshots" tabindex="-1" role="dialog" aria-labelledby="modalSnapshots" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editSnapshots">
                    <div class="form-group" name="formulaire" id="form_Snapshots">
                        <label for="disFormControlSelect" class="font-weight-bold">Snapshots</label>
                        <select multiple class="form-control mb-3" id="value" name='value'>
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 40%!important;">
                            <input type="text" class="form-control float-left" style="width: 30%!important;" id="type" name="type" placeholder="Type">
                            <input type="text" class="form-control float-left" style="width: 70%!important;" id="txt" name="txt" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left" style="width: 20%!important;" value="add" name="add" id="add">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left" style="width: 20%!important;" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left" data-toggle="modal" data-target="#modifySnapshots" style="width: 20%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Snapshots (modify modal)-->
    <div class="modal fade" id="modifySnapshots" tabindex="-1" role="dialog" aria-labelledby="modifySnapshots" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editSnapshots">
                    <div class="form-group" name="formulaire" id="form_Snapshots">
                        <label for="disFormControlSelect" class="font-weight-bold">Snapshots</label>
                        <select multiple class="form-control mb-3" id="value" name='value'>
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 40%!important;">
                            <input type="text" class="form-control float-left" style="width: 30%!important;" id="type" name="type" placeholder="Type">
                            <input type="text" class="form-control float-left w-50" id="txt2" name="txt2" placeholder="Nouvelle valeur">
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25" value="modify" name="modify" id="modify">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Backup-->
    <div class="modal fade" id="modalBackup" tabindex="-1" role="dialog" aria-labelledby="modalBackup" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editBackup">
                    <div class="form-group" name="formulaire" id="form_Backup">
                        <label for="disFormControlSelect" class="font-weight-bold">Backup</label>
                        <select multiple class="form-control mb-3" id="value" name='value'>
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 40%!important;">
                            <input type="text" class="form-control float-left" style="width: 30%!important;" id="type" name="type" placeholder="Type">
                            <input type="text" class="form-control float-left" style="width: 70%!important;" id="txt" name="txt" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left" style="width: 20%!important;" value="add" name="add" id="add">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left" style="width: 20%!important;" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left" data-toggle="modal" data-target="#modifyBackup" style="width: 20%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Backup (modify modal)-->
    <div class="modal fade" id="modifyBackup" tabindex="-1" role="dialog" aria-labelledby="modifyBackup" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editBackup">
                    <div class="form-group" name="formulaire" id="form_Backup">
                        <label for="disFormControlSelect" class="font-weight-bold">Backup</label>
                        <select multiple class="form-control mb-3" id="value" name='value'>
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div style="width: 40%!important;">
                            <input type="text" class="form-control float-left" style="width: 30%!important;" id="type" name="type" placeholder="Type">
                            <input type="text" class="form-control float-left w-50" id="txt2" name="txt2" placeholder="Nouvelle valeur">
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25" value="modify" name="modify" id="modify">Confirmer</button>
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