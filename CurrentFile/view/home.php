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
    <meta charset="UTF-8">
    <title>Mes VM - HEIG-VD</title>
</head>
<body>
<div class="table-responsive-xl">

    <!--Confirmation command VM modal)-->
    <?php if(isset($_SESSION['$displayModalConfirm']) && $_SESSION['$displayModalConfirm'] == true) : ?>
        <div class="modal fade" id="confirmationCommandVM" tabindex="-1" role="dialog" aria-labelledby="confirmationCommandVM" aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px"  role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Un e-mail de confirmation a été envoyé à vous et au responsable technique de la VM</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
    <?php endif; ?>
    <!--Modal send mail failed-->
    <?php if(isset($_SESSION['displayModalConfirmationFailed']) && $_SESSION['displayModalConfirmationFailed']) : ?>
        <div class="modal fade" id="confirmationMailFailed" tabindex="-1" role="dialog" aria-labelledby="confirmationMailFailed" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header modal-danger justify-content-center">
                        <h5>Échec envoi e-mail</h5>
                    </div>

                    <div class="modal-body">
                        <h6 id="textDelEntity">L’e-mail de confirmation n’a pas été envoyé. Contactez le <a href="mailto:helpdesk@heig-vd.ch?subject=Demande de VM : Erreur lors de la confirmation">helpdesk</a>.</h6>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger mx-auto responsiveDisplay" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
    <?php
        unset($_SESSION['displayModalConfirmationFailed']);
        endif;
    ?>
    <!--Modal request failed-->
    <?php if(isset($_SESSION['displayModalRequestFailed']) && $_SESSION['displayModalRequestFailed']) : ?>
        <div class="modal fade" id="requestFailed" tabindex="-1" role="dialog" aria-labelledby="requestFailed" aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px"  role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Nous rencontrons actuellement un problème. Nous ne pouvons donc prendre en compte votre commande. Veuillez réessayer plus tard.</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
        <?php
        unset($_SESSION['displayModalRequestFailed']);
    endif;
    ?>
    <form method="post" action="../index.php?action=home">
        <!------------- Btn Filtrer ------------>
        <button type="button" class="btn btn-primary rounded-0 w-150-px position-fixed mt-1" style="right: 0.25rem;" onclick="openRightMenu()">
            Filtrer &nbsp;
            <svg class="bi bi-filter-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14 10.5a.5.5 0 00-.5-.5h-3a.5.5 0 000 1h3a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-7a.5.5 0 000 1h7a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-11a.5.5 0 000 1h11a.5.5 0 00.5-.5z" clip-rule="evenodd"/>
            </svg>
        </button>
        <!------------- Sidebar Options ------------>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
            <button  type="button" onclick="closeRightMenu()" class="w-100 btn btn-danger rounded-0 text-left">Fermer</button>
            <!------------- Filter VM ------------>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle w-100 rounded-0 text-left" type="button" data-toggle="collapse" data-target="#collapseVM" aria-expanded="false" aria-controls="collapseExample">
                    Filtrer VM
                </button>
                <div class="collapse" id="collapseVM">
                    <div class="w-100">
                        <!--All VM-->
                        <a href="index.php?action=allVM&vmFilter=all">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                                <span class="badge badge-primary">24</span>
                                Toutes mes VM
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--Confirmed VM-->
                        <a href="index.php?action=home&vmFilter=administratif">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" >
                                <span class="badge" style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);">13</span>
                                Responsable administratif
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--VM who need to be confirmed-->
                        <a href="index.php?action=home&vmFilter=technique">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left">
                                <span class="badge" style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);">7</span>
                                Responsable technique
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <!------------- Filter fields ------------>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle w-100 rounded-0 text-left" type="button" data-toggle="collapse" data-target="#collapseFields" aria-expanded="false" aria-controls="collapseExample">
                    Filtrer champs
                </button>
                <div class="collapse" id="collapseFields">
                    <button name="btnRowFilter" id="name" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('name')">
                        name
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="cluster" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('cluster')">
                        cluster
                    </button>
                    <button name="btnRowFilter" id="dateStart" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dateStart')">
                        dateStart
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dateAnniversary" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dateAnniversary')">
                        dateAnniversary
                    </button>
                    <button name="btnRowFilter" id="dateEnd" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dateEnd')">
                        dateEnd
                    </button>
                    <button name="btnRowFilter" id="desc" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('desc')">
                        description
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="ip" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('ip')">
                        ip
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dnsName" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('dnsName')">
                        dnsName
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="redundance" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('redundance')">
                        redundance
                    </button>
                    <button name="btnRowFilter" id="usage" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('usage')">
                        usageType
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="criticity" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('criticity')">
                        criticity
                    </button>
                    <button name="btnRowFilter" id="cpu" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('cpu')">
                        cpu
                    </button>
                    <button name="btnRowFilter" id="ram" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('ram')">
                        ram
                    </button>
                    <button name="btnRowFilter" id="disk" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('disk')">
                        disk
                    </button>
                    <button name="btnRowFilter" id="network" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('network')">
                        network
                    </button>
                    <button name="btnRowFilter" id="domain" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('domain')">
                        domain
                    </button>
                    <button name="btnRowFilter" id="comment" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('comment')">
                        comment
                    </button>
                    <button name="btnRowFilter" id="customer" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('customer')">
                        customer
                    </button>
                    <button name="btnRowFilter" id="Ra" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('Ra')">
                        userRa
                    </button>
                    <button name="btnRowFilter" id="Rt" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('Rt')">
                        userRt
                    </button>
                    <button name="btnRowFilter" id="entity" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('entity')">
                        entity_id
                    </button>
                    <button name="btnRowFilter" id="os" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('os')">
                        os_id
                    </button>
                    <button name="btnRowFilter" id="snapshot" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('snapshot')">
                        snapshot_id
                    </button>
                    <button name="btnRowFilter" id="backup" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('backup')">
                        backup_id
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('displayAll')">
                        tout afficher
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0 text-left" onclick="filterRow('hideAll')">
                        tout enlever
                    </button>
                </div>
            </div>
        </div>
        <div style="height: 47px"> </div>
    <table class="table table-hover allVM" id="tableInventoryUser">
        <thead class="thead-dark sticky-top">
        <tr>
            <th name="goToButton" scope="col" style="width: 50px;" onclick="sortTablePlus(0, 1)">Statut</th>
            <th name="name" scope="col" onclick="sortTable(1, 1)">name</th>
            <th style="display: none" name="cluster" scope="col" onclick="sortTable(2, 1)">cluster</th>
            <th name="dateStart" scope="col" onclick="sortTable(4, 1)">dateStart</th>
            <th style="display: none" name="dateAnniversary" scope="col" onclick="sortTable(6, 1)">dateAnniversary</th>
            <th name="dateEnd" scope="col" onclick="sortTable(8, 1)">dateEnd</th>
            <th name="desc" scope="col" onclick="sortTable(9, 1)">description</th>
            <th style="display: none" name="ip" scope="col" onclick="sortTable(10, 1)">ip</th>
            <th style="display: none" name="dnsName" scope="col" onclick="sortTable(11, 1)">dnsName</th>
            <th style="display: none" name="redundance" scope="col" onclick="sortTable(12, 1)">redundance</th>
            <th name="usage" scope="col" onclick="sortTable(13, 1)">usageType</th>
            <th style="display: none" name="criticity" scope="col" onclick="sortTable(14, 1)">criticity</th>
            <th name="cpu" scope="col" onclick="sortNumberTable(15, 1)">cpu</th>
            <th name="ram" scope="col" onclick="sortNumberTable(16, 1)">ram</th>
            <th name="disk" scope="col" onclick="sortNumberTable(17, 1)">disk</th>
            <th name="network" scope="col" onclick="sortTable(18, 1)">network</th>
            <th name="domain" scope="col" onclick="sortTable(19, 1)">domain</th>
            <th name="comment" scope="col" onclick="sortTable(20, 1)">comment</th>
            <th name="customer" scope="col" onclick="sortTable(21, 1)">customer</th>
            <th name="Ra" scope="col" onclick="sortTable(22, 1)">userRa</th>
            <th name="Rt" scope="col" onclick="sortTable(23, 1)">userRt</th>
            <th name="entity" scope="col" onclick="sortTable(24, 1)">entity_id</th>
            <th name="os" scope="col" onclick="sortTable(25, 1)">os_id</th>
            <th name="snapshot" scope="col" onclick="sortTable(26, 1)">snapshot_id
                <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalSnapshot">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                </svg>
            </th>
            <th name="backup" scope="col" onclick="sortTable(27, 1)">backup_id
                <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalBackup">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                </svg>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userVM as $value): ?>
            <tr>
                <td name="goToButton" id="<?= $value['vmStatus']; ?>">
                    <div class="btn-group" role="group">
                        <a href="index.php?action=detailsVM&id=<?php echo $value['id']?>"><button type="button" class="btn btn-primary" style="background-color: rgba(<?php if($value['vmStatus']==2){echo '40,167,69,0.7';}elseif ($value['vmStatus']==0){echo '255,165,69,0.7';}elseif ($value['vmStatus']==3){echo '233,48,48,0.7';}else{echo '90,90,90,0.7';}?>); border-color: rgba(<?php if($value['vmStatus']==2){echo '40,167,69,0.7';}elseif ($value['vmStatus']==0){echo '255,165,69,0.7';}elseif ($value['vmStatus']==3){echo '233,48,48,0.7';}else{echo '90,90,90,0.7';}?>);"><strong>+</strong></button></a>
                    </div>
                </td>
                <td name="name"><?php echo $value['name']?></td>
                <td style="display: none" name="cluster"><?php echo $value['cluster']?></td>
                <td name="dateStart" style="min-width: 100px"><?php echo date("d.m.Y", strtotime($value['dateStart']))?></td>
                <td hidden name="strDateStart"><?= strtotime($value['dateStart']); ?></td>
                <td style="display: none" name="dateAnniversary"><?php if($value['dateAnniversary'] == null || $value['dateAnniversary'] == 'null'){echo '';}else{echo date("d.m.Y", strtotime($value['dateAnniversary']));}?></td>
                <td hidden name="strDateAnniversary"><?= strtotime($value['dateAnniversary']); ?></td>
                <td name="dateEnd" style="min-width: 100px"><?php if($value['dateEnd'] == null || $value['dateEnd'] == 'null'){echo '';}else{echo date("d.m.Y", strtotime($value['dateEnd']));}?></td>
                <td hidden name="strDateEnd"><?= strtotime($value['dateEnd']); ?></td>
                <td name="desc" ><?php if(strlen($value['description']) > 9){echo substr($value['description'],0,10)."...";}else{echo substr($value['description'],0,10);} ?></td>
                <td style="display: none" name="ip"><?php echo $value['ip']?></td>
                <td style="display: none" name="dnsName"><?php echo $value['dnsName']?></td>
                <td style="display: none" name="redundance"><?php

                    //Verification for display name of the vm for redundance and not to display there ID
                    if($value['redundance'] != null || $value['redundance'] != 'null' || $value['redundance'] != ' '){
                        if(strstr($value['redundance'], '0') || strstr($value['redundance'], '1') || strstr($value['redundance'], '2') || strstr($value['redundance'], '3') || strstr($value['redundance'], '4') || strstr($value['redundance'], '5') || strstr($value['redundance'], '6') || strstr($value['redundance'], '7') || strstr($value['redundance'], '8') || strstr($value['redundance'], '9')){
                            foreach(explode(";", $value['redundance']) as $redundanceVal){
                                foreach($allVmName as $vmName){
                                    if($redundanceVal == $vmName['id']){
                                        echo $vmName['name']. '; ';
                                    }
                                }
                            }
                        }
                        else{
                            echo $value['redundance'];
                        }

                    }

                    ?></td>
                <td name="usage" ><?php echo $value['usageType']?></td>
                <td style="display: none" name="criticity"><?php echo $value['criticity']?></td>
                <td name="cpu" ><?php echo $value['cpu']?></td>
                <td name="ram" ><?php echo $value['ram']?></td>
                <td name="disk" ><?php echo $value['disk']?></td>
                <td name="network" ><?php echo $value['network']?></td>
                <td name="domain" ><?php if($value['domain'] == 1){echo 'oui';}else{echo 'non';}?></td>
                <td name="comment" ><?php if(strlen($value['comment']) > 9){echo substr($value['comment'], 0, 10)."...";}else{echo substr($value['comment'], 0, 10);} ?></td>
                <td name="customer" ><?php echo $value['customer']?></td>
                <td name="Ra" ><?php echo $value['userRa']?></td>
                <td name="Rt" ><?php echo $value['userRt']?></td>
                <td name="entity" ><?php echo $value['entity_id']?></td>
                <td name="os" style="min-width: 100px"><?php echo $value['os_id']['1']." ".$value['os_id'][0]?></td>
                <td name="snapshot" style="min-width: 130px"><?php echo $value['snapshot_id']['1']?></td>
                <td name="backup" style="min-width: 120px"><?php echo $value['backup_id']['1']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
