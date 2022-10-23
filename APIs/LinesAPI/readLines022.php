<?php
include "../../database/db.php";
include "../../class/Lines022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the Line constructor
$Lines = new Lines022($conn);

// get the POs NO from the link and assign in the Line022 class 
$Lines->POsNo022 = isset($_GET['POsNo022']) ? $_GET['POsNo022'] : die;

// get all Line with respect the POsID from the class
$getLines = $Lines->getWithPOsIDLines022();

// https://www.geeksforgeeks.org/how-to-avoid-undefined-offset-error-in-php/
if (isset($getLines->Lines022[0]))
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    http_response_code(200);
    echo json_encode($getLines, JSON_PRETTY_PRINT);
}
?>