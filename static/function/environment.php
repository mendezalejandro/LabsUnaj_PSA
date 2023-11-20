<?php
    $isProd = true;

    if($isProd)
        include 'config_prod.php';
    else
        include 'config_dev.php';
?>