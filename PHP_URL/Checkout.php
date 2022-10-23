<?php

include "../BaseURL.php";

// get all the value information to display cart and store in array
$clientID = $_POST["clientID"];
$data_userSelectPart = json_decode(file_get_contents(BASEURL . "UserSelectPartsAPI/readUserSelectPart022.php/?clientID022=$clientID"));
$data_parts = json_decode(file_get_contents(BASEURL . "PartsAPI/readPart022.php"));

// new array which have all information
$all_fields_for_checkout = array();
// loop to store count and all other value information
for ($i=0; $i < sizeof((array) $data_parts->Parts022); $i++) { 
    $count = 0;
    for ($j = 0; $j < sizeof((array) $data_userSelectPart->user_select_parts022); $j++) { 
        if ($data_userSelectPart->user_select_parts022[$j]->partNo022 == $data_parts->Parts022[$i]->partNo022) {
            $count++;
        }
    }
    if ($count !== 0) {
        $json_object = new stdClass();
        $json_object->clientID022 = $clientID;
        $json_object->partNo022 = $data_parts->Parts022[$i]->partNo022;
        $json_object->currentPrice022 = $data_parts->Parts022[$i]->currentPrice022;
        $json_object->user_select_count022 = $count;
        $all_fields_for_checkout[] = $json_object;
    }
}

$html_text = '';
$total_cost = 0;

// loop to get this html text so that i can show then all part  with information and also total price with it 
for ($i=0; $i < sizeof((array) $all_fields_for_checkout); $i++) { 
    $partNo022 = $all_fields_for_checkout[$i]->partNo022;
    $part_with_id = json_decode(file_get_contents(BASEURL . "PartsAPI/readSinglePart022.php/?partNo022=$partNo022"));
    $total_cost += ($all_fields_for_checkout[$i]->user_select_count022*$part_with_id->Parts022[0]->currentPrice022);
    $html_text .=
    '
    <div class="card_checkout">
        <div class="checkout_button">
            <p>
                <button onclick="add('. $part_with_id->Parts022[0]->partNo022 .','. $part_with_id->Parts022[0]->QoH022 .','. $clientID .','. $all_fields_for_checkout[$i]->user_select_count022 .')">
                    ADD
                </button>
            </p>
        </div>
        <div class="checkout_img">
            <img src="img/'.$part_with_id->Parts022[0]->partImgs022.'" alt="img" width="80%" height="150px"/>
        </div>
        <div class="checkout_text">
            <h1>'.$part_with_id->Parts022[0]->partName022.'</h1>
            <p>'.$part_with_id->Parts022[0]->partDescription022.'</p>
            <p>'.$all_fields_for_checkout[$i]->user_select_count022 . ' * ' . $part_with_id->Parts022[0]->currentPrice022 . ' => $' . ($all_fields_for_checkout[$i]->user_select_count022*$part_with_id->Parts022[0]->currentPrice022) .'</p>
        </div>
        <div class="checkout_button">
            <p> 
                <button onclick="sub('. $part_with_id->Parts022[0]->partNo022 .','. $part_with_id->Parts022[0]->QoH022 .','. $clientID .','. $all_fields_for_checkout[$i]->user_select_count022 .')">
                    SUB
                </button> 
            </p>
        </div>
    </div>
    ';
}
// add the total_cost in the end so that before user click checkout they will total price
$html_text .= '<p class="checkout_total_price"> Total Cost = $'. $total_cost  .' </p>';

// make an object and assign html text and the array
$send_data = new stdClass();
$send_data->html_text = $html_text;
$send_data->checkout_array = $all_fields_for_checkout;

// encode and echo the object to access in the js function which is checkout
echo json_encode($send_data);
?>