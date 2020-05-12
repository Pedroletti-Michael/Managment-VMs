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
        <script rel="javascript" src="../view/js/searchBox.js"></script>
        <meta charset="UTF-8">
        <title>Gestion VM - HEIG-VD</title>
    </head>
    <body>
    <form method="post" action="../index.php?action=allVM">
        <!------------- Btn Filtrer ------------>
        <button type="button" class="btn btn-primary rounded-0 w-150-px position-fixed mt-1 " style="right: 0.25rem;" onclick="openRightMenu()">
            Filtrer &nbsp;
            <svg class="bi bi-filter-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14 10.5a.5.5 0 00-.5-.5h-3a.5.5 0 000 1h3a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-7a.5.5 0 000 1h7a.5.5 0 00.5-.5zm0-3a.5.5 0 00-.5-.5h-11a.5.5 0 000 1h11a.5.5 0 00.5-.5z" clip-rule="evenodd"/>
            </svg>
        </button>
        <!------------- Sidebar Options ------------>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
            <button  type="button" onclick="closeRightMenu()" class="w-100 btn btn-danger rounded-0">Fermer</button>
            <!------------- Filter VM ------------>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle w-100 rounded-0" type="button" data-toggle="collapse" data-target="#collapseVM" aria-expanded="false" aria-controls="collapseExample">
                    Trier VM
                </button>
                <div class="collapse" id="collapseVM">
                    <div class="w-100">
                        <!--All VM-->
                        <a href="index.php?action=allVM&vmFilter=all">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0">
                                Toutes les VM &nbsp;<span class="badge badge-primary">24</span>
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--Confirmed VM-->
                        <a href="index.php?action=allVM&vmFilter=confirmed">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0" >
                                VM confirmées &nbsp;<span class="badge" style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);">13</span>
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--VM who need to be confirmed-->
                        <a href="index.php?action=allVM&vmFilter=confirmation">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0">
                                VM à confirmer &nbsp;<span class="badge" style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);">7</span>
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--VM to renew-->
                        <a href="index.php?action=allVM&vmFilter=renewal">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0">
                                VM à renouveler &nbsp;<span class="badge" style="background-color: rgba(233,48,48,0.7); border-color: rgba(233,48,48,0.7);">1</span>
                            </button>
                        </a>
                    </div>
                    <div class="w-100">
                        <!--Deleted VM-->
                        <a href="index.php?action=allVM&vmFilter=deleted">
                            <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0">
                                VM supprimées &nbsp;<span class="badge" style="background-color: rgba(90,90,90,0.7); border-color: rgba(90,90,90,0.7);">3</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <!------------- Filter fields ------------>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle w-100 rounded-0" type="button" data-toggle="collapse" data-target="#collapseFields" aria-expanded="false" aria-controls="collapseExample">
                    Trier champs
                </button>
                <div class="collapse" id="collapseFields">
                    <button name="btnRowFilter" id="name" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('name')">
                        name
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="cluster" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('cluster')">
                        cluster
                    </button>
                    <button name="btnRowFilter" id="dateStart" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('dateStart')">
                        dateStart
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dateAnniversary" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('dateAnniversary')">
                        dateAnniversary
                    </button>
                    <button name="btnRowFilter" id="dateEnd" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('dateEnd')">
                        dateEnd
                    </button>
                    <button name="btnRowFilter" id="desc" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('desc')">
                        description
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="ip" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('ip')">
                        ip
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="dnsName" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('dnsName')">
                        dnsName
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="redundance" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('redundance')">
                        redundance
                    </button>
                    <button name="btnRowFilter" id="usage" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('usage')">
                        usageType
                    </button>
                    <button name="btnRowFilter" style="background-color: #dc3545" id="criticity" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('criticity')">
                        criticity
                    </button>
                    <button name="btnRowFilter" id="cpu" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('cpu')">
                        cpu
                    </button>
                    <button name="btnRowFilter" id="ram" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('ram')">
                        ram
                    </button>
                    <button name="btnRowFilter" id="disk" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('disk')">
                        disk
                    </button>
                    <button name="btnRowFilter" id="network" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('network')">
                        network
                    </button>
                    <button name="btnRowFilter" id="domain" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('domain')">
                        domain
                    </button>
                    <button name="btnRowFilter" id="comment" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('comment')">
                        comment
                    </button>
                    <button name="btnRowFilter" id="customer" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('customer')">
                        customer
                    </button>
                    <button name="btnRowFilter" id="Ra" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('Ra')">
                        userRa
                    </button>
                    <button name="btnRowFilter" id="Rt" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('Rt')">
                        userRt
                    </button>
                    <button name="btnRowFilter" id="entity" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('entity')">
                        entity_id
                    </button>
                    <button name="btnRowFilter" id="os" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('os')">
                        os_id
                    </button>
                    <button name="btnRowFilter" id="snapshot" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('snapshot')">
                        snapshot_id
                    </button>
                    <button name="btnRowFilter" id="backup" type="button" class="btn btn-primary w-100 rounded-0 mb-0 border-0" onclick="filterRow('backup')">
                        backup_id
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0" onclick="filterRow('displayAll')">
                        tout afficher
                    </button>
                    <button id="" type="button" class="btn btn-secondary w-100 rounded-0 mb-0 border-0" onclick="filterRow('hideAll')">
                        tout enlever
                    </button>
                </div>
            </div>
            <!--Export VM to Excel-->
            <a href="index.php?action=exportToExcel">
                <button type="button" class="btn btn-success w-100 rounded-0 mb-0">
                    Exporter sur Excel
                </button>
            </a>
        </div>

        <!--Row filter-->
        <!--
        <div class="modal fade" id="modalRowFilter" tabindex="-1" role="dialog" aria-labelledby="modalRowFilter" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button name="btnRowFilter" id="name" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('name')">
                                <h5>name</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="cluster" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('cluster')">
                                <h5>cluster</h5>
                            </button>
                            <button name="btnRowFilter" id="dateStart" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dateStart')">
                                <h5>dateStart</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="dateAnniversary" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dateAnniversary')">
                                <h5>dateAnniversary</h5>
                            </button>
                            <button name="btnRowFilter" id="dateEnd" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dateEnd')">
                                <h5>dateEnd</h5>
                            </button>
                            <button name="btnRowFilter" id="desc" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('desc')">
                                <h5>description</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="ip" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('ip')">
                                <h5>ip</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="dnsName" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dnsName')">
                                <h5>dnsName</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="redundance" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('redundance')">
                                <h5>redundance</h5>
                            </button>
                            <button name="btnRowFilter" id="usage" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('usage')">
                                <h5>usageType</h5>
                            </button>
                            <button name="btnRowFilter" style="background-color: #dc3545" id="criticity" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('criticity')">
                                <h5>criticity</h5>
                            </button>
                            <button name="btnRowFilter" id="cpu" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('cpu')">
                                <h5>cpu</h5>
                            </button>
                            <br><br>
                            <button id="" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('hideAll')">
                                <h5>tout enlever</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button name="btnRowFilter" id="ram" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('ram')">
                                <h5>ram</h5>
                            </button>
                            <button name="btnRowFilter" id="disk" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('disk')">
                                <h5>disk</h5>
                            </button>
                            <button name="btnRowFilter" id="network" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('network')">
                                <h5>network</h5>
                            </button>
                            <button name="btnRowFilter" id="domain" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('domain')">
                                <h5>domain</h5>
                            </button>
                            <button name="btnRowFilter" id="comment" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('comment')">
                                <h5>comment</h5>
                            </button>
                            <button name="btnRowFilter" id="customer" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('customer')">
                                <h5>customer</h5>
                            </button>
                            <button name="btnRowFilter" id="Ra" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('Ra')">
                                <h5>userRa</h5>
                            </button>
                            <button name="btnRowFilter" id="Rt" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('Rt')">
                                <h5>userRt</h5>
                            </button>
                            <button name="btnRowFilter" id="entity" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('entity')">
                                <h5>entity_id</h5>
                            </button>
                            <button name="btnRowFilter" id="os" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('os')">
                                <h5>os_id</h5>
                            </button>
                            <button name="btnRowFilter" id="snapshot" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('snapshot')">
                                <h5>snapshot_id</h5>
                            </button>
                            <button name="btnRowFilter" id="backup" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('backup')">
                                <h5>backup_id</h5>
                            </button>
                            <br><br>
                            <button id="" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('displayAll')">
                                <h5>tout afficher</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <!--Snapshot Modal Window-->
        <div class="modal fade" id="modalSnapshot" tabindex="-1" role="dialog" aria-labelledby="modalSnapshot" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Gold', 23)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Silver', 23)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Bronze', 23)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Aucun', 23)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 23)">
                                <h5>Tous</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Backup Modal Window-->
        <div class="modal fade" id="modalBackup" tabindex="-1" role="dialog" aria-labelledby="modalBackup" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Gold', 24)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Silver', 24)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Bronze', 24)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Aucun', 24)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 24)">
                                <h5>Tous</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="height: 47px"> </div>
        <div class="table-responsive-xl">
            <table class="table table-hover allVM" id="tableInventoryVm">
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="width: 50px;"></th>
                <th name="name" scope="col" onclick="sortTable(1)">name</th>
                <th style="display: none" name="cluster" scope="col" onclick="sortTable(2)">cluster</th>
                <th name="dateStart" scope="col" onclick="sortTable(4)">dateStart</th>
                <th style="display: none" name="dateAnniversary" scope="col" onclick="sortTable(6)">dateAnniversary</th>
                <th name="dateEnd" scope="col" onclick="sortTable(8)">dateEnd</th>
                <th name="desc" scope="col" onclick="sortTable(9)">description</th>
                <th style="display: none" name="ip" scope="col" onclick="sortTable(10)">ip</th>
                <th style="display: none" name="dnsName" scope="col" onclick="sortTable(11)">dnsName</th>
                <th style="display: none" name="redundance" scope="col" onclick="sortTable(12)">redundance</th>
                <th name="usage" scope="col" onclick="sortTable(13)">usageType</th>
                <th style="display: none" name="criticity" scope="col" onclick="sortTable(14)">criticity</th>
                <th name="cpu" scope="col" onclick="sortNumberTable(15)">cpu</th>
                <th name="ram" scope="col" onclick="sortNumberTable(16)">ram</th>
                <th name="disk" scope="col" onclick="sortNumberTable(17)">disk</th>
                <th name="network" scope="col" onclick="sortTable(18)">network</th>
                <th name="domain" scope="col" onclick="sortTable(19)">domain</th>
                <th name="comment" scope="col" onclick="sortTable(20)">comment</th>
                <th name="customer" scope="col" onclick="sortTable(21)">customer</th>
                <th name="Ra" scope="col" onclick="sortTable(22)">userRa</th>
                <th name="Rt" scope="col" onclick="sortTable(23)">userRt</th>
                <th name="entity" scope="col" onclick="sortTable(24)">entity_id</th>
                <th name="os" scope="col" onclick="sortTable(25)">os_id</th>
                <th name="snapshot" scope="col" onclick="sortTable(26)">snapshot_id
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalSnapshot">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                </th>
                <th name="backup" scope="col" onclick="sortTable(27)">backup_id
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalBackup">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($allVM as $value): ?>
                    <tr>
                        <td name="goToButton">
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
                        <td style="display: none" name="redundance"><?php echo $value['redundance']?></td>
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
    </form>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>