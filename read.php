<?php
require('layout/header.php'); 
require('includes/db.php');
//getting id from url
$id = $_GET['id'];
//selecting data associated with this particular id
$sql = "SELECT * FROM notice WHERE id=:id";
$query = $db->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$title = $row['title'];
	$description = $row['description'];
	$author = $row['author'];
	$created_date = $row['created_date'];
    $updated_date = $row['updated_date'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>
<body>
	 <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"></a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                    <?php   
                    if(isset($_SESSION['username']) and $_SESSION['username']!='') {?>
                          <?php echo' <li><a href="#">Welcome  '. $_SESSION['username'].' </a></li>
                            <li><a href="#">Notice </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="images/user.png" class="nav-avatar" />
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Your Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                            </li>';
                               } else {
                        echo '<li><a href="login.php"><span>Log In</span></a></li>';
                        } ?>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
	  <div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    Read notice</h3>
                            </div>
                            <div class="module-body">
			               <div class="controls row-fluid">
			               <h5>	Title </h5>
			               	<?php echo $title;?></div>
			               <div class="controls row-fluid">
			               <div class="docs">
			               <h5>	Description </h5>
			                <?php echo $description;?></div>
			                <div class="controls row-fluid">
                            <h5>    Author</h5>
                            <?php echo $author;?></div>
			               	<h5>Date created</h5>
			                <?php echo $created_date;?></div>
                            <div class="controls row-fluid">
                            <h5>Date modified</h5>
                            <?php echo $updated_date;?></div>
                        </div>
               </div>
           </div>
        </div>
      </div>
      </div>
          <?php
//include header template
require('layout/footer.php');
?>

