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
        <meta charset="UTF-8">
        <title>Gestion VM - HEIG-VD</title>
    </head>
    <body>
    <form method="post" action="../index.php?action=allVM">
        <!------------- Choix ------------>
        <div class="form-group p-2">
            <label for="disFormControlSelect" class="font-weight-bold text-center w-100 pt-3">Filtrer les VM</label>
            <div class="w-25 m-auto" id="responsiveDisplay">
                <div class="btn-group w-100 m-auto">
                    <select class="form-control w-75 float-left" id="vmFilter" name="vmFilter" required>
                        <?php
                        $filterName = array("Toutes les vm", "VM confirmées","VM à confirmer","VM à renouveler");
                        for($i = 0; $i<4; $i++){
                            if($checkFilter == $filterName[$i]){
                                echo "<option selected>".$filterName[$i]."</option>";}
                            else{
                                echo "<option>".$filterName[$i]."</option>";
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success">Trier</button>
                </div>
            </div>
        </div>
        <!--Snapshot-->
        <button type="button" class="btn btn-primary w-25 h-25" onclick="filterForInventoryVm('Gold')">
            <h5>Snapshot - Gold</h5>
        </button>
        <button type="button" class="btn btn-primary w-25 h-25" onclick="filterForInventoryVm('Silver')">
            <h5>Snapshot - Silver</h5>
        </button>
        <button type="button" class="btn btn-primary w-25 h-25" onclick="filterForInventoryVm('Bronze')">
            <h5>Snapshot - Bronze</h5>
        </button>
        <button type="button" class="btn btn-primary w-25 h-25" onclick="filterForInventoryVm('Aucun')">
            <h5>Snapshot - Aucun</h5>
        </button>

        <div class="table-responsive-xl">
            <table class="table table-striped allVM" id="tableInventoryVm">
            <thead class="thead-dark sticky-top">
            <tr>
                <th scope="col" style="width: 50px"></th>
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
                <th scope="col" onclick="sortTable(17)">snapshot_id</th>
                <th scope="col" onclick="sortTable(18)">backup_id</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($allVM as $value): ?>
                    <tr>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="index.php?action=detailsVM&id=<?php echo $value['id']?>"><button type="button" class="btn btn-warning"><strong>+</strong></button></a>
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
                        <td style="min-width: 250px"><?php echo $value['snapshot_id']['1']." : ".$value['snapshot_id'][0]?></td>
                        <td style="min-width: 250px"><?php echo $value['backup_id']['1']." : ".$value['backup_id'][0]?></td>
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