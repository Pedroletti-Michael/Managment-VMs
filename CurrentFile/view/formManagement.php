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
    <script rel="javascript" src="../view/js/jquery.js"></script>
    <script rel="javascript" src="../view/js/script.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="../view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <meta charset="UTF-8">
    <title>Gestion form - HEIG-VD</title>
</head>
<body>
<div class="container-fluid pt-3">
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3">
        Gestion du formulaire
    </h3>
    <!--Buttons-->
    <form method="post" action="../index.php?action=formManagement">
        <div class="btn-group btn-group-toggle w-100-responsive" data-toggle="buttons">
            <?php if ($arrayToDisplay == "entity"): ?>
                <a href="../index.php?action=formManagement&array=entity" class="btn btn-light active border border-primary" >
                    <input type="radio" name="options" id="option1" checked> Entity
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=entity" class="btn border border-primary" >
                    <input type="radio" name="options" id="option1"> Entity
                </a>
            <?php endif; ?>
            <?php if ($arrayToDisplay == "os"): ?>
                <a href="../index.php?action=formManagement&array=os" class="btn btn-light active border border-primary">
                    <input type="radio" name="options" id="option2" checked> OS
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=os" class="btn border border-primary">
                    <input type="radio" name="options" id="option2"> OS
                </a>
            <?php endif; ?>
            <?php if ($arrayToDisplay == "snapshots"): ?>
                <a href="../index.php?action=formManagement&array=snapshots" class="btn btn-light active border border-primary">
                    <input type="radio" name="options" id="option3" checked> Snapshots
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=snapshots" class="btn border border-primary">
                    <input type="radio" name="options" id="option3"> Snapshots
                </a>
            <?php endif; ?>
            <?php if ($arrayToDisplay == "backup"): ?>
                <a href="../index.php?action=formManagement&array=backup" class="btn btn-light active border border-primary">
                    <input type="radio" name="options" id="option4" checked> Backup
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=backup" class="btn border border-primary">
                    <input type="radio" name="options" id="option4"> Backup
                </a>
            <?php endif; ?>
            <?php if ($arrayToDisplay == "cluster"): ?>
                <a href="../index.php?action=formManagement&array=cluster" class="btn btn-light active border border-primary">
                    <input type="radio" name="options" id="option5" checked> Cluster
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=cluster" class="btn border border-primary">
                    <input type="radio" name="options" id="option5"> Cluster
                </a>
            <?php endif; ?>
            <?php if ($arrayToDisplay == "site"): ?>
                <a href="../index.php?action=formManagement&array=site" class="btn btn-light active border border-primary">
                    <input type="radio" name="options" id="option5" checked> Site
                </a>
            <?php else : ?>
                <a href="../index.php?action=formManagement&array=site" class="btn border border-primary">
                    <input type="radio" name="options" id="option5"> Site
                </a>
            <?php endif; ?>
        </div>
    </form>

    <!--Entity-->
    <?php if($arrayToDisplay == "entity") :?>
        <form method="post" action="../index.php?action=editEntity">
            <div class="form-group mt-2" name="formulaire" id="form_Entity">
                <table id="valueEntityDel" name="valueEntityDel" class="w-100 table table-hover rounded">
                    <?php
                    foreach ($entityNames as $value) {
                        echo "<tr><td class='formManagement'>".$value."</td></tr>";
                    }
                    ?>
                </table>
                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addEntity">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifyEntity">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteEntity">Supprimer</button>
                </div>

                <!--Entity (delete modal)-->
                <div class="modal fade" id="deleteEntity" tabindex="-1" role="dialog" aria-labelledby="deleteEntity" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>Entity</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelEntity">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueEntityToDelete" name="valueEntityToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--Entity (add modal)-->
        <div class="modal fade" id="addEntity" tabindex="-1" role="dialog" aria-labelledby="addEntity" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>Entity</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editEntity">
                        <div class="modal-body">
                            <input type="text" class="form-control responsiveDisplay" id="txtEntityAdd" name="txtEntityAdd" placeholder="Entity">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Entity (modify modal)-->
        <div class="modal fade" id="modifyEntity" tabindex="-1" role="dialog" aria-labelledby="modifyEntity" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>Entity</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editEntity">
                        <div class="modal-body">
                            <input type="text" id="valueEntityMod" name="valueEntityMod" hidden>

                            <h6 id="textModEntity" class="float-left">Aucun champ n'a été sélectionné</h6>
                            <input type="text" class="form-control responsiveDisplay" id="txtEntityMod" name="txtEntityMod" placeholder="Nouvelle valeur">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                        </div>

                        <script>
                            $("#valueEntityDel tr").click(function(){
                                $(this).addClass('selected').siblings().removeClass('selected');
                                var value=$(this).find('td:first').html();
                                document.getElementById("valueEntityDel").value = value;
                                document.getElementById("valueEntityToDelete").value = value;
                                getSelectedEntityToDisplayOnModify();getSelectedEntityToDisplayOnDelete();
                            });

                            function getSelectedEntityToDisplayOnDelete()
                            {
                                var selectedValue = document.getElementById("valueEntityDel").value;

                                $("#textDelEntity").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + selectedValue + '<b/> ?');
                            }

                            function getSelectedEntityToDisplayOnModify()
                            {
                                var selectedValue = document.getElementById("valueEntityDel").value;
                                document.getElementById("valueEntityMod").value = selectedValue;
                                document.getElementById("txtEntityMod").value = selectedValue;
                                $("#textModEntity").html('Changer le champ <b>' + selectedValue + '</b> en :');
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>

    <!--OS-->
    <?php elseif ($arrayToDisplay == "os") :?>
        <form method="post" action="../index.php?action=editOS">
            <div class="form-group mt-2" name="formulaire" id="form_OS">
                <table id="valueOSDel" name="valueOSDel" class="w-100 table table-hover rounded">
                    <?php
                    foreach ($osNames as $value) {
                        echo "<tr><td class='formManagement'>".$value['osType']."</td><td class='formManagement'>".$value['osName']."</td><td class='formManagement'>".$value['statusCommendable']."</td></tr>";
                    }
                    ?>
                </table>
                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addOS">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifyOS">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteOS">Supprimer</button>
                </div>

                <!--OS (delete modal)-->
                <div class="modal fade" id="deleteOS" tabindex="-1" role="dialog" aria-labelledby="deleteOS" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>OS</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelOS">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueOSToDelete" name="valueOSToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!--OS (add modal)-->
        <div class="modal fade" id="addOS" tabindex="-1" role="dialog" aria-labelledby="addOS" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>OS</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editOS">
                        <div class="modal-body">
                            <select class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeOSAdd" name="typeOSAdd">
                                <option>Windows</option>
                                <option>Linux</option>
                            </select>
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtOSAdd" name="txtOSAdd" placeholder="Version">

                            <input type="checkbox" class="form-check-input" id="osCommendableAdd" name="osCommendableAdd">
                            <label class="form-check-label font-weight-bold" for="osCommendableAdd">OS commandable ?</label>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--OS (modify modal)-->
        <div class="modal fade" id="modifyOS" tabindex="-1" role="dialog" aria-labelledby="modifyOS" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>OS</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editOS">
                        <div class="modal-body">
                            <input type="text" id="valueOSMod" name="valueOSMod" hidden>

                            <h6 id="textModOs">Aucun champ n'a été sélectionné</h6>
                            <select class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeOSMod" name="typeOSMod">
                                <option>Windows</option>
                                <option>Linux</option>
                            </select>
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtOSMod" name="txtOSMod" placeholder="Nouvelle valeur">

                            <input type="checkbox" class="form-check-input" id="osCommendableMod" name="osCommendableMod">
                            <label class="form-check-label font-weight-bold" for="osCommendableMod">OS commandable ?</label>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                            </div>
                            <script>
                                $("#valueOSDel tr").click(function(){
                                    $(this).addClass('selected').siblings().removeClass('selected');
                                    var firstValue =$(this).find('td:first').html();
                                    var secondValue =$(this).find('td:nth-child(2)').html();
                                    var thirdValue =$(this).find('td:last').html();

                                    if(thirdValue !== "0")
                                    {
                                        document.getElementById("osCommendableMod").checked = false;
                                    }
                                    else
                                    {
                                        document.getElementById("osCommendableMod").checked = true;
                                    }

                                    document.getElementById("valueOSDel").value = firstValue + " " + secondValue;
                                    document.getElementById("valueOSToDelete").value = firstValue + " " + secondValue;
                                    $("#textDelOS").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + firstValue + " " + secondValue + '<b/> ?');

                                    getSelectedOSToDelete();getSelectedOSToDisplayOnModify();
                                });

                                function getSelectedOSToDelete()
                                {
                                    var elementToDelete = document.getElementById("valueOSDel").value;
                                    return elementToDelete;
                                }

                                function getSelectedOSToDisplayOnModify()
                                {
                                    var selectedValue = document.getElementById("valueOSDel").value;
                                    var typeOSMod = "";
                                    var txtOSMod = "";

                                    for(var count = 0; count < selectedValue.length; count++)
                                    {
                                        if(selectedValue[count] !== " ")
                                        {
                                            typeOSMod = typeOSMod + selectedValue[count];
                                        }
                                        else
                                        {
                                            for(count += 1; count< selectedValue.length; count++)
                                            {
                                                txtOSMod = txtOSMod + selectedValue[count];
                                            }
                                            break;
                                        }
                                    }
                                    document.getElementById("valueOSMod").value = selectedValue;
                                    document.getElementById("typeOSMod").value = typeOSMod;
                                    document.getElementById("txtOSMod").value = txtOSMod;
                                    console.log(selectedValue, typeOSMod, txtOSMod);
                                    $("#textModOs").html('Modifier le champ <b>' + selectedValue + '</b> en :');
                                }
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--Snapshots-->
    <?php elseif($arrayToDisplay == "snapshots") :?>
        <form method="post" action="../index.php?action=editSnapshots">
            <div class="form-group mt-2" name="formulaire" id="form_Snapshots">
                <table id="valueSnapDel" name="valueSnapDel"  class="w-100 table table-hover rounded">
                    <?php
                    foreach ($snapshotPolicy as $value) {
                        echo "<tr><td class='formManagement'>".$value['name']."</td><td class='formManagement'>".$value['policy']."</td></tr>";
                    }
                    ?>
                </table>
                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addSnapshots">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifySnapshots">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteSnapshots">Supprimer</button>
                </div>

                <!--Snapshots (delete modal)-->
                <div class="modal fade" id="deleteSnapshots" tabindex="-1" role="dialog" aria-labelledby="deleteSnapshots" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>Snapshots</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelSnap">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueSnapToDelete" name="valueSnapToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!--Snapshots (add modal)-->
        <div class="modal fade" id="addSnapshots" tabindex="-1" role="dialog" aria-labelledby="addSnapshots" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>Snapshots</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editSnapshots">
                        <div class="modal-body">
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeSnapAdd" name="typeSnapAdd" placeholder="Type">
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtSnapAdd" name="txtSnapAdd" placeholder="Description">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Snapshots (modify modal)-->
        <div class="modal fade" id="modifySnapshots" tabindex="-1" role="dialog" aria-labelledby="modifySnapshots" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>Snapshots</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editSnapshots">
                        <div class="modal-body">
                            <input type="text" id="valueSnapMod" name="valueSnapMod" hidden>

                            <h6 id="textModSnap">Aucun champ n'a été sélectionné</h6>
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeSnapMod" name="typeSnapMod" placeholder="Nouvelle valeur">
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtSnapMod" name="txtSnapMod" placeholder="Nouvelle valeur">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                        </div>

                            <script>
                                $("#valueSnapDel tr").click(function(){
                                    $(this).addClass('selected').siblings().removeClass('selected');
                                    var firstValue =$(this).find('td:first').html();
                                    var secondValue =$(this).find('td:last').html();
                                    document.getElementById("valueSnapDel").value = firstValue + " " + secondValue;
                                    document.getElementById("valueSnapToDelete").value = firstValue + " " + secondValue;
                                    $("#textDelSnap").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + firstValue + " " + secondValue + '<b/> ?');
                                    getSelectedSnapshotsToDelete();getSelectedSnapshotsToDisplayOnModify();
                                });

                                function getSelectedSnapshotsToDelete()
                                {
                                    var elementToDelete = document.getElementById("valueSnapDel").value;
                                    return elementToDelete;
                                }

                                function getSelectedSnapshotsToDisplayOnModify()
                                {
                                    var selectedValue = document.getElementById("valueSnapDel").value;
                                    var typeSnapMod = "";
                                    var txtSnapMod = "";

                                    for(var count = 0; count < selectedValue.length; count++)
                                    {
                                        if(selectedValue[count] !== " ")
                                        {
                                            typeSnapMod = typeSnapMod + selectedValue[count];
                                        }
                                        else
                                        {
                                            for(count += 1; count < selectedValue.length; count++)
                                            {
                                                txtSnapMod = txtSnapMod + selectedValue[count];
                                            }
                                            break;
                                        }
                                    }
                                    document.getElementById("valueSnapMod").value = selectedValue;
                                    document.getElementById("typeSnapMod").value = typeSnapMod;
                                    document.getElementById("txtSnapMod").value = txtSnapMod;
                                    $("#textModSnap").html('Modifier le champ <b>' + selectedValue + '</b> en :');
                                }
                            </script>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--Backup-->
    <?php elseif($arrayToDisplay == "backup") :?>
        <form method="post" action="../index.php?action=editBackup">
            <div class="form-group mt-2" name="formulaire" id="form_Backup">
                <table id="valueBackupDel" name="valueBackupDel" class="w-100 table table-hover rounded">
                    <?php
                    foreach ($backupPolicy as $value) {
                        echo "<tr><td class='formManagement'>".$value['name']."</td><td class='formManagement'>".$value['policy']."</td></tr>";
                    }
                    ?>
                </table>

                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addBackup">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifyBackup">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteBackup">Supprimer</button>
                </div>

                <!--Backup (delete modal)-->
                <div class="modal fade" id="deleteBackup" tabindex="-1" role="dialog" aria-labelledby="deleteBackup" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>Backup</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelBackup">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueBackupToDelete" name="valueBackupToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!--Backup (add modal)-->
        <div class="modal fade" id="addBackup" tabindex="-1" role="dialog" aria-labelledby="addBackup" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>Backup</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editBackup">
                        <div class="modal-body">
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeBackupAdd" name="typeBackupAdd" placeholder="Type">
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtBackupAdd" name="txtBackupAdd" placeholder="Description">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Backup (modify modal)-->
        <div class="modal fade" id="modifyBackup" tabindex="-1" role="dialog" aria-labelledby="modifyBackup" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>Backup</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editBackup">
                        <div class="modal-body">
                            <input type="text" id="valueBackupMod" name="valueBackupMod" hidden>

                            <h6 id="textModBackup">Aucun champ n'a été sélectionné</h6>
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeBackupMod" name="typeBackupMod" placeholder="Nouvelle valeur">
                            <input type="text" class="form-control float-left mb-1 w-100 responsiveDisplay" id="txtBackupMod" name="txtBackupMod" placeholder="Nouvelle valeur">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                        </div>

                            <script>
                                $("#valueBackupDel tr").click(function(){
                                    $(this).addClass('selected').siblings().removeClass('selected');
                                    var firstValue =$(this).find('td:first').html();
                                    var secondValue =$(this).find('td:last').html();
                                    document.getElementById("valueBackupDel").value = firstValue + " " + secondValue;
                                    document.getElementById("valueBackupToDelete").value = firstValue + " " + secondValue;
                                    $("#textDelBackup").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + firstValue + " " + secondValue + '<b/> ?');
                                    getSelectedBackupToDelete();getSelectedBackupToDisplayOnModify();
                                });

                                function getSelectedBackupToDelete()
                                {
                                    var elementToDelete = document.getElementById("valueBackupDel").value;
                                    return elementToDelete;
                                }

                                function getSelectedBackupToDisplayOnModify()
                                {
                                    var selectedValue = document.getElementById("valueBackupDel").value;
                                    var typeBackupMod = "";
                                    var txtBackupMod = "";

                                    for(var count = 0; count < selectedValue.length; count++)
                                    {
                                        if(selectedValue[count] !== " ")
                                        {
                                            typeBackupMod = typeBackupMod + selectedValue[count];
                                        }
                                        else
                                        {
                                            for(count += 1; count < selectedValue.length; count++)
                                            {
                                                txtBackupMod = txtBackupMod + selectedValue[count];
                                            }
                                            break;
                                        }
                                    }
                                    document.getElementById("valueBackupMod").value = selectedValue;
                                    document.getElementById("typeBackupMod").value = typeBackupMod;
                                    document.getElementById("txtBackupMod").value = txtBackupMod;
                                    $("#textModBackup").html('Modifier le champ <b>' + selectedValue + '</b> en :');
                                }
                            </script>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Backup-->
    <?php elseif($arrayToDisplay == "cluster") :?>
        <form method="post" action="../index.php?action=editCluster">
            <div class="form-group mt-2" name="formulaire" id="form_Cluster">
                <table id="valueClusterDel" name="valueClusterDel" class="w-100 table table-hover rounded">
                    <?php
                    foreach ($clusterInformation as $value) {
                        echo "<tr><td class='formManagement'>".$value[0]."</td><td class='formManagement'>".$value[1]."</td></tr>";
                    }
                    ?>
                </table>

                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addCluster">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifyCluster">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteCluster">Supprimer</button>
                </div>

                <!--Cluster (delete modal)-->
                <div class="modal fade" id="deleteCluster" tabindex="-1" role="dialog" aria-labelledby="deleteCluster" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>Cluster</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelCluster">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueClusterToDelete" name="valueClusterToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!--Cluster (add modal)-->
        <div class="modal fade" id="addCluster" tabindex="-1" role="dialog" aria-labelledby="addCluster" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>Cluster</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editCluster">
                        <div class="modal-body">
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeClusterAdd" name="typeClusterAdd" placeholder="Nom">
                            <select class="form-control float-left mb-2 w-100 responsiveDisplay" id="txtClusterAdd" name="txtClusterAdd">
                                <?php
                                foreach ($siteInformation as $site){
                                    echo'<option>'.$site['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Cluster (modify modal)-->
        <div class="modal fade" id="modifyCluster" tabindex="-1" role="dialog" aria-labelledby="modifyCluster" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>Cluster</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editCluster">
                        <div class="modal-body">
                            <input type="text" id="valueClusterMod" name="valueClusterMod" hidden>

                            <h6 id="textModCluster">Aucun champ n'a été sélectionné</h6>
                            <input type="text" class="form-control float-left mb-2 w-100 responsiveDisplay" id="typeClusterMod" name="typeClusterMod" placeholder="Nouvelle valeur">
                            <select class="form-control float-left mb-2 w-100 responsiveDisplay" id="txtClusterMod" name="txtClusterMod">
                                <?php
                                foreach ($siteInformation as $site){
                                    echo'<option>'.$site['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                        </div>

                        <script>
                            $("#valueClusterDel tr").click(function(){
                                $(this).addClass('selected').siblings().removeClass('selected');
                                var firstValue =$(this).find('td:first').html();
                                var secondValue =$(this).find('td:last').html();
                                document.getElementById("valueClusterDel").value = firstValue + " " + secondValue;
                                document.getElementById("valueClusterToDelete").value = firstValue + " " + secondValue;
                                $("#textDelCluster").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + firstValue + " " + secondValue + '<b/> ?');
                                getSelectedClusterToDelete();getSelectedClusterToDisplayOnModify();
                            });

                            function getSelectedClusterToDelete()
                            {
                                var elementToDelete = document.getElementById("valueClusterDel").value;
                                return elementToDelete;
                            }

                            function getSelectedClusterToDisplayOnModify()
                            {
                                var selectedValue = document.getElementById("valueClusterDel").value;
                                var typeClusterMod = "";
                                var txtClusterMod = "";

                                for(var count = 0; count < selectedValue.length; count++)
                                {
                                    if(selectedValue[count] !== " ")
                                    {
                                        typeClusterMod = typeClusterMod + selectedValue[count];
                                    }
                                    else
                                    {
                                        for(count += 1; count < selectedValue.length; count++)
                                        {
                                            txtClusterMod = txtClusterMod + selectedValue[count];
                                        }
                                        break;
                                    }
                                }
                                document.getElementById("valueClusterMod").value = selectedValue;
                                document.getElementById("typeClusterMod").value = typeClusterMod;
                                document.getElementById("txtClusterrMod").value = txtClusterMod;
                                $("#textModCluster").html('Modifier le champ <b>' + selectedValue + '</b> en :');
                            }
                        </script>

                </div>
                </form>
            </div>
        </div>
        </div>

    <?php elseif($arrayToDisplay == "site") :?>
        <form method="post" action="../index.php?action=editSite">
            <div class="form-group mt-2" name="formulaire" id="form_Site">
                <table id="valueSiteDel" name="valueSiteDel" class="w-100 table table-hover rounded">
                    <?php
                    foreach ($siteInformation as $value) {
                        echo "<tr><td class='formManagement'>".$value['name']."</td></tr>";
                    }
                    ?>
                </table>
                <div class="float-left w-33 responsiveDisplay pr-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#addSite">Ajouter</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pr-1 pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-primary w-100 mb-0" data-toggle="modal" data-target="#modifySite">Modifier</button>
                </div>
                <div class="float-left w-33 responsiveDisplay pl-1 mb-3" id="responsiveDisplay">
                    <button type="button" class="btn btn-danger w-100 mb-70-px" data-toggle="modal" data-target="#deleteSite">Supprimer</button>
                </div>

                <!--Site (delete modal)-->
                <div class="modal fade" id="deleteSite" tabindex="-1" role="dialog" aria-labelledby="deleteSite" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header modal-danger justify-content-center">
                                <h5>Supprimer <b>Site</b></h5>
                            </div>

                            <div class="modal-body">
                                <h6 id="textDelSite">Aucun champ n'a été sélectionné</h6>

                                <input type="text" id="valueSiteToDelete" name="valueSiteToDelete" hidden>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" value="delete" name="delete" id="delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--Site (add modal)-->
        <div class="modal fade" id="addSite" tabindex="-1" role="dialog" aria-labelledby="addSite" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-success justify-content-center">
                        <h5>Ajouter <b>Site</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editSite">
                        <div class="modal-body">
                            <input type="text" class="form-control responsiveDisplay" id="txtSiteAdd" name="txtSiteAdd" placeholder="Site">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mx-auto responsiveDisplay" value="add" name="add" id="add">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Site (modify modal)-->
        <div class="modal fade" id="modifySite" tabindex="-1" role="dialog" aria-labelledby="modifySite" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-primary justify-content-center">
                        <h5>Modifier <b>Entity</b></h5>
                    </div>

                    <form method="post" action="../index.php?action=editSite">
                        <div class="modal-body">
                            <input type="text" id="valueSiteMod" name="valueSiteMod" hidden>

                            <h6 id="textModSite" class="float-left">Aucun champ n'a été sélectionné</h6>
                            <input type="text" class="form-control responsiveDisplay" id="txtSiteMod" name="txtSiteMod" placeholder="Nouvelle valeur">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mx-auto responsiveDisplay" value="modify" name="modify" id="modify">Confirmer</button>
                        </div>

                        <script>
                            $("#valueSiteDel tr").click(function(){
                                $(this).addClass('selected').siblings().removeClass('selected');
                                var value=$(this).find('td:first').html();
                                document.getElementById("valueSiteDel").value = value;
                                document.getElementById("valueSiteToDelete").value = value;
                                getSelectedSiteToDisplayOnModify();getSelectedSiteToDisplayOnDelete();
                            });

                            function getSelectedSiteToDisplayOnDelete()
                            {
                                var selectedValue = document.getElementById("valueSiteDel").value;

                                $("#textDelSite").html('Êtes-vous sûr de vouloir supprimer le champ : <b>' + selectedValue + '<b/> ?');
                            }

                            function getSelectedSiteToDisplayOnModify()
                            {
                                var selectedValue = document.getElementById("valueSiteDel").value;
                                document.getElementById("valueSiteMod").value = selectedValue;
                                document.getElementById("txtSiteMod").value = selectedValue;
                                $("#textModSite").html('Changer le champ <b>' + selectedValue + '</b> en :');
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    <?php endif;?>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>