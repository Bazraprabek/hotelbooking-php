<?php
session_start();
include "components/connection.php";

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (!empty($_POST['user']) && !empty($_POST['pass'])) {
        $query = "SELECT * FROM `account` WHERE `username` = '$user'";
        $result = mysqli_query($con, $query);
        // check if username contain value 
        if ($result && mysqli_num_rows($result) > 0) {
            // store values in associative array
            $userdata = mysqli_fetch_assoc($result);

            if ($userdata['password'] === $pass) {
                if ($userdata['role'] === "admin") {
                    // redirect to login page
                    $_SESSION['siid'] = $userdata['id'];
                    header("Location: admin/index.php");
                    die;
                } else if ($userdata['role'] === "hmanager") {
                    // redirect to login page
                    $_SESSION['siid'] = $userdata['id'];
                    header("Location: hmanager/index.php");
                    die;
                } else {
                    // redirect to login page
                    $_SESSION['siid'] = $userdata['id'];
                    header("Location: index.php");
                    die;
                }
            } else {
                $_SESSION['message'] = "Invalid Password";
            }
        } else {
            $_SESSION['message'] = "Invalid Username";
        }
    } else {
        $_SESSION['message'] = "Please enter all input!";
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
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
</head>

<body>
    <div class="box">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="bbox" style="color:green">
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </div>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                    <td><input type="text" name="user" id="user"></td>
                </tr>
                <tr>
                    <td><label for="pass">Password</label></td>
                    <td><input type="password" name="pass" id="pass"></td>
                </tr>
            </table>
            <div class="bbox">
                <button name="login" type="submit">Login</button>
            </div>
            <span>New User? <a href="signup.php">Signup</a></span><br><br>
            <span>Join as Hotel Manager? <a href="hsignup.php">Manager</a></span>
        </form>
    </div>
</body>

</html>