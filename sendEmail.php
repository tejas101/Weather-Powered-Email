<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

Code will send and Email by using PHPMailer libary.
Credits : https://artisansweb.net/send-email-using-gmail-smtp-server-php-script/

*/
include ('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<style>
.main-div{
    height: 50px;
    width: 50%;
    margin: 0 auto;
    text-align: CENTER;
border: 1px solid black;}

</style>
  </head>
<body>
<div class='main-div'>

<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';
if (!get_magic_quotes_gpc()) {
    $email = addslashes($_POST['email']);
    $subject = $_POST['subject'];
    $body = addslashes($_POST['content']);
} else {
    $email = $_POST['email'];
    $subject = $_POST['email'];
    $body = $_POST['content'];
}
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.googlemail.com'; //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'abc@gmail.com'; //username
    $mail->Password = 'XXXX'; //password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; //smtp port
    $mail->setFrom('noreply@tejas.net', 'Tejas Web');
    $mail->addAddress($email, 'User Name');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent. Redirecting you soon.';
        //-----
        // Create connection
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE_SUB);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE " . TABLE_SUBS_LIST . " SET email_status ='Sent' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            //echo 'Message has been sent. Redirecting you soon.';
            echo '<script type="text/javascript"> function leave() { window.location = "table.php"; } setTimeout("leave()", 3000); </script>';
        } else {
            //-----
            printf("Errormessage: %s\n", $conn->error);
            echo "MySQL error. Failed to update email_sent status in DB.";
            die;
        }
    }
}
catch(Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>
</div>
</body>
</html>