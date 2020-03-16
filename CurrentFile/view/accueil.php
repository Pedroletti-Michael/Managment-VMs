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
    <div>
    </div>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>