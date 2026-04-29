<?php
include "config.php";

if(isset($_POST['register'])){
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$role=$_POST['role'];

$check=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0){
echo "<script>alert('User already exists');window.location='login.php';</script>";
}else{
mysqli_query($conn,"INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password','$role')");
echo "<script>alert('Registered Successfully');window.location='login.php';</script>";
}
}
?>

<link rel="stylesheet" href="style.css">

<div class="form-box">
<img src="images/logo.png" class="logo-center">
<h2>HealthKart</h2>
<p>Care at Your Doorstep</p>

<form method="POST">
<input type="text" name="name" placeholder="Enter your full name" required>
<input type="email" name="email" placeholder="Enter your email" required>
<input type="password" name="password" placeholder="Create password" required>

<select name="role">
<option value="customer">Customer</option>
<option value="admin">Admin</option>
</select>

<button class="btn" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
</div>