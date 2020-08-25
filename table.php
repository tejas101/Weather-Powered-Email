<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

Code display all the user details stored in the DB in a 
tabular format(DataTable)

*/
include ('session.php');
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    
<style>
.dataTables_filter input{
	    border: 1px solid black;
		outline: initial;
}
.clear-fix{
	clear:both;
}
.title-span{
	margin: 0 auto; 
	border: 1px solid black;
	margin-top: 10px;
}

</style>
</head>
<body><h5 style=" float: left; "> Welcome: <?php echo $user_check; ?></h5><h2><a style=" float: right; " href = "logout.php">Sign Out</a></h2>

		<div class="clear-fix"></div>
		<div style=" text-align: center; " ><span class="title-span">Email Managment Dashboard</span></div>
<table id="table_id" class="display">
        <thead>
            <tr>
                <th>Email</th>
                <th>City</th>
				<th>Email Status</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE_SUB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$sql="SELECT * FROM subs_list LIMIT 10";
$sql = "SELECT * FROM subs_list";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $email = $row['email'];
    $city = $row['city'];
?>
                <tr>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['city'] ?></td>
					<td><?php echo $row['email_status'] ?></td>
					<td><?php echo "	<form id= \"\"  action=\"process.php\">
<input name=\"email\"  type=\"hidden\" value=\"$email\">
<input name=\"city\" type=\"hidden\" value=\"$city\">
<input name=\"submit\" style=\" background: none; \" type=\"submit\" value=\"Send Mail\">
</form>" ?></td>
					
                </tr>

            <?php
}
?>
            </tbody>
            </table>	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->

	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>$(document).ready( function () {
	//Table format used : DataTable- https://datatables.net/
    $('#table_id').DataTable();
} );
</script>
</body>

</html>