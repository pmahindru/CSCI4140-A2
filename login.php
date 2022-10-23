<?php
    session_start();

    // assing the base url
    include "database/db.php";
    include "BaseURL.php";

    // isset check for the null or not login
    if(isset($_POST['login'])){
        // get the client id from the form
        $clientID = $_POST['id'];

        // get all the values of the client
        $data = json_decode(file_get_contents(BASEURL . "ClientsAPI/readClient022.php"));

        $check = false;

        // loop through it
        for ($i=0; $i < sizeof((array) $data->Clients022); $i++) { 
            // client match then
            if ($clientID == $data->Clients022[$i]->clientID022) {
                // assign the $clientID
                $_SESSION['clientID'] = $clientID;

                // say the loginIN is true
                $_SESSION['loginIN'] = true;

                // say the loginIN is true
                $loginIN = true;

                // update the clientStatus022 make it Active
                $update_sql_status = "UPDATE Clients022 SET clientStatus022 = 'Active' WHERE  clientID022 = '$clientID' ";
                if ($conn->query($update_sql_status) === TRUE) {
                }
                $check = true;
                // go the index.php
                header('location: index.php');
                exit;
            }
            else
            {
                $check = false;
            }
        }

        // show that user put wrong client id
        if ($check !== TRUE) {
            echo '<script> alert("You Enter the wrong Client Id. Please Try Again :)"); </script>';
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
<?php
    // adding header
    include "head.php";
?>
<body>
    <!-- login title and the form -->
    <div class="login_page">
        <h2> Log In Page </h2>
        <br>
        <form method="post" class="style_form">
            <label>
                ENTER THE CLIENT ID
            </label>
            <br>
            <input type="number" size="100" name="id" value="id" placeholder="Please Enter Client ID" required />
            <br>
            <button type="submit" name="login" value="login">
                Log In
            </button>
        </form>
        <button class="createAccountButton" onclick="addClient()">
                Add New Client
        </button>
    </div>
    <hr>

    <?php
        
        $data = json_decode(file_get_contents(BASEURL . "ClientsAPI/readClient022.php"));
        for ($i=0; $i < sizeof((array) $data->Clients022); $i++) { 
    ?>

    <!-- table to show the all clients in the login page -->
    <div class="style_login_table">
        <br>
        <p>
            <?php
                    echo "ID: ". $data->Clients022[$i]->clientID022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "Name: ". $data->Clients022[$i]->clientName022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "City: " . $data->Clients022[$i]->clientCity022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "Pass: " . $data->Clients022[$i]->clientCompPassword022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "Dollar On Order: $" . $data->Clients022[$i]->dollarsOnOrder022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "Money Owed: $" . $data->Clients022[$i]->moneyOwed022;
                ?>
        </p>
        <br>
        <p>
            <?php
                    echo "Status: " . $data->Clients022[$i]->clientStatus022;
                ?>
        </p>
        <br>
    </div>
    <?php
        }
    ?>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>