<?php
require('layout/header.php'); 
require('includes/db.php');
if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	$title=$_POST['title'];
	$description=$_POST['description'];
	$author=$_POST['author'];	
	if(empty($title) || empty($description) || empty($author)) {	
		if(empty($title)) {
			echo "<font color='red'>title field is empty.</font><br/>";
		}
		if(empty($description)) {
			echo "<font color='red'>description field is empty.</font><br/>";
		}
		if(empty($author)) {
			echo "<font color='red'>author field is empty.</font><br/>";
		}		
	} else {	
		$sql = "UPDATE notice SET title=:title, description=:description, author=:author WHERE id=:id";
		$query = $db->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':title', $title);
		$query->bindparam(':description', $description);
		$query->bindparam(':author', $author);
		$query->execute();
		header("Location: notice.php");
	}
}
?>
<?php
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
                     <li><a href="#">Welcome <?php echo $_SESSION['username']; ?></a></li>
                        <li><a href="notice.php">Notice </a></li>
                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="images/user.png" class="nav-avatar" />
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Your Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
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
                                    Update notice</h3>
                            </div>
                            <div class="module-body">
	        <form name="form1" method="post" action="update.php">
		
			<div class="controls row-fluid">
				<h5>Title</h5>
				<input type="text" class="form-control input-lg" name="title" value="<?php echo $title;?>"></div>
			<div class="controls row-fluid">
				<h5>Author</h5>
				<input type="text"  class="form-control input-lg" name="author" value="<?php echo $author;?>"></div>
			<div class="controls row-fluid">
				<h5>Description</h5>
				<textarea name="description" class="form-control input-lg" name="description" value=""><?php echo $description;?></textarea></div>
			    <div class="module-foot">
				<div class="control-group">
				<input type="hidden" name="id"  value=<?php echo $_GET['id'];?>>
				<input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
		</div>
				</div>

	</form>
	</div>
   </div>
   </div>
  </div>
</div>
          <?php
//include header template
require('layout/footer.php');
?>

