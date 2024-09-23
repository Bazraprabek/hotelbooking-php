<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include("aheader.php");

    if (isset($_GET["id"])) {

        // store id from link
        $id = $_GET["id"];

        // selecting row match to id
        $result = mysqli_query($con, "SELECT * FROM account WHERE id =$id");

        // storing all the value in array into $row
        $row = mysqli_fetch_array($result);
        $user = $row['username'];
        $pass = $row['password'];
        $email = $row['email'];
    }else{
        header("Location: account.php");
        die;
    }

    //check is submit post button press or not
    if (isset($_POST['update'])) {
        //something was posted
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $role = $row['role'];

        // check if username and user is numerical
        if (!is_numeric($user) && !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['email'])) {
            // check if username already exist
            $sql = "SELECT * FROM `account` WHERE `username` = '$user'";
            $checkSQL = mysqli_query($con, $sql);

            // check if username contain value
            if (mysqli_num_rows($checkSQL) != 0 && $user !== $row['username']) {
                $_SESSION['msg'] = 'Username already exists!';
            } else {

                //save to database
                $query = "UPDATE `account` SET
                username = '$user',
                password = '$pass',
                email = '$email',
                role = '$role'
                WHERE id='$id'
                ";
                mysqli_query($con, $query);

                $_SESSION['msg'] = 'Update successful';

                // redirect to login page
                header("Location: account.php");
                die;
            }
        } else {
            $_SESSION['msg'] = 'Please enter valid username or user!';
        }
    }

    ?>

    <div class="account container">
        <h1>Edit</h1>
            <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
            ?>
        <form action="" method="post">
        <table>
            <tr>
                <td><label for="user">Username</label></td>
                <td><input type="text" name="user" id="user" value="<?php echo $user; ?>"></td>
            </tr>
            <tr>
                <td><label for="pass">Password</label></td>
                <td><input type="password" name="pass" id="pass" value="<?php echo $pass; ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" id="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><button name="update" type="submit">Update</button></td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>