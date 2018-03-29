<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<?php include("links.html"); ?>
	<style>
	#reserved_books{
		background-color: #80bfff ;
		width: 100%;
}

#result{
	box-shadow: 0 10px 15px 0 black;
}


 hr.style18 { 
  height: 30px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 1px 0 0 0; 
  border-radius: 20px; 
} 
hr.style18:before { 
  display: block; 
  content: ""; 
  height: 30px; 
  margin-top: -31px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 0 0 1px 0; 
  border-radius: 20px; 
}
	#lgout{
	margin-top:6px;
	margin-right:10px;
	}

	</style>
</head>
<body>
	<?php
		include("session.php");
		include("config.php");
		$query = $_GET['Category'];
	?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand site-name" style="font-size:20px;">Worthy Books</a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php"><span class="fa fa-search"></span>Search</a></li>
                <li><a href="profile.php"><span class="fa fa-user"></span>Profile</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" role="button" data-toggle="dropdown">Genre/Categories<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="category_search.php?Category=Fiction">Fiction</a></li>
						<li><a href="category_search.php?Category=Biography">Biography</a></li>
						<li><a href="category_search.php?Category=Business">Business</a></li>
						<li><a href="category_search.php?Category=Travel">Travel</a></li>
						<li><a href="category_search.php?Category=Technology">Technology</a></li>
						<li><a href="category_search.php?Category=Health">Health</a></li>
						<li><a href="category_search.php?Category=Cookery">Cookery</a></li>
						<li><a href="category_search.php?Category=Self-Help">Self-Help</a></li>
					</ul>
				</li>
            </ul>
            <div class="nav navbar-nav navbar-right">
                <a id="lgout" class="btn btn-info" href="logout.php"><span class="fa fa-sign-out"></span>Logout</a>
            </div>
        </div>
    </nav>
	
	<!--NAVBAR ENDS-->
	<br>
	<br>
	<div class="section translucent-bg bg-image-1 blue">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="search"  class="text-center title"><?php echo $query; ?> BOOKS</h1>
			</div>
	</div>
		
		<!--SEARCH Head Ends-->
	

	<?php
        $query = htmlspecialchars($query); 
        $query = mysql_real_escape_string($query);
        $sql ="SELECT * FROM books WHERE Category ='$query'";
        $raw_results = mysqli_query($conn,$sql) or die(mysql_error());
		$res =  mysqli_num_rows($raw_results);
		 ?>    
         
		<div class="default-bg space blue">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h3 class="text-center">Found <?php echo $res ; ?> Result</h3>
					</div>
				</div>
			</div>
		</div>
		 
		 
		 
		 
		 <div class="container" id="reserved_books">
			<?php
				echo '<div class="well">';
				echo '<h2 class="text-center">Search Result</h2>';
				echo '<hr class="style18" style="width:250px;">';
				echo '<div class="row">';
				echo '<div class="col-md-12">';
				if(mysqli_num_rows($raw_results) > 0){
				while($row = mysqli_fetch_array($raw_results))
				{
				echo '<div class="well" id ="result">';
				echo '<h3><span class="fa fa-book"></span>  Book Title -';
				echo $row['BookTitle'];
				echo "</h3>";
				echo '<h4><span class="fa fa-pencil"></span>  Author -';
				echo $row['Author'];
				echo "</h4>";
				$ISBN = $row['Year'];
				echo '<h5><span class="fa fa-calendar"></span> Year - ';
				echo $row['Year'];
				echo "</h5>";
				echo '<h5><span class="fa fa-folder-open-o "></span> Category - ';
				echo $row['Category'];
				echo "</h5>";
				echo '<br>';
				if ($row['Reserved'] == 'Y')
				{
				echo '<input type="button" value="Not Available" class="btn btn-danger" style="border-style:inset;" />';
				}
				else{
				echo '<a href="reserve.php?ISBN='.$row["ISBN"].'" class="res btn btn-success"> Reserve </a>';
				}
				echo "<br>";
				echo "</div>";
				}
				
				}
				else{
					echo "<h3>No Books Found .</h3>";
				}
				echo '</div>';
				echo '</div>';
				echo '</div>';
				
			?>
		</div>
		
	<?php include("footer.html");?>
	</body>

	
</html>	