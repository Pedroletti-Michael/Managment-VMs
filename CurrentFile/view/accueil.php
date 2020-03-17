<?php

/**
 **/

ob_start();

?>

    <div>
    </div>

<?php

$contenu = ob_get_clean();
require "gabarit.php";

?>
