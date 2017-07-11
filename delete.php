<?php
require('includes/db.php');
$id = $_GET['id'];
$sql = "UPDATE notice SET soft_delete='1' WHERE id=:id";
$query = $db->prepare($sql);
$query->execute(array(':id' => $id));
header("Location:notice.php");
?>
