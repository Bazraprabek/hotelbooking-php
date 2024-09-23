<?php
session_start();
include("../components/connection.php");
    // restore previous loaction
    $location = $_GET["location"];

    // check from admin account
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            // delete
            $sql = "DELETE FROM account WHERE id=$id";

            //  display msg if the delete process done
            if (mysqli_query($con, $sql)) {
                $_SESSION['delete'] = "Deleted Successfully.";
                header('Location:' . $location);
            } else {
                $_SESSION['cerror'] = "Error deleting record: " . mysqli_error($con);
            }
        }

        // check from admin hotels
        if (isset($_GET["hid"])) {
            $hid = $_GET["hid"];
            $hotel_img = $_GET['hotel_img'];
            // delete
            $sql = "DELETE FROM hotels WHERE hid=$hid";
    
            //  display msg if the delete process done
            if (mysqli_query($con, $sql)) {
                unlink('../hmanager/upload/categories/'.$hotel_img);
                $_SESSION['delete'] = "Deleted Successfully.";
                header('Location:' . $location);
            } else {
                $_SESSION['cerror'] = "Error deleting record: " . mysqli_error($con);
            }
        }

        // check from hotel categories
        if (isset($_GET["cid"])) {
            $cid = $_GET["cid"];
            $cimg = $_GET["cimg"];
            // delete
            $sql = "DELETE FROM categories WHERE cid=$cid";
    
            //  display msg if the delete process done
            if (mysqli_query($con, $sql)) {
                unlink('../hmanager/upload/categories/'.$cimg);
                header('Location:' . $location);
            }
        }

        // check from hotel rooms
        if (isset($_GET["rid"])) {
            $rid = $_GET["rid"];
            // delete
            $sql = "DELETE FROM rooms WHERE rid=$rid";
    
            //  display msg if the delete process done
            if (mysqli_query($con, $sql)) {
                header('Location:' . $location);
            }
        }

        // check from hotel booking
        if (isset($_GET["bid"])) {
            $bid = $_GET["bid"];
            // delete
            $sql = "DELETE FROM booking WHERE bid=$bid";
    
            //  display msg if the delete process done
            if (mysqli_query($con, $sql)) {
                header('Location:' . $location);
            }
        }
        

?>