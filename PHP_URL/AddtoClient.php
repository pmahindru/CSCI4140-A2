<?php
include "../BaseURL.php";

$name = $_POST["name"];
$city = $_POST["city"];
$pass = $_POST["pass"];
$dollaronorder = $_POST["dollaronorder"];
$moneyowed = "0.00";
$status = "InActive";

// insert in the client sql
echo json_encode(file_get_contents(BASEURL . "ClientsAPI/createClient022.php/?clientName022=$name&clientCity022=$city&clientCompPassword022=$pass&dollarsOnOrder022=$dollaronorder&moneyOwed022=$moneyowed&clientStatus022=$status"));

?>