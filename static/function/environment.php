<?php
    $isProd = true;

    if($isProd)
        include 'config_dev.php';
    else
        include 'config_prod.php';
?>