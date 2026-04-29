<?php
session_start();
include "config.php";

$user=$_SESSION['user_id'];
$id=$_GET['id'];

mysqli_query($conn,"INSERT INTO cart(user_id,medicine_id,quantity) VALUES('$user','$id',1)");

echo "<script>alert('Added');window.location='dashboard.php';</script>";
?>