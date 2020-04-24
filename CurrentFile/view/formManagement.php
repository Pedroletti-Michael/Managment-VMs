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
                        <select multiple class="form-control mb-3" id="valueEntityDel" name="valueEntityDel">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addEntity">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left w-33 responsiveDisplay" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyEntity">Modifier</button>
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
                        <select multiple class="form-control mb-3" id="valueEntityAdd" name="valueEntityAdd">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>

                        <input type="text" class="form-control float-left w-75-m responsiveDisplay" id="txtEntityAdd" name="txtEntityAdd" placeholder="Nom">
                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueEntityMod" name="valueEntityMod" onChange="getSelectedValueEntityToModify()">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>
                        <input type="text" class="form-control float-left w-75-m responsiveDisplay" id="txtEntityMod" name="txtEntityMod" placeholder="Nouvelle valeur">
                        <script>function getSelectedValueEntityToModify() {document.getElementById("txtEntityMod").value = document.getElementById("valueEntityMod").value}</script>
                        <button type="submit" class="btn btn-warning float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueOsDel" name='valueOsDel'>
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addOS">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left w-33 responsiveDisplay" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyOS">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--OS (add modal)-->
    <div class="modal fade" id="addOS" tabindex="-1" role="dialog" aria-labelledby="addOS" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editOS">
                    <div class="form-group" name="formulaire" id="form_OS">
                        <label for="disFormControlSelect" class="font-weight-bold">OS</label>
                        <select multiple class="form-control mb-3" id="valueOsAdd" name='valueOsAdd'>
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <select class="form-control float-left w-33 responsiveDisplay" id="typeOsAdd" name="typeOsAdd">
                                <option>Windows</option>
                                <option>Linux / Ubuntu</option>
                            </select>
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtOsAdd" name="txtOsAdd" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueOsMod" name='valueOsMod' onchange="getSelectedValueOsToModify()">
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osType']." ".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <select class="form-control float-left w-33 responsiveDisplay" id="typeOsMod" name="typeOsMod">
                                <option>Windows</option>
                                <option>Linux</option>
                            </select>
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtOsMod" name="txtOsMod" placeholder="Nouvelle valeur">
                            <script>function getSelectedValueOsToModify()
                                    {
                                        var valueOsMod = document.getElementById("valueOsMod").value;
                                        var typeOsMod = "";
                                        var txtOsMod = "";

                                        for(var firstCount = 0; firstCount < valueOsMod.length; firstCount++)
                                        {
                                            if(valueOsMod[firstCount] !== " ")
                                            {
                                                typeOsMod = typeOsMod + valueOsMod[firstCount];
                                            }
                                            else
                                            {
                                                for(; firstCount < valueOsMod.length; firstCount++)
                                                {
                                                    txtOsMod = txtOsMod + valueOsMod[firstCount];
                                                }
                                                break;
                                            }
                                        }
                                        document.getElementById("typeOsMod").value = typeOsMod;
                                        document.getElementById("txtOsMod").value = txtOsMod;
                                    }
                            </script>
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueSnapDel" name='valueSnapDel'>
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addSnapshots">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left w-33 responsiveDisplay" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifySnapshots">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Snapshots (add modal)-->
    <div class="modal fade" id="addSnapshots" tabindex="-1" role="dialog" aria-labelledby="addSnapshots" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editSnapshots">
                    <div class="form-group" name="formulaire" id="form_Snapshots">
                        <label for="disFormControlSelect" class="font-weight-bold">Snapshots</label>
                        <select multiple class="form-control mb-3" id="valueSnapAdd" name='valueSnapAdd'>
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeSnapAdd" name="typeSnapAdd" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtSnapAdd" name="txtSnapAdd" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueSnapMod" name='valueSnapMod' onchange="getSelectedValueSnapToModify()">
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeSnapMod" name="typeSnapMod" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtSnapMod" name="txtSnapMod" placeholder="Nouvelle valeur">
                            <script>function getSelectedValueSnapToModify()
                                {
                                    var valueSnapMod = document.getElementById("valueSnapMod").value;
                                    var typeSnapMod = "";
                                    var txtSnapMod = "";

                                    for(var firstCount = 0; firstCount < valueSnapMod.length; firstCount++)
                                    {
                                        if(valueSnapMod[firstCount] !== ":")
                                        {
                                            typeSnapMod = typeSnapMod + valueSnapMod[firstCount];
                                        }
                                        else
                                        {
                                            for(firstCount += 1; firstCount < valueSnapMod.length; firstCount++)
                                            {
                                                txtSnapMod = txtSnapMod + valueSnapMod[firstCount];
                                            }
                                            break;
                                        }
                                    }
                                    document.getElementById("typeSnapMod").value = typeSnapMod;
                                    document.getElementById("txtSnapMod").value = txtSnapMod;
                                }
                            </script>
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueBackupDel" name='valueBackupDel'>
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addBackup">Ajouter</button>
                        <button type="submit" class="btn btn-danger float-left w-33 responsiveDisplay" value="delete" name="delete" id="delete">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyBackup">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Backup (add modal)-->
    <div class="modal fade" id="addBackup" tabindex="-1" role="dialog" aria-labelledby="addBackup" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editBackup">
                    <div class="form-group" name="formulaire" id="form_Backup">
                        <label for="disFormControlSelect" class="font-weight-bold">Backup</label>
                        <select multiple class="form-control mb-3" id="valueBackupAdd" name='valueBackupAdd'>
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeBackupAdd" name="typeBackupAdd" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtBackupAdd" name="txtBackupAdd" placeholder="Nom">
                        </div>
                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
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
                        <select multiple class="form-control mb-3" id="valueBackupMod" name='valueBackupMod' onchange="getSelectedValueBackupToModify()">
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeBackupMod" name="typeBackupMod" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtBackupMod" name="txtBackupMod" placeholder="Nouvelle valeur">
                            <script>function getSelectedValueBackupToModify()
                                {
                                    var valueBackupMod = document.getElementById("valueBackupMod").value;
                                    var typeBackupMod = "";
                                    var txtBackupMod = "";

                                    for(var firstCount = 0; firstCount < valueBackupMod.length; firstCount++)
                                    {
                                        if(valueBackupMod[firstCount] !== ":")
                                        {
                                            typeBackupMod = typeBackupMod + valueBackupMod[firstCount];
                                        }
                                        else
                                        {
                                            for(firstCount += 1; firstCount < valueBackupMod.length; firstCount++)
                                            {
                                                txtBackupMod = txtBackupMod + valueBackupMod[firstCount];
                                            }
                                            break;
                                        }
                                    }
                                    document.getElementById("typeBackupMod").value = typeBackupMod;
                                    document.getElementById("txtBackupMod").value = txtBackupMod;
                                }
                            </script>
                        </div>
                        <button type="submit" class="btn btn-warning float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
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