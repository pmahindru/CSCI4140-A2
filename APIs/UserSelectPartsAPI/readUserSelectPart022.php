<?php
include "../../database/db.php";
include "../../class/User_select_parts022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the User_select_parts construct
$user_select_Parts = new user_select_parts022($conn);

// get the client Id from the link and assign to the clientID user_select_parts022 class
$user_select_Parts->clientID022 = isset($_GET['clientID022']) ? $_GET['clientID022'] : die;

// get single parts from the class
$getUserSelectParts = $user_select_Parts->getUserSelectPart022();

if (sizeof((array) $getUserSelectParts) > 0)
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    http_response_code(200);
    echo json_encode($getUserSelectParts, JSON_PRETTY_PRINT);
}
?>