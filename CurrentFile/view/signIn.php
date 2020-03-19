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
      <form method="POST" action="..\index?action=RequestLogin" >
        <input type="text" name="login">
        <input type="password" name="password">
        <input type="submit">
      </form>
    </div>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
