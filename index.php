<!DOCTYPE html>
<html>

	<head>
		<title>Library</title>
		<?php include("links.html"); ?>
		<style>
			#info{
				background-image: url("images/info_img.jpeg");
			}
		
		</style>
	</head>

	
	
	<body class="no-trans" style="background-color:black;">
	<?php include("header.html"); ?>
	
	<!--Slides -->
	<div id="carousel-sample" class="carousel slide hidden-xs" data-ride="carousel" >
		<ol class="carousel-indicators">
			<li data-target="#carousel-sample" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-sample" data-slide-to="1"></li>
		</ol>

		<div class="carousel-inner">
			<div class="item active">
				<img alt="slide1" src="E.jpg">
				<div class="carousel-caption">
					<h1 style="color:white">Now Available</h1>
				</div>
			</div>
			<div class="item">
				<img alt="slide2" src="d.jpg">
				<div class="carousel-caption">
					<h1>Few books remaining. HURRY!</h1>
				</div>
			</div>



			<a class="left carousel-control" href="#carousel-sample" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span></a>

			<a class="right carousel-control" href="#carousel-sample" data-slide="next"> 
			<span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
	</br>
	
	
	<div id="banner" class="banner">
			<div class="banner-image"></div>
			<div class="banner-caption">
				<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 object-non-visible" data-animation-effect="fadeIn">
									<h1 class="text-center">Worthy Books <span>VIT's Library</span></h1>
									<p class="lead text-center">We work on creating super complex algorithms to assist you on making books avialable. Happy Reading</p>
							</div>
						</div>
				</div>
			</div>
	</div>	

	<?php include("footer.html"); ?>
	</body>
</html>