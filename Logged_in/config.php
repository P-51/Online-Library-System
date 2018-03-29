<?php
   $host = "localhost";
   $username = "doctors";
   $password = "";
   $database = "library";
   
   $conn = mysqli_connect($host,$username,$password,$database);
   
   if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
?>