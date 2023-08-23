<?php

require_once("components/connection.php");
require_once("components/function.php");
require_once("recommend.php");
require_once("sample_list.php");

$userdata = check_login($con);
$username = $userdata['username'];
// print_r($books);

$re = new Recommend();
$array = $re->getRecommendations($hotels, $username);
$recommend_list = array_slice($array, 0, 3);

// print_r($recommend_list);