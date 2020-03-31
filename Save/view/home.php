<?php

/**
 * Authors : Théo Cook
 * CreationFile date : 17.03.2020
 * ModifFile date : 31.03.2020
 **/

ob_start();

?>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
