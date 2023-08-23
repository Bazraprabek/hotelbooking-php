<?php
    session_start();
    include("../components/connection.php");
    include("../components/function.php");
    $userdata = check_manager($con);

//check is submit post button press or not
if (isset($_POST['update'])) {
    //something was posted
    $manager = $userdata['username'];
    $hotel_name = $_POST['hotel_name'];
    $hotel_img = $_POST['hotel_img'];
    $current_img = $_POST['current_img'];
    $hotel_desc = $_POST['hotel_desc'];
    $hotel_address = $_POST['hotel_address'];

    // update image
    if (isset($_FILES['hotel_img']['name'])) {

        $hotel_img = $_FILES['hotel_img']['name'];

        // check image is avilable or not
        if ($hotel_img !== "") {
            // auto rename our image
            // get the extension of our image (jpg,png)
            $tmp = explode('.', $hotel_img);
            $fileExtension = end($tmp);

            // rename the image
            $hotel_img = "hotel" . rand(0, 9999999) . '.' . $fileExtension;

            $sourcepath = $_FILES['hotel_img']['tmp_name'];
            $destination = "upload/" . $hotel_img;

            // Upload image
            $upload = move_uploaded_file($sourcepath, $destination);

            if ($upload == true) {
                unlink('upload/'.$current_img);
            }
            if ($upload == false) {
                $_SESSION['msg'] = "Failed to upload image!";    
                // redirect to login page
                header("Location: hprofile.php");
                die;
            }
        } else {
            $hotel_img = $current_img;
        }
    } else {
        $hotel_img = $current_img;
    }

    // check if username and user is numerical
    if (!empty($hotel_name) && !empty($hotel_desc) && !empty($hotel_address)) {
        // check if username already exist
        $sql = "SELECT * FROM `hotels` WHERE `hotel_name` = '$hotel_name'";
        $checkSQL = mysqli_query($con, $sql);

        $sql = "SELECT * FROM `hotels` WHERE `manager` = '$manager'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($query);
        $current_name = $row['hotel_name'];

        // check if username contain value
        if (mysqli_num_rows($checkSQL) != 0 && $hotel_name != $current_name) {
            $_SESSION['msg'] = 'Hotel name already exists!';
        } else {

            //save to database
            $query = "UPDATE `hotels` SET
            hotel_name = '$hotel_name',
            hotel_img = '$hotel_img',
            hotel_desc = '$hotel_desc',
            hotel_address = '$hotel_address'
            WHERE manager='$manager'
            ";
            mysqli_query($con, $query);

            $_SESSION['msg'] = 'Update successful!';

            // redirect to login page
            header("Location: hprofile.php");
            die;
        }
    } else {
        $_SESSION['msg'] = 'Please fill all input!';
    }
}
        // // redirect to login page
        header("Location: hprofile.php");
        die;

?>