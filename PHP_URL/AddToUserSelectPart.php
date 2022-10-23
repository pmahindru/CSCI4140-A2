<?php
include "../BaseURL.php";

$part_id = $_POST["part_id"];
$part_quantity = $_POST["part_quantity"];
$clientID = $_POST["clientID"];
$count = $_POST["count"];

// part quantity is more than or equal to 1 
if ($part_quantity >= 1) 
{
    // add the user table so that we will know what part they want and also which user wants
    echo json_encode(file_get_contents(BASEURL . "UserSelectPartsAPI/insertUserSelectParts022.php/?clientID022=$clientID&partNo022=$part_id&partQoh022=$part_quantity&user_count=$count"));
}
else
{
    echo "Parts Reached Quantity";
}
?>