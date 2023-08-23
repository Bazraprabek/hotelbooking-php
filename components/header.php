<?php
session_start();
include("components/connection.php");
include("components/function.php");
$userdata = check_login($con);
?>
<nav>
    <div class="header">
        <h3><a href="index.php"><img src="img/favicon.ico" alt=""> Nepa Hotel Booking</a></h3>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="hotel.php">Hotels</a></li>
            <li><a style="color:grey;" href="components/logout.php" onclick="return confirm('Are you sure want to logout?')">Logout</a></li>
        </ul>
        <p style="color: green; font-weight:bolder; padding: 0px 5px;"><i class="fa-solid fa-user"></i> <?php echo ucwords($userdata['username']); ?></p>
        <button><b><i class="fa-solid fa-bars"></i></b></button>
    </div>
</nav>