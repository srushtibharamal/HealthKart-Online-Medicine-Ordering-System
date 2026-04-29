<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];

$res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password'");
if(mysqli_num_rows($res)>0){
$user=mysqli_fetch_assoc($res);

$_SESSION['user_id']=$user['id'];
$_SESSION['role']=$user['role'];

if($user['role']=='admin'){
echo "<script>alert('Admin Login');window.location='admin_dashboard.php';</script>";
}else{
echo "<script>alert('Login Successful');window.location='dashboard.php';</script>";
}
}else{
echo "<script>alert('Invalid Login');</script>";
}
}
?>

<link rel="stylesheet" href="style.css">

<div class="form-box">
<img src="images/logo.png" class="logo-center">
<h2>HealthKart</h2>
<p>Care at Your Doorstep</p>

<form method="POST">
<input type="email" name="email" placeholder="Enter your email" required>
<input type="password" name="password" placeholder="Enter your password" required>
<button class="btn" name="login">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>
</div>