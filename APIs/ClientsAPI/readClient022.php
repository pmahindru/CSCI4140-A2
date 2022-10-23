<?php
include "../../database/db.php";
include "../../class/Clients022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the client class constructor
$client = new Clients022($conn);

// get all clients from the class from the given function
$getClients = $client->getAllClients022();

// if size is more than 0 then print other wise there are no clients in db
if (sizeof((array) $getClients) > 0)
{
    echo json_encode($getClients, JSON_PRETTY_PRINT);
}
?>