<?php
    // connection with the db server
    $db_server_name = "db.cs.dal.ca";
    $db_name = "mahindru";
    $db_user_name = "mahindru";
    $db_password = "TXDbJ8F55GrGpTpwrctcjhtPE";

    $conn = mysqli_connect($db_server_name,$db_user_name,$db_password,$db_name);

    if ($conn->connect_error) 
    {
        die("Connection failed! " . mysqli_connect_error());
    }

    mysqli_select_db($conn, $db_name) or die("Unable to select from the Database " . mysqli_error($conn));
?>