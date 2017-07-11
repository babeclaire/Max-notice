<?php
require('layout/header.php'); ?>
<?php require('includes/db.php');?>
  <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                    
                    <?php   
                    if(isset($_SESSION['username']) and $_SESSION['username']!='') {?>
                          <?php echo' <li><a href="#">Welcome  '. $_SESSION['username'].' </a></li>
                            <li><a href="#">Users </a></li>
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
                        } 
                        ?> 
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
               
                    
                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    All notice</h3>
                            </div>
                            <div class="module-option clearfix">
                                <form>
                                <div class="input-append pull-left">
                                    <input type="text" class="span3" placeholder="Filter by name...">
                                    <button type="submit" class="btn">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="module-body">
                            <?php include('getData.php') ?>
                                 <?php  foreach( $result as $row ) {?>
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="media user">
                                            <div class="media-body">
                                                <h3 class="media-title">
                                                   <?php echo $row['title'];?></h3>
                                                <p>
                                                    <small class="muted"><?php echo $row['description'];?></small></p>
                                                <div class="media-option btn-group shaded-icon">
                                                    <button class="btn btn-small">
                                                        <?php echo "<td><a href=\"read.php?id=$row[id]\">Read</a></td>";?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <!--/.row-fluid-->
                                <br />
                                <div class="pagination pagination-centered">
                                    <ul>
                                        <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                    </ul>
                                </div>
                         
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
   <?php
//include header template
require('layout/footer.php');
?>

