<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

Code display UI for drafting an Email.
Subject line of  the email is decided by fetching weather data
for the user's city by using API's of https://www.weatherbit.io/

*/
include ('session.php');
$subject = "Enjoy a discount on us.";
$email = addslashes($_GET['email']);
$city = addslashes($_GET['city']);
$cityC = str_replace(' ', '%20', $city);
/*
			   Get the date 4 and 5 days back from the current date. 
			   This will be used to fectch average temperature of the city.
*/
$dateS = date("Y-m-d", strtotime("-5 day"));
$dateE = date("Y-m-d", strtotime("-4 day"));
//Curl call for getting the current weather conditions
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.weatherbit.io/v2.0/current?city=$cityC&country=US&key=e48c9e01d8ce4fb7a6be6a50a8272d75");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
$server_output = curl_exec($ch);
$data = json_decode($server_output, true);
if ($data['data'][0]["temp"] && $data['data'][0]["weather"]["description"]) {
    $currTemp = $data['data'][0]["temp"]; //Stores the current temperature
    $description = $data['data'][0]["weather"]["description"];
    if ($data['data'][0]["precip"]) $precip = $data['data'][0]["precip"];
    else $precip = 0;
} else {
    echo "Error!!";
    if (curl_exec($ch) === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    echo '<script type="text/javascript"> function leave() { window.location = "table.php"; } setTimeout("leave()", 5000); </script>';
    echo '. Redirecting shortly';
    die;
}
//Curl call for getting the average weather conditions
curl_setopt($ch, CURLOPT_URL, "https://api.weatherbit.io/v2.0/history/daily?city=$cityC&country=US&start_date=$dateS&end_date=$dateE&key=e48c9e01d8ce4fb7a6be6a50a8272d75");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
$server_output = curl_exec($ch);
curl_close($ch);
$data = json_decode($server_output, true);
if ($data['data'][0]["temp"]) $avgTemp = $data['data'][0]["temp"]; //stores the average temperature
else {
    //echo "Error!";
    if (curl_exec($ch) === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    echo '<script type="text/javascript"> function leave() { window.location = "table.php"; } setTimeout("leave()", 5000); </script>';
    echo '. Redirecting shortly';
    die;
}
if ($avgTemp > $currTemp) {
    if (abs($avgTemp - $currTemp) == 5) $subject = "Not so nice out? That's okay, enjoy a discount on us";
    else {
        if ($description == "Clear Sky" || $description == "Clear sky") $subject = "It's nice out! Enjoy a discount on us.";
        else if ($precip != 0) $subject = "Not so nice out? That's okay, enjoy a discount on us";
    }
} else {
    if ($avgTemp < $currTemp) {
        if (abs($currTemp - $avgTemp) == 5) $subject = "It's nice out! Enjoy a discount on us.";
        else {
            if ($description == "Clear Sky" || $description == "Clear sky") $subject = "It's nice out! Enjoy a discount on us.";
            else {
                if ($precip != 0) $subject = "Not so nice out? That's okay, enjoy a discount on us";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
<style>
.main-div{
    padding: 0 5%;
}
.clear-fix{
	clear:both;
}
input {
    border: inset !important;
}
</style>
  </head>
<body>
<div class='main-div'>
<h5 style=" float: left; "> Logged in as: <?php echo $user_check; ?></h5>
<h2 style=" float: right; "><a href = "logout.php">Sign Out</a></h2>
<div class="clear-fix"></div>
<form autocomplete="off" id="" method="post" action="sendEmail.php">
  TO: <input style=" width: 100%; " type="text" name="email" value="<?php echo $email ?>"><br>
  Subject: <input style=" width: 100%; " type="text" name="subject" value="<?php echo $subject ?>"><br>
  <textarea name="content">Hello, your location is <?php echo $city ?> and current temperature is <?php echo $currTemp ?> degree celsius. Also, weather is <?php echo $description ?>.</textarea>
  <input type="submit">
</form>
  </div>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=w13ef7ta1b00picnc04enlyypa5667lpz0nl379uuor7sa9p"></script>
  <script>
  /*
  Free text editor provided by https://www.tiny.cloud/get-tiny/
  */
  tinymce.init({ selector:'textarea' });</script>
</body>
</html>
