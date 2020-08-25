<?php
/*
Project: Newsletter Subcribe-klaviyo Weather App
Developer : Tejas Raval - tr7550@rit.edu
GitHub:https://github.com/tejas101

Code template credit: https://www.tutorialspoint.com/php/php_mysql_login.htm


*/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE_ADMIN', 'login_details');
   define('DB_DATABASE_SUB', 'weather_subs');
   define('TABLE_SUBS_LIST','subs_list');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE_ADMIN);
?>