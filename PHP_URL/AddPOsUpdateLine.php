<?php
include "../BaseURL.php";

// get the all the value from the jquery
$obj_array = json_encode($_POST["obj_array"]);
$clientID022 = $_POST["obj_array"][0]["clientID022"];
$status022 = "pending";
date_default_timezone_set('America/Halifax');
$dateOfPO022 = date('Y-m-d-H-i-s');

// insert in the POs 
echo json_encode(file_get_contents(BASEURL . "POsAPI/insertPOs022.php/?clientID022=$clientID022&dateOfPO022=$dateOfPO022&status022=$status022&obj_array=$obj_array"));
?>