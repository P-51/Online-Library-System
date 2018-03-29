<?php
    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
     
    mysql_select_db("library") or die(mysql_error());
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Search results</title>
</head>
<body>
<?php
    $query = $_POST['query']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
        $query = mysql_real_escape_string($query);
         
        $raw_results = mysql_query("SELECT * FROM books
            WHERE (`BookTitle` LIKE '%".$query."%') OR (`Author` LIKE '%".$query."%')") or die(mysql_error());
             
         
        if(mysql_num_rows($raw_results) > 0){ 
			echo '<table border="1">';
            while($results = mysql_fetch_array($raw_results)){
				echo '<tr><td>';
                echo $results['BookTitle'];
				echo '</td><td>';
				echo $results['Author'];
				echo '</td><td>';
				echo $results['Edition'];
				echo '</td><td>';
				echo $results['Year'];
				echo '</td><td>';
				echo $results['Category'];
				echo '</td><td>';
				echo $results['ISBN'];
				echo '</td><td>';
				echo $results['Reserved'];
				echo '</td><td>';
				echo '<a href="Reserve.php?ISBN='.$results["ISBN"].'"> Reserve </a>';
				echo "</td></tr>";
            }
             
        }
        else{ 
            echo "No results";
        }
         
    }
    else{ 
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>