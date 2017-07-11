<?php
$num_per_page = 6;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_per_page;
$sth = $db->prepare("SELECT * FROM notice WHERE soft_delete ='0' Order By id desc LIMIT $start_from, $num_per_page");
$sth->execute();
$result = $sth->fetchAll();
?>