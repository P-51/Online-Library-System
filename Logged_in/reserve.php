<!DOCTYPE html>
<html>
	<?php
		include("session.php");
		include("config.php");
		
		$result = $_GET['ISBN'];
		$date = date("Y-m-d");
		
		$sql = "INSERT INTO reservations (ISBN,Username, ReservedDate)
		VALUES ('$result','$login_session','$date')";
		
		$sql2 = "UPDATE `books` SET `Reserved` = 'Y' WHERE `books`.`ISBN` = '$result'";
		
		if (mysqli_query($conn, $sql)) {
			echo "Reserved successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		if (mysqli_query($conn, $sql2)) {
			echo "<br>";
			header("location: home.php");
		}
		else {
			echo "It no work";
		}
		
	?>
</html>