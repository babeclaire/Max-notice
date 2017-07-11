<?php
 require_once('includes/db.php');
 $title= $_POST['title'];
 $author= $_POST['author'];
 $description = $_POST['description'];
 $created_date = date('Y-m-d H:i:s');
 $stmt = $db->prepare("INSERT INTO notice(title,author,description,created_date) VALUES(:title, :author, :description,:created_date)");
 $stmt->bindparam(':title', $title);
 $stmt->bindparam(':author', $author);
 $stmt->bindparam(':description', $description);
 $stmt->bindparam(':created_date',$created_date);
 $stmt->execute();
 header('Location: notice.php');
?>