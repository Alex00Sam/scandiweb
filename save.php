<?php
require "autoload.php";
if($_POST) {
    App::add($_POST);
}
header("Location: ./");


