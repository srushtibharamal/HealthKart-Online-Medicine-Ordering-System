<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='customer'){
    header("Location: login.php");
    exit();
}

include "config.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM cart WHERE id='$id'");

echo "<script>alert('Item Removed'); window.location='view_cart.php';</script>";
?>