<!DOCTYPE html>
<html>
<body>

		<?php

		include("config.php");
		
		session_start();
		if(session_destroy())
		{
			header("location: \myLib/login.php");
		}
		mysqli_close($conn);
		?>
</body>
</html>