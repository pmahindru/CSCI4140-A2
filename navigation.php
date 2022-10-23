<!-- comman navigation for the all pages except login.php -->
<header class="navigation">
    <div class="shop_name">
        <a href="index.php">
            KIDDOBIZ
        </a>
    </div>
    <nav>
        <div class="nav-mobile">
            <a class="navbar-toggle" onclick="open_close_nav()">
                <span></span>
            </a>
        </div>
        
        <ul id="shownav">
            <li>
                <a href="index.php" id="active">
                    Home
                </a>
            </li>
            <li>
                <a href="status_of_order.php" id="active2">
                    Status Of Order
                </a>
            </li>
            <li>
                <a href="account.php" id="active3">
                    <?php
                        $clientID022 = $_SESSION['clientID'];
                        $data = json_decode(file_get_contents(BASEURL . "ClientsAPI/readSingleClient022.php/?clientID022=$clientID022"));

                        if(isset($data->Clients022[0]))
                        {
                            echo $data->Clients022[0]->clientName022;
                        }
                        else
                        {
                            echo "Account";
                        }
                    ?>    
                </a>
            </li>
            <li>
                <a href="logout.php">
                    logout
                </a>
            </li>
        </ul>
    </nav>
</header>