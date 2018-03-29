<?php
		include("session.php");
		include("config.php");
	$q = $_REQUEST["q"];
	$result = mysqli_query($conn,"SELECT BookTitle FROM books
            WHERE (BookTitle LIKE '%".$q."%') ");
	$rows = [];
	while($row = mysqli_fetch_array($result))
	{
		$rows[] = $row;
	}
	$hint = ""; 
	if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		foreach($rows as $name) {
			$name = implode(',', $name);
			if (stristr($q, substr($name, 0, $len))) {
				if ($hint === "") {
					$hint = $name;
				} 
				else {
					$hint .= ", $name";
				}
			}
		}
	}
			// Set output to "no suggestion" if no hint was found
			// or to the correct values
			if ($hint=="") {
			  $response="no suggestion";
			} else {
			  $response=$hint;
			}
?>