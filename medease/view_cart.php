<?php
session_start();
include "config.php";

$user=$_SESSION['user_id'];
$res=mysqli_query($conn,"SELECT cart.id cid,medicines.* FROM cart JOIN medicines ON cart.medicine_id=medicines.id WHERE user_id='$user'");
$total=0;
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
<div class="nav-logo">
<img src="images/logo.png">HealthKart
</div>

<div>
<a class="nav-btn" href="dashboard.php">Shop</a>
<a class="nav-btn" href="order_history.php">Orders</a>
<a class="nav-btn logout-btn" href="logout.php">Logout</a>
</div>
</div>

<div class="grid">
<?php while($row=mysqli_fetch_assoc($res)){
$total+=$row['price'];
?>
<div class="card">
<h4><?php echo $row['name'];?></h4>
<p>₹<?php echo $row['price'];?></p>
<a class="btn" href="remove.php?id=<?php echo $row['cid'];?>">Remove</a>
</div>
<?php } ?>
</div>

<h3 style="text-align:center;">Total: ₹<?php echo $total;?></h3>

<center>
<button class="btn" onclick="showBox()">Place Order</button>

<div id="box" class="address-popup">
<form method="POST" action="place_order.php">
<input type="text" name="address" placeholder="Enter delivery address" required>
<button class="btn">Confirm</button>
</form>
</div>
</center>

<script>
function showBox(){
document.getElementById("box").style.display="block";
}
</script>