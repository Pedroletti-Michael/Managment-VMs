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
        <div class="form-group">
            <label for="disFormControlSelect" class="font-weight-bold text-center w-100 pt-3">Filtrer les VM</label>
            <div class="w-25 m-auto">
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
        <div class="table-responsive-xl">
            <table class="table table-striped allVM">
            <thead class="thead-dark sticky-top">
            <tr>
                <th scope="col" style="width: 50px"></th>
                <th scope="col">name</th>
                <th scope="col">dateStart</th>
                <th scope="col">dateEnd</th>
                <th scope="col">description</th>
                <th scope="col">usageType</th>
                <th scope="col">cpu</th>
                <th scope="col">ram</th>
                <th scope="col">disk</th>
                <th scope="col">network</th>
                <th scope="col">domain</th>
                <th scope="col">comment</th>
                <th scope="col">customer</th>
                <th scope="col">userRa</th>
                <th scope="col">userRt</th>
                <th scope="col">entity_id</th>
                <th scope="col">os_id</th>
                <th scope="col">snapshot_id</th>
                <th scope="col">backup_id</th>
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
                        <td><?php echo $value['domain']?></td>
                        <td><?php echo $value['comment']?></td>
                        <td><?php echo $value['customer']?></td>
                        <td><?php echo $value['userRa']?></td>
                        <td><?php echo $value['userRt']?></td>
                        <td><?php echo $value['entity_id']?></td>
                        <td style="min-width: 100px"><?php echo $value['os_id']['1']." ".$value['os_id']['0']?></td>
                        <td style="min-width: 250px"><?php echo $value['snapshot_id']['1']." : ".$value['snapshot_id']['0']?></td>
                        <td style="min-width: 250px"><?php echo $value['backup_id']['1']." : ".$value['backup_id']['0']?></td>
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