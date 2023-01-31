<?php


    session_start();

    define('SITEURL','http://localhost/mero_bhansa/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    $con=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME) or die(mysqli_error()) or die();
?>