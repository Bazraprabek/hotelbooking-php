<?php
    session_start();
    include("../components/connection.php");
    include("../components/function.php");
    $userdata = check_manager($con);

    if(isset($_GET['bid'])){
        $bid = $_GET['bid'];
        $sql = "SELECT * FROM booking WHERE bid = '$bid'";
        $result = mysqli_query($con,$sql);
        $book = mysqli_fetch_array($result);
        $rid = $book['rid'];

        $checked_out = date("Y-m-d");
        $price = $book['amount']/$book['days'];

        $date1 = "2022-05-17";
        $date2 = $book['checked_in'];

        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $amount = $price*$days;

            $query = "UPDATE `booking` SET `checked_out` = '$checked_out',`days` = '$days',`amount` = '$amount' WHERE `booking`.`bid` = $bid; ";
            mysqli_query($con, $query);

            $query = "UPDATE `rooms` SET `status` = 'yes' WHERE `rooms`.`rid` = $rid;";
            mysqli_query($con, $query);
        
    }
    
    if(isset($_GET['did'])){
        $did = $_GET['did'];
        $sql = "SELECT * FROM booking WHERE bid = '$did'";
        $result = mysqli_query($con,$sql);
        $book = mysqli_fetch_array($result);
        $rid = $book['rid'];

            $query = "UPDATE `booking` SET `checked_out` = 'cancelled' WHERE `booking`.`bid` = $did; ";
            mysqli_query($con, $query);

            $query = "UPDATE `rooms` SET `status` = 'yes' WHERE `rooms`.`rid` = $rid;";
            mysqli_query($con, $query);
        
    }
    header('Location: hbooking.php');

?>