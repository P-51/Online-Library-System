<!DOCTYPE html>
<html>
<body>

		<?php

		include("config.php");

		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$FirstName = $_POST['FirstName'];
		$Surname = $_POST['SurName'];
		$Telephone = $_POST['telephone'];
		$Mobile = $_POST['Mobile'];

		$sql = "INSERT INTO users (Username,Userna,Password,FirstName,SurName,Telephone)
		VALUES ('$Username','$Username','$Password','$FirstName','$Surname','$Telephone')";

		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
			echo "<br>";
			header("location: login.php");
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		?>
		<a href="login.html"> Click here to return to login</a>
</body>
</html>
