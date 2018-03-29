<!DOCTYPE html>
<html>
<head>
<title>Library</title>
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
		session_start();
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
            </ul>
            <div class="nav navbar-nav navbar-right">
                <a id="lgout" class="btn btn-info" href="logout.php"><span class="fa fa-sign-out"></span>Logout</a>
            </div>
        </div>
    </nav>
	
<div class="section translucent-bg bg-image-1 blue">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="search"  class="text-center title">SEARCH</h1>
				<div class="space" align="center"><p style="font-family: 'Tangerine', cursive;"><font size="10">Search Books by Author or Book Title here .</font></p></div>
				<div class="row">
				
					<div class="search-text"> 
						<div class="container">
							<div class="row text-center">
         
								<div class="form">
								<form id="search-form" class="form-search form-horizontal" action="search_result.php" method="POST">
									<input type="text" class="input-search" placeholder="Search" name="query"style="height:48px;width:400px; padding-left:20px;color:#333;">
									<button type="submit" class="btn btn-search" style="background-color:#7dabdb;border:1px solid #FFF;font-family:Roboto;color:#FFF;padding:11px 20px 11px 20px;"><span class="fa fa-search fa-lg" ></span></button>
								</form>
								</div>        
							</div>         
						</div>     
					</div>
					
				</div>
			</div>
		</div>
		<!-- section end -->
		
		
		
		
		

		<!-- section start -->
		<!-- ================ -->
		<div class="default-bg space blue">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h3 class="text-center">HAPPY SEARCHING</h3>
					</div>
				</div>
			</div>
		</div>

		<div class="container" id="reserved_books">
		<?php
			echo '<div class="well">';
			echo '<h2 class="text-center">Available Books</h2>';
			echo '<hr class="style18" style="width:250px;">';
			echo '<div class="row">';
			echo '<div class="col-md-12">';
			$raw_result = mysqli_query($conn,"SELECT * from books where Reserved = 'N'");
			if(mysqli_num_rows($raw_result) > 0){
			while($row = mysqli_fetch_array($raw_result))
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
			echo '<br>';
			echo '<a href="reserve.php?ISBN='.$row["ISBN"].'" class="res btn btn-success"> Reserve </a>';
			echo "<br>";
			echo "</div>";
			}
			
			}
			else{
				echo "<h3>No Books Currently Available .</h3>";
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		?>
	</div>
		
		
<?php include("footer.html");?>

</body>
</html>