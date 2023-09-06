<?php 
include('../connection.php');

$id = $_GET['id'];
$tableName = $_GET['tableName'];

mysqli_query($conn,"delete from $tableName where id='$id'");

// header('location:index.php?page=display_member');
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
