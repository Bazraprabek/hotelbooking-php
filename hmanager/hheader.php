<?php
session_start();
include("../components/connection.php");
include("../components/function.php");
$userdata = check_manager($con);
?>
<nav>
  <a href="index.php" style="font-weight: bold"><img src="../img/favicon.ico" alt="logo"> Nepa Hotel Booking</a>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="hbooking.php">Booking</a></li>
    <li><a href="hroom.php">Rooms</a></li>
    <li><a href="hcategories.php">Categories</a></li>
    <li><a href="hprofile.php">Profile</a></li>
    <li><a style="color:grey;" href="../components/logout.php" onclick="return confirm('Are you sure want to logout?')">Logout</a></li>
  </ul>
</nav>