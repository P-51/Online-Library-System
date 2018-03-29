<!DOCTYPE html>
<html>
<head>
<title>Library register</title>
<?php include("links.html"); ?>
</head>
<body>
<?php include("header.html"); ?>

	<!--Sign Up Form-->
		<div class="section translucent-bg" style="background-color:#67b8bc;">
			<div class="container object-non-visible" data-animation-effect="fadeIn"><br><br>
				<h1 id="signup"  class="text-center title">Sign Up for Free</h1>
				<div class="row">
					<div class="search-text"> 
						<div class="container col-md-12">
							<div class="row text-center">
								<div class="form">
								<form id="search-form" class="form-search form-horizontal" action = "register_post.php" method="post" >
									<input type="text" class="input-search" placeholder="First Name" name="FirstName" style="height:48px;width:175px; padding-left:20px;color:#333;" required>
									<span style="padding-left:25px"><input type="text" class="input-search" placeholder="Last Name" name="SurName" style="height:48px;width:175px; padding-left:20px;color:#333;" required></span><br><br>
									<input type="text" class="input-search" placeholder="Username" name="Username" style="height:48px;width:400px; padding-left:20px;color:#333;" required><br><br>
									<input type="password" class="input-search" placeholder="Password" name ="Password" style="height:48px;width:400px; padding-left:20px;color:#333;" required><br><br>
									<input type="text" class="input-search" placeholder="Phone Number" name="telephone" style="height:48px;width:400px; padding-left:20px;color:#333;" required><br><br>
									<input type="submit"  style="width:400px;background:#1ab188;border:1px solid #FFF;font-family:Roboto;color:#FFF;padding:11px 20px 11px 20px;" value="Register"/>
								</form>
								</div>        
							</div>         
						</div>     
					</div>
				</div>
			</div>
		</div>

<?php include("footer.html"); ?>

</body>

</html>