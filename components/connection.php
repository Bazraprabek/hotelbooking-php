<?php 
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "hotel_booking";

    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
        die("Connection Error");
    }