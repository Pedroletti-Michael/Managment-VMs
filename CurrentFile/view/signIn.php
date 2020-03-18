<?php

/**
 **/

ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign In- HEIG-VD</title>
    </head>
    <body>
    <div class="container-fluid pt-3">
    </div>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
