<?php

include("components/connection.php");

// $books =  array(

//     "user" => array("aa" => 2.5, "bb" => 3.5, "4" => 3.5),

//     "sameer" => array("aa" => 2.5, "bb" => 2.5, "cc" => 1, "dd" => 3.5)

// );

// $query = "SELECT * FROM `account` WHERE `role` ='user'";
// $result = mysqli_query($con, $query);
// while($row = mysqli_fetch_array($result)){

//     $id = $row['id'];
//     $username = $row['username'];

//     $query = "SELECT * FROM `rating` WHERE `id` = '7'";
//     $result = mysqli_query($con, $query);
//     while($rating = mysqli_fetch_array($result)){
//         $hid = $rating['hid'];
//         $rate = $rating['rate'];
//         $a = array_column($rating,'hid');
//         $b = array_column($rating,'rate');
//         // $data[$username] = array("$hid" => $rating['rate']);
//         // array_push($data,$data[$username]);
//         $c=array_combine($a,$b);
//     }
// }

$user = "SELECT * FROM `account` WHERE `role` ='user'";
$user_result = $con->query($user);
if ($user_result->num_rows > 0) {
    while ($user_row = $user_result->fetch_assoc()) {
        $username = $user_row['username'];
        $id = $user_row['id'];
        $rating = "SELECT * FROM rating WHERE id = '$id'";
        $rating_result = $con->query($rating);
        if ($rating_result->num_rows > 0) {
            while ($rating_row = $rating_result->fetch_assoc()) {
                $hid = $rating_row['hid'];
                $hotel = "SELECT * FROM hotels WHERE hid = '$hid'";
                $hotel_result = $con->query($hotel);
                if ($hotel_result->num_rows > 0) {
                    while ($hotel_row = $hotel_result->fetch_assoc()) {
                        $r = $hotel_row["hotel_name"];
                        $datasets[$username][$r] = $rating_row['rate'];
                    }
                }
            }
        }
    }
}

$hotels = $datasets;
