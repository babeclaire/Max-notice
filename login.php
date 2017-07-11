<?php
require_once('includes/db.php');
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: notice.php');
		exit;
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}
 }
$title = 'Login';
require('layout/header.php'); 
?>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>
			  	<a class="brand" href="">
			  		Notice
			  	</a>
				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">

						<li><a href="register.php">
							Sign Up
						</a></li>
						<li><a href="resetpassword.php">
							Forgot your password?
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form role="form" method="post" action="" autocomplete="off">
				<?php
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action'])){
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
					          <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				            </div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
					            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				              </div>
						</div>
						<div class="module-foot">
					   <div class="control-group">
					<div class="controls clearfix"><input type="submit" name="submit" value="Login" class="btn btn-primary pull-right" tabindex="5"></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->
<?php 
//include header template
require('layout/footer.php'); 
?>

	
