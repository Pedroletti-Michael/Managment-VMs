<?php
/**
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
    <h3 class="text-center border border-danger border-left-0 border-right-0 border-top-0 pb-3 pt-3">
        Gestion des VM
    </h3>
<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>