<?php
    $isProd = true;

    if($isProd == false)
        include 'config_dev.php';
    else
        include 'config_prod.php';
?>