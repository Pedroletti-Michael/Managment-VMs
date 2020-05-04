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
        <title>Gestion VM - HEIG-VD</title>
    </head>
    <body>
    <form method="post" action="../index.php?action=allVM">
        <!------------- Choix ------------>
        <div class="w-50-m m-auto responsiveDisplay pt-2">
            <div class="w-100 d-inline-block">
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Snapshot-->
                    <a href="index.php?action=allVM&vmFilter=all">
                        <button type="button" class="btn btn-primary w-100 responsiveButton">
                            <h6>Toutes les VM</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Backup-->
                    <a href="index.php?action=allVM&vmFilter=confirmed">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(40,167,69,0.7); border-color: rgba(40,167,69,0.7);">
                            <h6>VM confirmées</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Snapshot-->
                    <a href="index.php?action=allVM&vmFilter=confirmation">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(255,165,69,0.7); border-color: rgba(255,165,69,0.7);">
                            <h6>VM à confirmer</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Backup-->
                    <a href="index.php?action=allVM&vmFilter=renewal">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(233,48,48,0.7); border-color: rgba(233,48,48,0.7);">
                            <h6>VM à renouveler</h6>
                        </button>
                    </a>
                </div>
                <div class="w-20 float-left p-1" style="height: 50px">
                    <!--Backup-->
                    <a href="index.php?action=allVM&vmFilter=deleted">
                        <button type="button" class="btn btn-primary w-100 responsiveButton" style="background-color: rgba(90,90,90,0.7); border-color: rgba(90,90,90,0.7);">
                            <h6>VM supprimées</h6>
                        </button>
                    </a>
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
                <th scope="col" style="width: 50px;"></th>
                <th scope="col" onclick="sortTable(1)">name</th>
                <th scope="col" onclick="sortTable(2)">dateStart</th>
                <th scope="col" onclick="sortTable(3)">dateEnd</th>
                <th scope="col" onclick="sortTable(4)">description</th>
                <th scope="col" onclick="sortTable(5)">usageType</th>
                <th scope="col" onclick="sortNumberTable(6)">cpu</th>
                <th scope="col" onclick="sortNumberTable(7)">ram</th>
                <th scope="col" onclick="sortNumberTable(8)">disk</th>
                <th scope="col" onclick="sortTable(9)">network</th>
                <th scope="col" onclick="sortTable(10)">domain</th>
                <th scope="col" onclick="sortTable(11)">comment</th>
                <th scope="col" onclick="sortTable(12)">customer</th>
                <th scope="col" onclick="sortTable(13)">userRa</th>
                <th scope="col" onclick="sortTable(14)">userRt</th>
                <th scope="col" onclick="sortTable(15)">entity_id</th>
                <th scope="col" onclick="sortTable(16)">os_id</th>
                <th scope="col" onclick="sortTable(17)">snapshot_id
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalSnapshot">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                </th>
                <th scope="col" onclick="sortTable(18)">backup_id
                    <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal" data-target="#modalBackup">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($allVM as $value): ?>
                    <tr>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="index.php?action=detailsVM&id=<?php echo $value['id']?>"><button type="button" class="btn btn-primary" style="background-color: rgba(<?php if($value['vmStatus']==2){echo '40,167,69,0.7';}elseif ($value['vmStatus']==0){echo '255,165,69,0.7';}elseif ($value['vmStatus']==3){echo '233,48,48,0.7';}else{echo '90,90,90,0.7';}?>); border-color: rgba(<?php if($value['vmStatus']==2){echo '40,167,69,0.7';}elseif ($value['vmStatus']==0){echo '255,165,69,0.7';}elseif ($value['vmStatus']==3){echo '233,48,48,0.7';}else{echo '90,90,90,0.7';}?>);"><strong>+</strong></button></a>
                            </div>
                        </td>
                        <td><?php echo $value['name']?></td>
                        <td style="min-width: 100px"><?php echo $value['dateStart']?></td>
                        <td style="min-width: 100px"><?php echo $value['dateEnd']?></td>
                        <td><?php echo $value['description']?></td>
                        <td><?php echo $value['usageType']?></td>
                        <td><?php echo $value['cpu']?></td>
                        <td><?php echo $value['ram']?></td>
                        <td><?php echo $value['disk']?></td>
                        <td><?php echo $value['network']?></td>
                        <td><?php if($value['domain'] == 1){echo 'oui';}else{echo 'non';}?></td>
                        <td><?php echo $value['comment']?></td>
                        <td><?php echo $value['customer']?></td>
                        <td><?php echo $value['userRa']?></td>
                        <td><?php echo $value['userRt']?></td>
                        <td><?php echo $value['entity_id']?></td>
                        <td style="min-width: 100px"><?php echo $value['os_id']['1']." ".$value['os_id'][0]?></td>
                        <td style="min-width: 130px"><?php echo $value['snapshot_id']['1']?></td>
                        <td style="min-width: 120px"><?php echo $value['backup_id']['1']?></td>
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