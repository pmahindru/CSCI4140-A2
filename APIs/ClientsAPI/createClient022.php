<?php
include "../../database/db.php";
include "../../class/Clients022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the client class constructor
$client = new Clients022($conn);

//get all fields from the link and add to the class
$client->clientName022 =  isset($_GET['clientName022']) ? $_GET['clientName022'] : die;
$client->clientCity022 =  isset($_GET['clientCity022']) ? $_GET['clientCity022'] : die;
$client->clientCompPassword022 =  isset($_GET['clientCompPassword022']) ? $_GET['clientCompPassword022'] : die;
$client->dollarsOnOrder022 =  isset($_GET['dollarsOnOrder022']) ? $_GET['dollarsOnOrder022'] : die;
$client->moneyOwed022 =  isset($_GET['moneyOwed022']) ? $_GET['moneyOwed022'] : die;
$client->clientStatus022 =  isset($_GET['clientStatus022']) ? $_GET['clientStatus022'] : die;

// call the client class and call this add funciton to add in the db
if ($client->addToClient022()) {
    echo "Client is Created";
}
?>