<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
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
	?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="home.php" class="navbar-brand site-name" style="font-size:20px;">Worthy Books</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="home.php"><span class="fa fa-search"></span>Search</a></li>
                <li class="active"><a href="profile.php"><span class="fa fa-user"></span>Profile</a></li>
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
	<div class="section translucent-bg " style="background-image: url(../images/profile_img.jpg);">
			<div class="container object-non-visible" data-animation-effect="fadeIn"><br><br>
				<h1 id="login"  class="text-center title">
				<?php 
					$user = $login_session;
					echo "Hello ";
					echo $user;
					echo " Welcome Back <br>";
				?></h1>
			</div>
	</div>
	
	<div class="container" id="reserved_books">
		<?php
			echo '<div class="well">';
			echo '<h2 class="text-center">Your Reserved Books</h2>';
			echo '<hr class="style18" style="width:250px;">';
			echo '<div class="row">';
			echo '<div class="col-md-12">';

			$raw_result = mysqli_query($conn,"SELECT * from reservations where Username = '$user'");
			if(mysqli_num_rows($raw_result) > 0){
			while($row = mysqli_fetch_array($raw_result))
			{
			echo '<div class="well" id ="result">';
			$ISBN = $row['ISBN'];
			echo '<h5><span class="fa fa-info"></span> ISBN = ';
			echo $ISBN;
			echo "</h5>";
			$bookdetails = mysqli_query($conn, "SELECT * from books WHERE ISBN = '$ISBN'");
			while($row2 = mysqli_fetch_array($bookdetails))
			{
				echo '<h3><span class="fa fa-book"></span>  Book Title -';
				echo $row2['BookTitle'];
				echo "</h3>";
			}
			echo '<br>';
			echo '<a href="return.php?ISBN='.$row["ISBN"].'" class="res btn btn-danger"> Remove </a>';
			echo "<br>";
			echo "</div>";
			}
			
			}
			else{
				echo "<h3>No Books Reserved.</h3>";
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		?>
	</div>
<?php include("footer.html");?>
</body>
</html>
