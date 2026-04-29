<?php
session_start();
include "config.php";

$user = $_SESSION['user_id'];
$orders = mysqli_query($conn,"
SELECT * FROM orders 
WHERE user_id='$user' 
ORDER BY id DESC
");
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
<div class="nav-logo">
<img src="images/logo.png">HealthKart
</div>

<div>
<a class="nav-btn" href="dashboard.php">Home</a>
<a class="nav-btn" href="view_cart.php">Cart</a>
<a class="nav-btn logout-btn" href="logout.php">Logout</a>
</div>
</div>

<div class="container">
<h2 style="text-align:center;">Your Orders</h2>

<?php while($order = mysqli_fetch_assoc($orders)){ ?>

<div class="card" style="width:90%; max-width:500px; margin:auto; margin-bottom:20px;">

<p><b>Order ID:</b> <?php echo $order['id']; ?></p>
<p><b>Total:</b> ₹<?php echo $order['total']; ?></p>

<p><b>Address:</b> 
<?php echo !empty($order['address']) ? $order['address'] : 'Not Provided'; ?>
</p>

<p><b>Date:</b> <?php echo $order['order_date']; ?></p>

<hr>

<?php
$items = mysqli_query($conn,"
SELECT medicines.name, order_items.quantity 
FROM order_items 
JOIN medicines ON order_items.medicine_id = medicines.id 
WHERE order_items.order_id = '$order[id]'
");

if(mysqli_num_rows($items) > 0){
    echo "<p><b>Items:</b></p>";

    while($item = mysqli_fetch_assoc($items)){
        echo "<p>- ".$item['name']." (Qty: ".$item['quantity'].")</p>";
    }
} else {
    echo "<p style='color:gray;'>No item details (old order)</p>";
}
?>

</div>

<?php } ?>

</div>