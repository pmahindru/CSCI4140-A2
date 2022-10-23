<main>
    <?php
    // get the client from the session id
    $clientID022 = $_SESSION['clientID'];

    // get the name of the page in php is refer to the given link
    //https://stackoverflow.com/questions/13032930/how-to-get-current-php-page-name
    if (basename($_SERVER['PHP_SELF'])  == "index.php") 
    {
        ?>
        <!-- BELOW IS INDEX.PHP PAGE  -->
        <h1> All PRODUCTS </h1>
        <?php
        $clientID = $_SESSION['clientID'];
        $total_count_parts = 0;
        $data_userSelectPart = json_decode(file_get_contents(BASEURL . "UserSelectPartsAPI/readUserSelectPart022.php/?clientID022=$clientID"));
        for ($j = 0; $j < sizeof((array) $data_userSelectPart->user_select_parts022); $j++) {
            $total_count_parts++;
        }
        ?>
        <!-- this is checkout button with a badge -->
        <h2 class="style_cart">
            <button onclick='checkout(<?php echo $total_count_parts; ?>, <?php echo $clientID; ?>)'>
                Checkout Cart
            </button>
            <span> <?php echo $total_count_parts; ?> </span>
        </h2>

        <?php
        // get the readPart022.php to reads all the parts
        $data = json_decode(file_get_contents(BASEURL . "PartsAPI/readPart022.php"));

        // loop through it and display it in the card form
        for ($i = 0; $i < sizeof((array) $data->Parts022); $i++) 
        {
            ?>
            <div class="card_algin">
                <div class="card">
                    <img src="img/<?php echo $data->Parts022[$i]->partImgs022; ?>" alt="img" width="100%" height="450px" />
                    <br>
                    <h1><?php echo $data->Parts022[$i]->partName022; ?></h1>
                    <br>
                    <p class=" price"><?php echo $data->Parts022[$i]->currentPrice022; ?></p>
                    <br>
                    <p><?php echo $data->Parts022[$i]->partDescription022; ?></p>
                    <br>

                    <?php
                    $count = 0;
                    for ($j = 0; $j < sizeof((array) $data_userSelectPart->user_select_parts022); $j++) {
                        if ($data_userSelectPart->user_select_parts022[$j]->partNo022 == $data->Parts022[$i]->partNo022) 
                        {
                            $count++;
                        }
                    }
                    ?>
                    <p>
                        <button onclick="add(<?php echo $data->Parts022[$i]->partNo022; ?>, <?php echo $data->Parts022[$i]->QoH022; ?>, <?php echo $clientID; ?>, <?php echo $count; ?>)">
                            ADD TO CART
                        </button>
                    </p>
                    <br>
                    <p>
                        <h3> <?php echo $count; ?> </h3>
                    </p>
                    <br>
                    <p>
                        <h3> <?php echo "Total Price: " . ($data->Parts022[$i]->currentPrice022 * $count); ?> </h3>
                    </p>
                    <br>
                    <p>
                        <button onclick="sub(<?php echo $data->Parts022[$i]->partNo022; ?>, <?php echo $data->Parts022[$i]->QoH022; ?>, <?php echo $clientID; ?>, <?php echo $count; ?>)">
                            SUB TO CART
                        </button>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
    }
    // get the name of the page in php is refer to the given link
    //https://stackoverflow.com/questions/13032930/how-to-get-current-php-page-name
    else if (basename($_SERVER['PHP_SELF'])  == "account.php") 
    {
        ?>
        <!-- BELOW IS ACCOUNT.PHP PAGE  -->
        <div class="login_page">
            <h2> Account Page </h2>
            <?php
                // get information of the client with respect to the client id for the account page
                $data = json_decode(file_get_contents(BASEURL . "ClientsAPI/readSingleClient022.php/?clientID022=$clientID022"));
            ?>
            <!-- show here in the middle of the page -->
            <div class="style_account_table">
                <br>
                <p>
                    <?php
                    echo "ID: " . $data->Clients022[0]->clientID022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "Name: " . $data->Clients022[0]->clientName022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "City: " . $data->Clients022[0]->clientCity022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "Pass: " . $data->Clients022[0]->clientCompPassword022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "Dollar On Order: $" . $data->Clients022[0]->dollarsOnOrder022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "Money Owed: $" . $data->Clients022[0]->moneyOwed022;
                    ?>
                </p>
                <br>
                <p>
                    <?php
                    echo "Status: " . $data->Clients022[0]->clientStatus022;
                    ?>
                </p>
                <br>
            </div>
        </div>
        <?php
    }
    // get the name of the page in php is refer to the given link
    //https://stackoverflow.com/questions/13032930/how-to-get-current-php-page-name
    else if (basename($_SERVER['PHP_SELF'])  == "status_of_order.php") 
    {
        $data_POs = json_decode(file_get_contents(BASEURL . "POsAPI/readAllClientIDPOs.php/?clientID022=$clientID022"));
        ?>
        <!-- BELOW IS STATUS_OF_ORDER.PHP PAGE  -->
        <div class="Status_page">
            <h2> Status on the Page</h2>
            <br>
            <!-- show the form to enter the POS ID-->
            <form method="post" class="style_form_Status_page">
                <label>
                    ENTER THE POs ID
                </label>
                <br>
                <input type="number" size="100" name="id_pos" value="id_pos" placeholder="Please Enter POs ID" required />
                <br>
                <button type="submit_pos" name="submit_pos" value="submit_pos">
                    Get Info Of POs NO
                </button>
            </form>
        </div>
        <hr>

        <?php
        if (isset($data_POs)) {
            for ($i = 0; $i < sizeof((array) $data_POs->POs022); $i++) 
            {
                $poNo022 = $data_POs->POs022[$i]->poNo022;
                $dateOfPO022 = $data_POs->POs022[$i]->dateOfPO022;
                $status022 = $data_POs->POs022[$i]->status022;
                ?>
                <!-- table to show the all clients in the login page -->
                <div class="style_login_table">
                    <p class="style_status">
                        Purchase Order Number <?php echo $poNo022; ?>.
                        <br><br>The Date of Purchase Order is <?php echo $dateOfPO022; ?>.
                        <br><br>The Status of the Purchase Order is <?php echo $status022; ?>
                    </p>
                </div>
                <?php
            }
            // isset check for the null or not
            if (isset($_POST["submit_pos"])) 
            {
                $POsNO = $_POST["id_pos"];
                $bool = false;

                // loop through the POSID
                for ($i = 0; $i < sizeof((array) $data_POs->POs022); $i++) 
                {
                    $poNo022 = $data_POs->POs022[$i]->poNo022;
                    $dateOfPO022 = $data_POs->POs022[$i]->dateOfPO022;
                    $status022 = $data_POs->POs022[$i]->status022;
                    ?>
                    <article>
                        <h2> Response are below </h2>
                        <?php
                        // given $POsNO should be equal to $poNo022
                        if ($POsNO === $poNo022) 
                        {
                            // then ge the line info with respect to the $POsNO
                            $Lines022 = json_decode(file_get_contents(BASEURL . "LinesAPI/readLines022.php/?POsNo022=$POsNO"));

                            // isset check for the null or not
                            if (isset($Lines022)) 
                            {
                                // loop through the line then show all the info from the lines
                                for ($i = 0; $i < sizeof((array) $Lines022->Lines022); $i++) 
                                {
                                    ?>
                                    <div class="style_lines">
                                        <p>
                                            Line Number :
                                            <?php
                                            echo $Lines022->Lines022[$i]->lineNo022;
                                            ?>
                                        </p>
                                        <p>
                                            Purchase Order Number :
                                            <?php
                                            echo $Lines022->Lines022[$i]->poNo022;
                                            ?>
                                        </p>
                                        <p>
                                            Part Number
                                            <?php
                                            echo $Lines022->Lines022[$i]->partNo022;
                                            ?>
                                        </p>
                                        <p>
                                            Current Price Of Part : $
                                            <?php
                                            echo $Lines022->Lines022[$i]->priceOrdered022;
                                            ?>
                                        </p>
                                        <p>
                                            Quantity :
                                            <?php
                                            echo $Lines022->Lines022[$i]->QoH022;
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            } 
                            else 
                            {
                                echo "Purchase Order Number Enter\nPlease Try Again";
                            }
                        }
                        else
                        {
                            echo "Entered Wrong Purchase Order Number\nPlease Try Again";
                        }
                        ?>
                    </article>
                    <?php
                }
            }
        }
    }
    ?>
</main>