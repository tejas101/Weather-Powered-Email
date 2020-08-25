<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

Code template credit: https://www.tutorialspoint.com/php/php_mysql_login.htm
*/
   session_start();
   
   if(session_destroy()) {
      header("Location: login.php");
   }
?>