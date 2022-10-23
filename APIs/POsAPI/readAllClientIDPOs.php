<?php
include "../../database/db.php";
include "../../class/POs022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the POs constructor
$POs = new POs022($conn);

// get the client Id from the link and assign to the client POs class
$POs->clientID022 = isset($_GET['clientID022']) ? $_GET['clientID022'] : die;

// get all POS with respect the client ID from the class
$getPos = $POs->getAllWithClientIDPOs022();

// https://www.geeksforgeeks.org/how-to-avoid-undefined-offset-error-in-php/
if (isset($getPos->POs022[0]))
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    http_response_code(200);
    echo json_encode($getPos, JSON_PRETTY_PRINT);
}
?>