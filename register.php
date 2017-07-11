<?php require('includes/db.php');
if( $user->is_logged_in() ){ header('Location: index.php'); }
if(isset($_POST['submit'])){
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM users WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}
	}
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}
	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}
	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
	}
	if(!isset($error)){
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
		$activasion = md5(uniqid(rand(),true));
		try {
			$stmt = $db->prepare('INSERT INTO users (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('userID');
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "<p>Thank you for registering.</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Site Admin</p>";
			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
			// header('Location: register.php?action=joined');
			header('Location: login.php');

			exit;
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}
$title = '';
require('layout/header.php');
?>
  <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"></a>
               <div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">
						<li><a href="login.php">
							Login
						</a></li>
						<li><a href="resetpassword.php">
							Forgot your password?
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
  <div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
			<form role="form" method="post" action="" autocomplete="off">
			<div class="module-head">
			 <h3>Sign Up</h3>
			 </div>
               <div class="module-body">
              
				<p>Already a member? <a href='login.php'>Login</a></p>
				<hr>
				<?php
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>

				<div class="controls row-fluid">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="controls row-fluid">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				</div>
					<div class="control-group">
						<div class="controls row-fluid">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
						</div>
					</div>
					<div class="control-group">
						<div class="controls row-fluid">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
						</div>
					</div>
				</div>
                <div class="module-foot">
				<div class="control-group">
					<div class="controls clearfix"><input type="submit" name="submit" value="Register" class="btn btn-primary pull-right" tabindex="5"></div>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<?php
//include header template
require('layout/footer.php');
?>
