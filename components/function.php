<?php
function check_login($con)
{
    if (isset($_SESSION['siid'])) {

        $id = $_SESSION['siid'];
        $query = "select * from account where id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $userdata = mysqli_fetch_assoc($result);
            return $userdata;
        }
    } else {

        //redirect to login
        header("Location: login.php");
    }
}

function check_manager($con)
{
    if (isset($_SESSION['siid'])) {
        $id = $_SESSION['siid'];
        $query = "select * from account where id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            if ($userdata['role'] === "hmanager") {
                return $userdata;
            } else {
                //redirect to login
                header("Location: ../login.php");
            }
        }
    } else {
        header("Location: ../login.php");
    }
}

function check_admin($con)
{
    if (isset($_SESSION['siid'])) {
        $id = $_SESSION['siid'];
        $query = "select * from account where id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            if ($userdata['role'] === "admin") {
                return $userdata;
            } else {
                //redirect to login
                header("Location: ../login.php");
            }
        }
    } else {
        header("Location: ../login.php");
    }
}
