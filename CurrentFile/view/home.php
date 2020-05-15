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
                            <h6 class="float-left pt-2 text-center">Votre commande à bel et bien été effectuée</h6>
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
            <div class="modal-dialog m-auto w-470-px"  role="document" style="top: 45%;">
                <div class="modal-content w-100">
                    <div class="modal-body">
                        <div class="w-100">
                            <h6 class="float-left pt-2 text-center">Un ou plusieurs mails de confirmation de votre commande ne sont pas partit. Veuillez contactez un administrateur.</h6>
                            <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">Fermer</button>
                        </div>
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

    <table class="table table-hover allVM" id="tableInventoryUser">
        <thead class="thead-dark sticky-top">
        <tr>
            <th scope="col"></th>
            <th scope="col" onclick="sortTable(1, 1)">name</th>
            <th scope="col" onclick="sortTable(2, 1)">dateStart</th>
            <th scope="col" onclick="sortTable(3, 1)">dateEnd</th>
            <th scope="col" onclick="sortTable(4, 1)">description</th>
            <th scope="col" onclick="sortTable(5, 1)">usageType</th>
            <th scope="col" onclick="sortNumberTable(6, 1)">cpu</th>
            <th scope="col" onclick="sortNumberTable(7, 1)">ram</th>
            <th scope="col" onclick="sortNumberTable(8, 1)">disk</th>
            <th scope="col" onclick="sortTable(9, 1)">network</th>
            <th scope="col" onclick="sortTable(10, 1)">domain</th>
            <th scope="col" onclick="sortTable(11, 1)">comment</th>
            <th scope="col" onclick="sortTable(12, 1)">customer</th>
            <th scope="col" onclick="sortTable(13, 1)">userRa</th>
            <th scope="col" onclick="sortTable(14, 1)">userRt</th>
            <th scope="col" onclick="sortTable(15, 1)">entity_id</th>
            <th scope="col" onclick="sortTable(16, 1)">os_id</th>
            <th scope="col" onclick="sortTable(17, 1)">snapshot_id</th>
            <th scope="col" onclick="sortTable(18, 1)">backup_id</th>
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
