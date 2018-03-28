<?php
    $file = file_get_contents('printRules.json');
    header('Content-Type: application/json');
    echo $file;
?>
