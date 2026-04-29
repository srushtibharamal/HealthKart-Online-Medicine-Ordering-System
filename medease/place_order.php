<?php
session_start();
include "config.php";

$user = $_SESSION['user_id'];
$address = $_POST['address'];

// Get cart items with price
$cart = mysqli_query($conn,"
SELECT cart.*, medicines.price 
FROM cart 
JOIN medicines ON cart.medicine_id = medicines.id 
WHERE user_id='$user'
");

$total = 0;

// Calculate total
while($row = mysqli_fetch_assoc($cart)){
    $total += $row['price'] * $row['quantity'];
}

// Insert order
mysqli_query($conn,"
INSERT INTO orders(user_id,total,address) 
VALUES('$user','$total','$address')
");

$order_id = mysqli_insert_id($conn);

// Insert items into order_items
$cart = mysqli_query($conn,"SELECT * FROM cart WHERE user_id='$user'");

while($row = mysqli_fetch_assoc($cart)){
    mysqli_query($conn,"
    INSERT INTO order_items(order_id,medicine_id,quantity)
    VALUES('$order_id','$row[medicine_id]','$row[quantity]')
    ");
}

// Clear cart
mysqli_query($conn,"DELETE FROM cart WHERE user_id='$user'");

echo "<script>alert('Order placed successfully');window.location='dashboard.php';</script>";
?>