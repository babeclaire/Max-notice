<?php
require('layout/header.php'); 
?>
<?php require('includes/db.php');
if(!isset($_SESSION['username'])) { header('Location: login.php'); }
?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"></a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                     <li><a href="#">Welcome <?php echo $_SESSION['username']; ?></a></li>
                        <li><a href="#">Notice </a></li>
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
                                <div class="pull-right">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</a>
                                    </div>
                             </div>
                            <div class="col-md-6 center-block">
                            <?php include('getData.php') ?>
                                 <?php  foreach( $result as $row ) {?>
                                <div class="row-fluid">
                                
                                    <div class="span6">
                                        <div class="media user">
                                            <div class="media-body">
                                                <h3 class="media-title">
                                                   <?php echo $row['title'];?></h3>
                                                <p>
                                                <small class="muted" ><?php echo substr($row['description'],0,100);?></small></p>
                                                <div class="media-option btn-group shaded-icon">
                                                <button class="btn btn-small">
                                               <?php echo "<td><a href=\"read.php?id=$row[id]\">Read</a> |<a href=\"update.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";?>
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <!--/.row-fluid-->
                                <!-- <br /> -->
                            </div>
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
                        
                    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="module-head" id="myModalLabel">Add notice</h3>
            </div>
              <div class="modal-body">
                <div class="control-group">
                    <form data-toggle="validator" action="insertData.php" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="title">Title</label>
                            <input type="text" name="title" class="form-control" data-error="Please enter title." required />
                            <div class="help-block with-errors"></div>
                        </div>
                          <div class="form-group">
                            <label class="control-label" for="author">Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $_SESSION['username']; ?>" data-error="Please enter Author." readonly />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Description</label>
                            <textarea name="description" rows="4" cols="50" class="form-control" data-error="Please enter description." required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       <!--/.content-->
    </div>
       <!--/.span9-->
       <!--/.container-->
</div>
  <?php
//include header template
require('layout/footer.php');
?>
