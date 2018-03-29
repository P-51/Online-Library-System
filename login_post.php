<?php

	session_start();

	if(isset($_POST['submit']))
	{
		if(empty($_POST['username'])|| empty($_POST['password']))
		{
			echo "Username or Password incorrect";
		}
	}

	$username = $_POST['Username'];
	$password = $_POST['Password'];



	$servername = "localhost";
	$u = "doctors";
	$p = "";
	$dbname = "library";

	$conn = mysqli_connect($servername, $u, $p, $dbname);

	if(mysqli_connect_error())
	{
		die("Connection Error");
	}


	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysqli_real_escape_string($conn,$username);
	$password = mysqli_real_escape_string($conn,$password);

	$sql = "SELECT * FROM USERS where Username = '$username' and Password =$password ";
	if($result = mysqli_query($conn,$sql))
	{
		$rows = mysqli_num_rows($result);

		if($rows == 1)
		{
			$_SESSION['login_user'] = $username;
			header("location: Logged_in/home.php");
		}
		else
		{
			header("location:failed_login.php");
		}
	}
?>
