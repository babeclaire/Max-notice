<?php require('includes/db.php');
if( $user->is_logged_in() ){ header('Location: notice.php'); }
if(isset($_POST['submit'])){
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($row['email'])){
			$error[] = 'Email provided is not on recognised.';
		}
	}
	if(!isset($error)){
		$token = md5(uniqid(rand(),true));
		try {

			$stmt = $db->prepare("UPDATE users SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $token
			));
			$to = $row['email'];
			$subject = "Password Reset";
			$body = "<p>Someone requested that the password be reset.</p>
			<p>If this was a mistake, just ignore this email and nothing will happen.</p>
			<p>To reset your password, visit the following address: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";
			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
			header('Location: login.php?action=reset');
			exit;
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}
$title = 'Reset Account';
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
			  <h3>Reset Password</h3>
			</div>
             <div class="module-body">
             <?php
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action'])){
					switch ($_GET['action']) {
						case 'active':
							echo "<h5 class='bg-success'>Your account is now active you may now log in.</h5>";
							break;
						case 'reset':
							echo "<h5 class='bg-success'>Please check your inbox for a reset link.</h5>";
							break;
					}
				}
				?>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
				</div>
              </div>
				<div class="module-foot">
				 <div class="control-group">
					<div class="controls clearfix"><input type="submit" name="submit" value="Sent Reset Link" class="btn btn-primary pull-right" tabindex="2"></div>
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
