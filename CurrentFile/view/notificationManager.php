<?php
/**
 * Authors : Michael Pedroletti
 * CreationFile date : 08.05.2020
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
    <div class="table-responsive-xl">
        <table class="table table-hover allVM" id="tableInventoryUser" >
            <thead class="thead-dark sticky-top">
            <tr>,
                <th name="status" scope="col">Notifications</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allNotif as $notif): ?>
                <tr>
                    <td name="notif"><?= $notif; ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>