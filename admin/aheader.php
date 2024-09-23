<?php
session_start();
include("../components/connection.php");
include("../components/function.php");
$userdata = check_admin($con);
?>
<nav>
    <h2><a href="index.php"><img src="../img/favicon.ico" alt="logo"> Admin Dashboard</a></h2>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="request.php">Request</a></li>
        <li><a href="ahotel.php">Hotels</a></li>
        <li><a style="color:grey;" href="../components/logout.php" onclick="return confirm('Are you sure want to logout?')">Logout</a></li>
    </ul>
</nav>