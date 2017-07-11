<?php require('includes/db.php');
$user->logout(); 
header('Location: login.php');
exit;
?>