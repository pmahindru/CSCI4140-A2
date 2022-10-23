<?php
include "../../database/db.php";
include "../../class/User_select_parts022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the user_select_parts constructor
$user_select_Parts = new user_select_parts022($conn);

//get the all fields from the link and add to the class
$user_select_Parts->clientID022 = isset($_GET['clientID022']) ? $_GET['clientID022'] : die;
$user_select_Parts->partNo022 = isset($_GET['partNo022']) ? $_GET['partNo022'] : die;
$user_select_Parts->partQoh022 = isset($_GET['partQoh022']) ? $_GET['partQoh022'] : die;
$user_select_Parts->user_count = isset($_GET['user_count']) ? $_GET['user_count'] : die;


if ($user_select_Parts->addUserSelectParts022()) 
{
    echo "Parts is Updated";
}
?>