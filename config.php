<?php
   //this file contains database configuration
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'Bank');
   
   //try connecting to the database
   $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
   
   //check the connection
   if ($conn == false) {
   	dir('Error: cannot connect');
   }
   //else{
   //	echo"sucess";
   //}
   
   ?>
