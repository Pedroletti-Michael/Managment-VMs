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

    <!--Department / Institution / Service-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEntity">Entity</button><br>

        <div class="modal fade" id="modalEntity" tabindex="-1" role="dialog" aria-labelledby="modalEntity" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
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
                        <button type="submit" class="btn btn-success float-left" style="width: 20%!important;" value="add" name="add" id="add">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left" style="width: 20%!important;" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left" data-toggle="modal" data-target="#displayUpdateView" style="width: 20%!important;">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

         <div class="modal fade" id="displayUpdateView" tabindex="-1" role="dialog" aria-labelledby="displayUpdateView" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document">
                 <div class="modal-content">
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
                         <input type="text" class="form-control float-left" style="width: 40%!important;" id="txt" name="txt" placeholder="Nouvelle valeur">
                         <button type="submit" class="btn btn-warning float-left" style="width: 18%!important;" value="modify" name="modify" id="modify">Confirmer</button>
                     </div>
                     </form>
                 </div>
            </div>
         </div>

    <!--OS-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOS">
        OS
    </button>

    <form method="post" action="../index.php?action=editOS">
        <div class="modal fade" id="modalOS" tabindex="-1" role="dialog" aria-labelledby="modalOS" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
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
                        <button type="submit" class="btn btn-warning float-left" style="width: 18%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Snapshots-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSnapshots">
        Snapshots
    </button>

    <form method="post" action="../index.php?action=editSnapshots">
        <div class="modal fade" id="modalSnapshots" tabindex="-1" role="dialog" aria-labelledby="modalSnapshots" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
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
                        <button type="submit" class="btn btn-warning float-left" style="width: 20%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Backup-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBackup">
        Backup
    </button>

    <form method="post" action="../index.php?action=editBackup">
        <div class="modal fade" id="modalBackup" tabindex="-1" role="dialog" aria-labelledby="modalBackup" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
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
                        <button type="submit" class="btn btn-warning float-left" style="width: 20%!important;" value="modify" name="modify" id="modify">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>