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
        Gestion du formulaire
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
                        <select multiple class="form-control mb-3" id="valueEntityDel" name="valueEntityDel" onchange="getSelectedEntityToDelete()">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addEntity">Ajouter</button>
                        <button type="button" onclick="confirmationDeleteEntity()" class="btn btn-danger float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#confirmationDeleteEntity">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyEntity">Modifier</button>

                        <!--Department / Institution / Service (confirmation delete modal)-->
                        <div class="modal fade" id="confirmationDeleteEntity" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteEntity" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationDeleteEntitySelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="delete" name="delete" id="delete">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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

    <!--Department / Institution / Service (modify modal)-->
    <div class="modal fade" id="modifyEntity" tabindex="-1" role="dialog" aria-labelledby="modifyEntity" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-3">
                <form method="post" action="../index.php?action=editEntity">
                    <div class="form-group" name="formulaire" id="form_Entity">

                        <label for="disFormControlSelect" class="font-weight-bold">Département / Institution / Service</label>
                        <select multiple class="form-control mb-3" id="valueEntityMod" name="valueEntityMod" onChange="displaySelectedValueEntity()">
                            <?php
                            foreach ($entityNames as $value) {
                                echo "<option>".$value['entityName']."</option>";
                            }
                            ?>
                        </select>
                        <input type="text" class="form-control float-left w-75-m responsiveDisplay" id="txtEntityMod" name="txtEntityMod" placeholder="Nouvelle valeur">

                        <button type="button" onclick="confirmationModifyEntity()" class="btn btn-success float-left w-25-m responsiveDisplay" data-toggle="modal" data-target="#confirmationModifyEntity">Confirmer</button>

                        <!--Department / Institution / Service (confirmation modify modal)-->
                        <div class="modal fade" id="confirmationModifyEntity" tabindex="-1" role="dialog" aria-labelledby="confirmationModifyEntity" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationModifyEntitySelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function getSelectedEntityToDelete()
                            {
                                var elementToDelete = document.getElementById("valueEntityDel").value;
                                return elementToDelete;
                            }

                            function confirmationDeleteEntity()
                            {
                                var elementToDelete = getSelectedEntityToDelete();

                                $("#confirmationDeleteEntitySelected").html('Êtes-vous sûr de vouloir supprimer le champ : <b>'+ elementToDelete + '</b> ?');
                            }

                            function displaySelectedValueEntity(getSelectedValue)
                            {
                                if(getSelectedValue !== true)
                                {
                                    document.getElementById("txtEntityMod").value = document.getElementById("valueEntityMod").value;
                                }
                                else
                                {
                                    var basicElement = document.getElementById("valueEntityMod").value;
                                    return basicElement;
                                }
                            }

                            function confirmationModifyEntity()
                            {
                                var editedElement = document.getElementById("txtEntityMod").value;
                                var basicElement = displaySelectedValueEntity(true);

                                $("#confirmationModifyEntitySelected").html('Êtes-vous sûr de vouloir changer le champ : <b>' + basicElement + '</b> en <b>' + editedElement + '</b> ?');
                            }
                        </script>

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
                        <select multiple class="form-control mb-3" id="valueOSDel" name='valueOSDel' onchange="getSelectedOSToDelete()">
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osType']." ".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addOS">Ajouter</button>
                        <button type="button" onclick="confirmationDeleteOS()" class="btn btn-danger float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#confirmationDeleteOS">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyOS">Modifier</button>

                        <!--OS(confirmation delete modal)-->
                        <div class="modal fade" id="confirmationDeleteOS" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteOS" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationDeleteOSSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="delete" name="delete" id="delete">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <select multiple class="form-control mb-3" id="valueOSAdd" name='valueOSAdd'>
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <select class="form-control float-left w-33 responsiveDisplay" id="typeOSAdd" name="typeOSAdd">
                                <option>Windows</option>
                                <option>Linux</option>
                            </select>
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtOSAdd" name="txtOSAdd" placeholder="Nom">
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
                        <select multiple class="form-control mb-3" id="valueOSMod" name='valueOSMod' onchange="displaySelectedValueOS()">
                            <?php
                            foreach ($osNames as $value) {
                                echo "<option value='".$value['osType']." ".$value['osName']."'>".$value['osType']." ".$value['osName']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <select class="form-control float-left w-33 responsiveDisplay" id="typeOSMod" name="typeOSMod">
                                <option>Windows</option>
                                <option>Linux</option>
                            </select>
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtOSMod" name="txtOSMod" placeholder="Nouvelle valeur">
                        </div>
                        <button type="button" onclick="confirmationModifyOS()" class="btn btn-success float-left w-25-m  responsiveDisplay" data-toggle="modal" data-target="#confirmationModifyOS">Confirmer</button>

                        <!--OS (confirmation modify modal)-->
                        <div class="modal fade" id="confirmationModifyOS" tabindex="-1" role="dialog" aria-labelledby="confirmationModifyOS" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationModifyOSSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function getSelectedOSToDelete()
                            {
                                var elementToDelete = document.getElementById("valueOSDel").value;
                                return elementToDelete;
                            }

                            function confirmationDeleteOS()
                            {
                                var elementToDelete = getSelectedOSToDelete();

                                $("#confirmationDeleteOSSelected").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + elementToDelete + '<b/> ?');
                            }

                            function displaySelectedValueOS(getSelectedValue)
                            {
                                var valueOSMod = document.getElementById("valueOSMod").value;
                                var typeOSMod = "";
                                var txtOSMod = "";

                                for(var count = 0; count < valueOSMod.length; count++)
                                {
                                    if(valueOSMod[count] !== " ")
                                    {
                                        typeOSMod = typeOSMod + valueOSMod[count];
                                    }
                                    else
                                    {
                                        for(count += 1; count< valueOSMod.length; count++)
                                        {
                                            txtOSMod = txtOSMod + valueOSMod[count];
                                        }
                                        break;
                                    }
                                }

                                if(getSelectedValue !== true)
                                {
                                    document.getElementById("typeOSMod").value = typeOSMod;
                                    document.getElementById("txtOSMod").value = txtOSMod;
                                }
                                else
                                {
                                    return valueOSMod;
                                }
                            }

                            function confirmationModifyOS()
                            {
                                var editedElement = document.getElementById("typeOSMod").value + " " + document.getElementById("txtOSMod").value;
                                var basicElement = displaySelectedValueOS(true);

                                $("#confirmationModifyOSSelected").html('Êtes-vous sûr de vouloir changer le champ : <b>' + basicElement + '</b> en <b>' + editedElement + '</b> ?');
                            }
                        </script>

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
                        <select multiple class="form-control mb-3" id="valueSnapDel" name='valueSnapDel' onchange="getSelectedSnapshotsToDelete()">
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addSnapshots">Ajouter</button>
                        <button type="button" onclick="confirmationDeleteSnapshots()" class="btn btn-danger float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#confirmationDeleteSnapshots">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifySnapshots">Modifier</button>

                        <!--Snapshots(confirmation delete modal)-->
                        <div class="modal fade" id="confirmationDeleteSnapshots" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteSnapshots" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationDeleteSnapshotsSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="delete" name="delete" id="delete">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <select multiple class="form-control mb-3" id="valueSnapMod" name='valueSnapMod' onchange="displaySelectedValueSnapshots()">
                            <?php
                            foreach ($snapshotPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeSnapMod" name="typeSnapMod" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtSnapMod" name="txtSnapMod" placeholder="Nouvelle valeur">
                        </div>
                        <button type="button" onclick="confirmationModifySnapshots()" class="btn btn-success float-left w-25-m  responsiveDisplay" data-toggle="modal" data-target="#confirmationModifySnapshots">Confirmer</button>

                        <!--Snapshots (confirmation modify modal)-->
                        <div class="modal fade" id="confirmationModifySnapshots" tabindex="-1" role="dialog" aria-labelledby="confirmationModifySnapshots" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationModifySnapshotsSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function getSelectedSnapshotsToDelete()
                            {
                                var elementToDelete = document.getElementById("valueSnapDel").value;
                                return elementToDelete;
                            }

                            function confirmationDeleteSnapshots()
                            {
                                var elementToDelete = getSelectedSnapshotsToDelete();

                                $("#confirmationDeleteSnapshotsSelected").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + elementToDelete + '</b> ?');
                            }

                            function displaySelectedValueSnapshots(getSelectedValue)
                            {
                                var valueSnapMod = document.getElementById("valueSnapMod").value;
                                var typeSnapMod = "";
                                var txtSnapMod = "";

                                for(var count = 0; count < valueSnapMod.length; count++)
                                {
                                    if(valueSnapMod[count] !== " ")
                                    {
                                        typeSnapMod = typeSnapMod + valueSnapMod[count];
                                    }
                                    else
                                    {
                                        for(count += 3; count < valueSnapMod.length; count++)
                                        {
                                            txtSnapMod = txtSnapMod + valueSnapMod[count];
                                        }
                                        break;
                                    }
                                }

                                if(getSelectedValue !== true)
                                {
                                    document.getElementById("typeSnapMod").value = typeSnapMod;
                                    document.getElementById("txtSnapMod").value = txtSnapMod;
                                }
                                else
                                {
                                    return valueSnapMod;
                                }
                            }

                            function confirmationModifySnapshots()
                            {
                                var editedElement = document.getElementById("typeSnapMod").value + " : " + document.getElementById("txtSnapMod").value;
                                var basicElement = displaySelectedValueSnapshots(true);

                                $("#confirmationModifySnapshotsSelected").html('Êtes-vous sûr de vouloir changer le champ : <b>' + basicElement + '</b> en <b>' + editedElement + '</b> ?');
                            }
                        </script>

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
                        <select multiple class="form-control mb-3" id="valueBackupDel" name='valueBackupDel' onchange="getSelectedBackupToDelete()">
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-success float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#addBackup">Ajouter</button>
                        <button type="button" onclick="confirmationDeleteBackup()" class="btn btn-danger float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#confirmationDeleteBackup">Supprimer</button>
                        <button type="button" class="btn btn-warning float-left w-33 responsiveDisplay" data-toggle="modal" data-target="#modifyBackup">Modifier</button>

                        <!--Backup(confirmation delete modal)-->
                        <div class="modal fade" id="confirmationDeleteBackup" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteBackup" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationDeleteBackupSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="delete" name="delete" id="delete">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <select multiple class="form-control mb-3" id="valueBackupMod" name='valueBackupMod' onchange="displaySelectedValueBackup()">
                            <?php
                            foreach ($backupPolicy as $value) {
                                echo "<option value='".$value['name']." : ".$value['policy']."'>".$value['name']." : ".$value['policy']."</option>";
                            }
                            ?>
                        </select>
                        <div class="w-75-m responsiveDisplay">
                            <input type="text" class="form-control float-left w-33 responsiveDisplay" id="typeBackupMod" name="typeBackupMod" placeholder="Type">
                            <input type="text" class="form-control float-left w-66 responsiveDisplay" id="txtBackupMod" name="txtBackupMod" placeholder="Nouvelle valeur">
                        </div>
                        <button type="button" onclick="confirmationModifyBackup()" class="btn btn-success float-left w-25-m  responsiveDisplay" data-toggle="modal" data-target="#confirmationModifyBackup">Confirmer</button>

                        <!--Backup (confirmation modify modal)-->
                        <div class="modal fade" id="confirmationModifyBackup" tabindex="-1" role="dialog" aria-labelledby="confirmationModifyBackup" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content p-6">
                                    <div class="modal-body">
                                        <h6 id="confirmationModifyBackupSelected"></h6>

                                        <button type="submit" class="btn btn-success float-left w-25-m responsiveDisplay" value="modify" name="modify" id="modify">OUI</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function getSelectedBackupToDelete()
                            {
                                var elementToDelete = document.getElementById("valueBackupDel").value;
                                return elementToDelete;
                            }

                            function confirmationDeleteBackup()
                            {
                                var elementToDelete = getSelectedBackupToDelete();

                                $("#confirmationDeleteBackupSelected").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + elementToDelete + '</b> ?');
                            }

                            function displaySelectedValueBackup(getSelectedValue)
                            {
                                var valueBackupMod = document.getElementById("valueBackupMod").value;
                                var typeBackupMod = "";
                                var txtBackupMod = "";

                                for(var count = 0; count < valueBackupMod.length; count++)
                                {
                                    if(valueBackupMod[count] !== " ")
                                    {
                                        typeBackupMod = typeBackupMod + valueBackupMod[count];
                                    }
                                    else
                                    {
                                        for(count += 3; count < valueBackupMod.length; count++)
                                        {
                                            txtBackupMod = txtBackupMod + valueBackupMod[count];
                                        }
                                        break;
                                    }
                                }

                                if(getSelectedValue !== true)
                                {
                                    document.getElementById("typeBackupMod").value = typeBackupMod;
                                    document.getElementById("txtBackupMod").value = txtBackupMod;
                                }
                                else
                                {
                                    return valueBackupMod;
                                }
                            }

                            function confirmationModifyBackup()
                            {
                                var editedElement = document.getElementById("typeBackupMod").value + " : " + document.getElementById("txtBackupMod").value;
                                var basicElement = displaySelectedValueBackup(true);

                                $("#confirmationModifyBackupSelected").html('Êtes-vous sûr de vouloir changer le champ : <b>' + basicElement + '</b> en <b>' + editedElement + '</b> ?');
                            }
                        </script>

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