<?php
include "../../database/db.php";
include "../../class/Clients022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the client class constructor
$client = new Clients022($conn);

//get the client id from the link and assign to the $client->clientID022 in the class
$client->clientID022 =  isset($_GET['clientID022']) ? $_GET['clientID022'] : die;

// get single clients from the client class
$getClients = $client->getSingleClient022();

// https://www.geeksforgeeks.org/how-to-avoid-undefined-offset-error-in-php/
if (isset($getClients->Clients022[0]))
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    http_response_code(200);
    echo json_encode($getClients, JSON_PRETTY_PRINT);
}
?>