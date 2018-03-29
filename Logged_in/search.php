<!DOCTYPE html>
<html>
<style>
body {
	background-image: url("https://imgs.6sqft.com/wp-content/uploads/2016/06/28105238/rose-reading-room-NY-public-library.jpg");
	background-color: #cccccc;
	background-position: 50% 10%;
}
.header {
	margin: auto;
    width: 40%;
    border:3px solid #415161;
    padding: 10px;
	background-color: white;
}
img.headimage {
	display: block;
    margin-left: auto;
    margin-right: auto;
	height:20%;
	width:40%;
}
.navbar {
	margin: auto;
    width: 40%;
    padding: 10px;
}
ul {
    list-style-type: none;
    margin: auto;
    align:center;
    overflow: hidden;
}
li {
	margin: auto;
    float:left;
	align:center;
	padding-left: 45px;
	font-size: 20px;
}
a {
	margin: auto;
    display: block;
    width: 60px;
	color:#ffffb3;
	font-family:Montserrat;
	text-decoration: none;
	font-weight: bold;
}
a:hover {
    color: #969696;
}
.res {
	margin: auto;
    display: block;
    width: 60px;
	color:#f000000;
	font-family:Montserrat;
	text-decoration: none;
	font-weight: bold;
}
a.res {
	margin: auto;
    display: block;
    width: 60px;
	color:#000000;
	font-family:Montserrat;
	text-decoration: none;
	font-weight: bold;
	
}
a:hover.res
{
	color: #969696;
}
.body_text {
	margin: auto;
    width: 40%;
    border:3px solid #415161;
    padding: 10px;
	background-color: white;
	opacity: 0.9;
}
a.body_text {
		color: #00000;
}
p {
	font-family:Montserrat;
	font-weight: bold;
	font-size: 16px;
	color: #00000;
	
}
.footer {
	bottom: 0px;
	height:50px;
	margin: auto;
    width: 40%;
    border:3px solid #415161;
    padding: 10px;
	background-color: white;
	opacity: 0.9;
}
#footer {
	text-align:left;
	font-family:Montserrat;
	font-size:14px;
	font-weight:bold;
	font-style:oblique;
}
.facebook {
	width:40px;
	height:40px;
	position:absolute;
}
#facebook {
	width:40px;
	height:40px;
	position:absolute;
	left:252px;
	bottom:55px;
}
.twitter {
	width:46px;
	height:46px;
	position:absolute;
}
#twitter {
	width:46px;
	height:46px;
	position:absolute;
	left:302px;
	bottom:57px;
}
.red_dragon {
	width:46px;
	height:46px;
	position:absolute;
}
#red_dragon {
	width:100px;
	height:46px;
	position:absolute;
	left:415px;
	bottom:57px;
}
.google {
	width:46px;
	height:46px;
	position:absolute;
}
#google {
	width:46px;
	height:46px;
	position:absolute;
	left:357px;
	bottom:57px;
}
</style>
<head>
<title>Library</title>
</head>
<body>
<div class="header">
<img class="headimage" src="http://carolinecircle.com/wp-content/uploads/2016/09/library-2.jpg" align="center">
</div>
<div class="navbar">
<ul>
  <li><a href="home.html">Home</a></li>
  <li><a href="search.php">Books</a></li>
  <li><a href="Profile.php">Profile</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<hr>
</div>
<div class="body_text">
<p>
 <form action="search_result.php" method="POST">
        <input type="text" name="query" />
        <input type="submit" value="Search" />
    </form>
<form action="category_search.php" method="POST">
	<select name="category" id="category">
	<option></option>
	<option value="001">Health</option>
	<option value="002">Business</option>
	<option value="003">Biography</option>
	<option value="004">Technology</option>
	<option value="005">Travel</option>
	<option value="006">Self-Help</option>
	<option value="007">Cookery</option>
	<option value="008">Fiction</option>
	</select>
	<input type="submit" value="Search" />
	<?php
		include("config.php");
		include("session.php");
		$result = mysqli_query($conn,"SELECT * FROM books");
		$sql = "SELECT Reserved";
		
		if($result === FALSE)
		{
			echo "Kill me";
		}
		
		echo '<table border="1">'."\n";
		//Header for table
		echo "<tr><th>";
		echo "ISBN";
		echo "</th><th>";
		echo "Title";
		echo "</th><th>";
		echo "Author";
		echo "</th><th>";
		echo "Edition";
		echo "</th><th>";
		echo "Year";
		echo "</th><th>";
		echo "category";
		echo "</th><th>";
		echo "Reserved";
		echo "</th></tr>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td>";
			echo $row['ISBN'];
			echo "</td><td>";
			echo $row['BookTitle'];
			echo "</td><td>";
			echo $row['Author'];
			echo "</td><td>";
			echo $row['Edition'];
			echo "</td><td>";
			echo $row['Year'];
			echo "</td><td>";
			echo $row['Category'];
			echo "</td><td>";
			echo $row['Reserved'];
			echo "</td><td>";
			if ($row['Reserved'] == 'Y')
			{
				echo "Reserved";
			}
			else
			{
			echo '<a href="reserve.php?ISBN='.$row["ISBN"].'" class="res"> Reserve </a>';
			}
			echo "</td></tr>\n";
		}
					echo "</table>";
	?>
	</p>
</div>
<hr width="40%">
</body>
<footer>
<div class="footer">
	<p id="footer">
		Follow Us On Social Media!<br>
		Copyright &copy; Red Dragon Media
	</p>
<div class="facebook" align="right">
<a href="https://www.facebook.com/">
	<img id="facebook" src="data:image/png;base64,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">
</a>
	</div>
<div class="twitter">
<a href="https://www.twitter.com/">
	<img id="twitter" src="data:image/jpeg;base64,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">
</a>
	</div>
<div class="google">
<a href="https://plus.google.com/">
	<img id="google" src="data:image/png;base64,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">
</div></a>
<div class="red_dragon">
	<img id="red_dragon" src="red_dragon.jpg">
</div>
</div>
</footer>
</html>