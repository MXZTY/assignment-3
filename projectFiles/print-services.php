<?php
    //present all of the print frules jason array to be used by any page that calls this php service. Adapted from in class example
    $file = file_get_contents('printRules.json');
    header('Content-Type: application/json');
    echo $file;
?>
