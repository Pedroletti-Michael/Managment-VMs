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
        <!------------- Choix ------------>
        <div class="w-50-m m-auto responsiveDisplay pt-2">
            <div class="w-100 d-inline-block">
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--All VM-->
                    <a href="index.php?action=allVM&vmFilter=all">
                        <button type="button" class="btn btn-primary w-100 responsiveButton">
                            <h6>Toutes les VM</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Confirmed VM-->
                    <a href="index.php?action=allVM&vmFilter=confirmed">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);">
                            <h6>VM confirmées</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--VM who need to be confirmed-->
                    <a href="index.php?action=allVM&vmFilter=confirmation">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);">
                            <h6>VM à confirmer</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--VM to renew-->
                    <a href="index.php?action=allVM&vmFilter=renewal">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(233,48,48,0.7); border-color: rgba(233,48,48,0.7);">
                            <h6>VM à renouveler</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Deleted VM-->
                    <a href="index.php?action=allVM&vmFilter=deleted">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(90,90,90,0.7); border-color: rgba(90,90,90,0.7);">
                            <h6>VM supprimées</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Row filter-->
                    <a>
                        <button type="button" class="btn btn-primary w-100 responsiveButton" data-toggle="modal" data-target="#modalRowFilter">
                            <h6>Trier les colonnes</h6>
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!--Row filter-->
        <div class="modal fade" id="modalRowFilter" tabindex="-1" role="dialog" aria-labelledby="modalRowFilter" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button id="name" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('name')">
                                <h5>name</h5>
                            </button>
                            <button id="dateStart" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dateStart')">
                                <h5>dateStart</h5>
                            </button>
                            <button id="dateEnd" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('dateEnd')">
                                <h5>dateEnd</h5>
                            </button>
                            <button id="desc" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('desc')">
                                <h5>description</h5>
                            </button>
                            <button id="usage" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('usage')">
                                <h5>usageType</h5>
                            </button>
                            <button id="cpu" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('cpu')">
                                <h5>cpu</h5>
                            </button>
                            <button id="ram" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('ram')">
                                <h5>ram</h5>
                            </button>
                            <button id="disk" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('disk')">
                                <h5>disk</h5>
                            </button>
                            <button id="network" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('network')">
                                <h5>network</h5>
                            </button>
                            <br><br>
                            <button id="" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('hideAll')">
                                <h5>tout enlever</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button id="domain" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('domain')">
                                <h5>domain</h5>
                            </button>
                            <button id="comment" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('comment')">
                                <h5>comment</h5>
                            </button>
                            <button id="customer" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('customer')">
                                <h5>customer</h5>
                            </button>
                            <button id="Ra" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('Ra')">
                                <h5>userRa</h5>
                            </button>
                            <button id="Rt" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('Rt')">
                                <h5>userRt</h5>
                            </button>
                            <button id="entity" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('entity')">
                                <h5>entity_id</h5>
                            </button>
                            <button id="os" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('os')">
                                <h5>os_id</h5>
                            </button>
                            <button id="snapshot" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('snapshot')">
                                <h5>snapshot_id</h5>
                            </button>
                            <button id="backup" type="button" class="btn btn-primary w-100 h-33" onclick="filterRow('backup')">
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

        <!--Snapshot Modal Window-->
        <div class="modal fade" id="modalSnapshot" tabindex="-1" role="dialog" aria-labelledby="modalSnapshot" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="w-100 p-3">
                        <div class="w-50 float-left p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Gold', 17)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Silver', 17)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Bronze', 17)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Aucun', 17)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 17)">
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
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Gold', 18)">
                                <h5>Gold</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Silver', 18)">
                                <h5>Silver</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Bronze', 18)">
                                <h5>Bronze</h5>
                            </button>
                        </div>
                        <div class="w-50 float-right p-1">
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('Aucun', 18)">
                                <h5>Aucun</h5>
                            </button>
                            <button type="button" class="btn btn-primary w-100 h-33" onclick="filterForInventoryVm('', 18)">
                                <h5>Tous</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="table-responsive-xl">
            <table class="table table-hover allVM" id="tableInventoryVm">
            <thead class="thead-dark sticky-top">
            <tr>
                <th name="goToButton" scope="col" style="width: 50px;"></th>
                <th name="name" scope="col" onclick="sortTable(1)">name</th>
                <th name="dateStart" scope="col" onclick="sortTable(2)">dateStart</th>
                <th name="dateEnd" scope="col" onclick="sortTable(3)">dateEnd</th>
                <th name="desc" scope="col" onclick="sortTable(4)">description</th>
                <th name="usage" scope="col" onclick="sortTable(5)">usageType</th>
                <th name="cpu" scope="col" onclick="sortNumberTable(6)">cpu</th>
                <th name="ram" scope="col" onclick="sortNumberTable(7)">ram</th>
                <th name="disk" scope="col" onclick="sortNumberTable(8)">disk</th>
                <th name="network" scope="col" onclick="sortTable(9)">network</th>
                <th name="domain" scope="col" onclick="sortTable(10)">domain</th>
                <th name="comment" scope="col" onclick="sortTable(11)">comment</th>
                <th name="customer" scope="col" onclick="sortTable(12)">customer</th>
                <th name="Ra" scope="col" onclick="sortTable(13)">userRa</th>
                <th name="Rt" scope="col" onclick="sortTable(14)">userRt</th>
                <th name="entity" scope="col" onclick="sortTable(15)">entity_id</th>
                <th name="os" scope="col" onclick="sortTable(16)">os_id</th>
                <th name="snapshot" scope="col" onclick="sortTable(17)">snapshot_id
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalSnapshot">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                </th>
                <th name="backup" scope="col" onclick="sortTable(18)">backup_id
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
                        <td name="dateStart" style="min-width: 100px"><?php echo $value['dateStart']?></td>
                        <td name="dateEnd" style="min-width: 100px"><?php echo $value['dateEnd']?></td>
                        <td name="desc" ><?php echo $value['description']?></td>
                        <td name="usage" ><?php echo $value['usageType']?></td>
                        <td name="cpu" ><?php echo $value['cpu']?></td>
                        <td name="ram" ><?php echo $value['ram']?></td>
                        <td name="disk" ><?php echo $value['disk']?></td>
                        <td name="network" ><?php echo $value['network']?></td>
                        <td name="domain" ><?php if($value['domain'] == 1){echo 'oui';}else{echo 'non';}?></td>
                        <td name="comment" ><?php echo $value['comment']?></td>
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