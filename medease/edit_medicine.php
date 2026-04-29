<?php
session_start();
include "config.php";

$id = $_GET['id'];

// Fetch medicine data
$res = mysqli_query($conn,"SELECT * FROM medicines WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

// Update logic
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    mysqli_query($conn,"
    UPDATE medicines 
    SET name='$name', price='$price', stock='$stock'
    WHERE id='$id'
    ");

    echo "<script>alert('Medicine Updated');window.location='admin_dashboard.php';</script>";
}
?>

<link rel="stylesheet" href="style.css">

<div class="form-box">
<h3>Edit Medicine</h3>

<form method="POST">
<input type="text" name="name" value="<?php echo $row['name']; ?>" required>
<input type="number" name="price" value="<?php echo $row['price']; ?>" required>
<input type="number" name="stock" value="<?php echo $row['stock']; ?>" required>

<button class="btn" name="update">Update</button>
</form>
</div>