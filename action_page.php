<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

This code accpets user's Email ID and City from index.html
This information is inserted into the DB and later user is redirected to
index.html file.

*/
include ("config.php"); //DB configurations
//get_magic_quotes_gpc is to prevent sorts of injection security issues
if (!get_magic_quotes_gpc()) {
    $email = addslashes($_GET['email']);
    $city = addslashes($_GET['city']);
} else {
    $email = $_GET['email'];
    $city = $_GET['city'];
}

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE_SUB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//insert query goes here
$sql = "INSERT INTO subs_list (email, city,email_status)
VALUES ('$email', '$city','Not Sent')";
if ($conn->query($sql) === TRUE) {
    $output = "Thanks. You have subscribed to the list.";
} else {
    //1062 is the error for the duplicate entry
    if ($conn->errno == 1062) {
        $my_var = <<<EOD
<a class="login100-form-title p-b-26" style=" padding-bottom: 0px !important; " href="http://localhost/weather"><u>here</u></a>
EOD;
        $output = "Email ID present. Can't add. Redirecting you soon.";
    }
}

$email = null;
$city = null;
//}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add email</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			<span class="login100-form-title p-b-26">
						<?php echo $output ?>
						<?php echo '<script type="text/javascript"> function leave() { window.location = "index.html"; } setTimeout("leave()", 3000); </script>'; ?>
					</span>
				
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->

</body>

</html>