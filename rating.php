<?php
session_start();
include("components/connection.php");
include("components/function.php");
$userdata = check_login($con);

if (isset($_GET['rate']) && isset($_GET['hid'])) {
    $rate = $_GET['rate'];
    if ($rate > 5 || $rate < 1) {
        die("Thank you for Hacking!");
    }
    $id = $userdata['id'];
    $hid = $_GET['hid'];
    $sql = "INSERT INTO `rating` (`id`, `rate`,`hid`) VALUES ('$id', '$rate','$hid');";
    $result = mysqli_query($con, $sql);
}
if (isset($_GET['re']) && isset($_GET['rid'])) {
    $rate = $_GET['re'];
    if ($rate > 5 || $rate < 1) {
        die("Thank you for Hacking!");
    }
    $rid = $_GET['rid'];
    $query = "UPDATE `rating` SET
        rate = '$rate'
        WHERE rid = '$rid'
        ";
    mysqli_query($con, $query);
}
?>
<script>
    history.go(-1);
</script>