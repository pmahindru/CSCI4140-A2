<?php
	// check for the login  
	session_start();
	if(!isset($_SESSION['loginIN']) || isset($_SESSION['loginIN']) !== true){
		header('location: login.php');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<?php
	// base url 
    include "BaseURL.php";

    // adding header
    include "head.php";
?>
<body>
    <?php
		// adding navigation
		include "navigation.php";

        // adding items in the card view
        include "card.php";
	?>
	<!-- script -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>