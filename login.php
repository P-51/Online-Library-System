<!DOCTYPE html>
<html>
<head>
<style>
</style>

<title>Library login</title>
<?php include("links.html"); ?>

</head>
<body>
<?php include("header.html"); ?>

	<!--LogIn Form-->
		<div class="section translucent-bg " style="background-color:#67b8bc;">
			<div class="container object-non-visible" data-animation-effect="fadeIn"><br><br>
				<h1 id="login"  class="text-center title">Login as Exisiting User</h1>
				<div class="row">
				
					<div class="search-text"> 
						<div class="container">
							<div class="row text-center">
         
								<div class="form">
								<form id="search-form" class="form-search form-horizontal" action="login_post.php" method="POST">
									<input type="text" class="input-search" placeholder="Username" name="Username" style="height:48px;width:400px; padding-left:20px;color:#333;" required><br><br>
									<input type="password" class="input-search" placeholder="Password" name="Password" style="height:48px;width:400px; padding-left:20px;color:#333;" required><br><br>
									<p style="text-align:right;color:white; padding-right:380px"><a href="#">Forgot Password ?</a></p>
									<input type="submit"  style="width:400px;background:#1ab188;border:1px solid #FFF;font-family:Roboto;color:#FFF;padding:11px 20px 11px 20px;" value="LOGIN"/>
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