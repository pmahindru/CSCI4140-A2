<?php
include "../../database/db.php";
include "../../class/Parts022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the parts constructor 
$part = new Parts022($conn);

// get all parts from the class
$getParts = $part->getAllParts022();

// size of the response is more than 0 then echo the get all parts
if (sizeof((array) $getParts) > 0)
{
    echo json_encode($getParts, JSON_PRETTY_PRINT);
}
?>