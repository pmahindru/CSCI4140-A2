<?php
    session_start();

    // for the database
    include "database/db.php";

    //get the client id
    $clientID = $_SESSION['clientID'];

    // update that the client is not active
    $update_sql_status = "UPDATE Clients022 SET clientStatus022 = 'InActive' WHERE  clientID022 = '$clientID' ";

    if ($conn->query($update_sql_status) === TRUE) {
        // empty array 
        $_SESSION = array();

        // destroy session
        session_destroy();
        header('location: login.php');
        exit;
    }
?>