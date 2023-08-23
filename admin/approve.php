<?php
session_start();
include("../components/connection.php");

// restore previous loaction
$location = $_GET["location"];

// Execute if shop id exist
if (isset($_GET["hid"])) {
    $hid = $_GET["hid"];

    // upaate status value from no to yes
    $query = "UPDATE `hotels` SET
        active = 'yes'
        WHERE hid='$hid'
        ";

    //  display msg if the delivered process done or else display error message
    if (mysqli_query($con, $query)) {
        // $_SESSION['approve'] = "Approved Successfully.";
        header('Location:' . $location);
    } else {
        $_SESSION['smsg'] = "Error : " . mysqli_error($con);
    }
}
?>