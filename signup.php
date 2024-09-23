<?php
session_start();
include "components/connection.php";

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

if (isset($_POST['signup'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    if (!empty($_POST['user']) && !empty($_POST['pass'])) {
        // check if username already exist
        $query = "SELECT * FROM `account` WHERE `username` = '$user'";
        $checkSQL = mysqli_query($con, $query);

        // check if username contain value
        if (mysqli_num_rows($checkSQL) != 0) {
            $_SESSION['msg'] = 'Username already exists!';
        } else {
            $sql = "INSERT INTO `account` (`username`, `password`,`email`, `role`) VALUES ('$user', '$pass','$email', 'user');";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['id'] = $userdata['id'];
                header("Location: login.php");
                die;
            }
        }
    } else {
        $_SESSION['msg'] = "Please enter all input!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nepa Hotel Booking</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="box">
        <form action="" method="post">
            <h1>Signup</h1>
            <div class="bbox" style="color:green">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                    <td><input type="text" name="user" id="user"></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="email"></td>
                </tr>
                <tr>
                    <td><label for="pass">Password</label></td>
                    <td><input type="password" name="pass" id="pass"></td>
                </tr>
            </table>
            <div class="bbox">
                <button name="signup" type="submit">Signup</button>
            </div>
            <span>Already have account? <a href="login.php">Login</a></span>
        </form>
    </div>
</body>

</html>