<!DOCTYPE html>
<html>
	<?php
		include("session.php");
		include("config.php");
		
		$result = $_GET['ISBN'];
		$date = date("Y-m-d");
		
		$sql = "DELETE FROM `reservations` WHERE `reservations`.`ISBN` = '$result'";
		
		$sql2 = "UPDATE `books` SET `Reserved` = 'N' WHERE `books`.`ISBN` = '$result'";//whatsup whatsup tallaght
		
		if (mysqli_query($conn, $sql)) {
			echo "Returned successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		if (mysqli_query($conn, $sql2)) {
			echo "<br>";
			echo '<a href="home.php">Home</a>';
			header("location: home.php");
		}
		else {
			echo "It no work";
		}
		
	?>
</html>