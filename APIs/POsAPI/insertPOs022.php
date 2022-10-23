<?php
include "../../database/db.php";
include "../../class/POs022.php";

//adding header as application/json
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

// add the db connection to the POs constructor
$POs = new POs022($conn);

//get the all fields from the link and add to the class
$POs->clientID022 = isset($_GET['clientID022']) ? $_GET['clientID022'] : die;
$POs->dateOfPO022 = isset($_GET['dateOfPO022']) ? $_GET['dateOfPO022'] : die;
$POs->status022 = isset($_GET['status022']) ? $_GET['status022'] : die;
$POs->obj_array = isset($_GET['obj_array']) ? $_GET['obj_array'] : die;

// add the POS to the table
if ($POs->addToPOs022()) 
{
    echo "POs is created";
}
?>