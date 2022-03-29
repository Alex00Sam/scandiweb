<?php
    require 'autoload.php';
    echo App::isUnique("sku",$_REQUEST['q']);
