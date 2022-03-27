<?php
require "autoload.php";
if($_POST) {
    App::add($_POST);  //sends the whole form post data directly into corresponding classes
}
header("Location: ./");


