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
    <?php $_SESSION['$displayModalConfirm'] = true; if(isset($_SESSION['$displayModalConfirm']) && $_SESSION['$displayModalConfirm'] == true) : ?>
        <div class="modal fade" id="confirmationCommandVM" tabindex="-1" role="dialog" aria-labelledby="confirmationCommandVM" aria-hidden="true">
            <div class="modal-dialog m-auto w-470-px"  role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Votre commande à bel et bien été effectuée</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>$('.modal').modal('show')</script>
    <?php endif; ?>

    <table class="table table-hover allVM">
        <thead class="thead-dark sticky-top">
        <tr>
            <th scope="col"></th>
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
        <?php foreach ($userVM as $value): ?>
            <tr>
                <td>
                    <div class="btn-group" role="group">
                        <a href="index.php?action=detailsVM&id=<?php echo $value['id']?>"><button type="button" class="btn btn-primary"><strong>+</strong></button></a>
                    </div>
                </td>
                <td><?php echo $value['name']?></td>
                <td style="min-width: 100px"><?php echo $value['dateStart']?></td>
                <td style="min-width: 100px"><?php echo $value['dateEnd']?></td>
                <td><?php if(strlen($value['description']) > 9){echo substr($value['description'],0,10)."...";}else{echo substr($value['description'],0,10);} ?></td>
                <td><?php echo $value['usageType']?></td>
                <td><?php echo $value['cpu']?></td>
                <td><?php echo $value['ram']?></td>
                <td><?php echo $value['disk']?></td>
                <td><?php echo $value['network']?></td>
                <td><?php echo $value['domain']?></td>
                <td><?php if(strlen($value['comment']) > 9){echo substr($value['comment'], 0, 10)."...";}else{echo substr($value['comment'], 0, 10);} ?></td>
                <td><?php echo $value['customer']?></td>
                <td><?php echo $value['userRa']?></td>
                <td><?php echo $value['userRt']?></td>
                <td><?php echo $value['entity_id']?></td>
                <td style="min-width: 150px"><?php echo $value['os_id']['1']." ".$value['os_id']['0']?></td>
                <td style="min-width: 250px"><?php echo $value['snapshot_id']['1']." : ".$value['snapshot_id']['0']?></td>
                <td style="min-width: 250px"><?php echo $value['backup_id']['1']." : ".$value['backup_id']['0']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
