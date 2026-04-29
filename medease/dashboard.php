<?php
session_start();
include "config.php";

// Search logic
$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM medicines";
}

$res = mysqli_query($conn,$query);
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
<div class="nav-logo">
<img src="images/logo.png">
<b>HealthKart</b>
</div>

<div>
<a class="nav-btn" href="view_cart.php">Cart</a>
<a class="nav-btn" href="order_history.php">Orders</a>
<a class="nav-btn logout-btn" href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<h2>Available Medicines</h2>
<p>Browse and order medicines easily</p>

<!-- 🔍 SEARCH BAR -->
<form method="GET" style="text-align:center; margin-bottom:20px;">
<input 
    type="text" 
    name="search" 
    placeholder="Search medicines..." 
    value="<?php echo $search; ?>" 
    style="width:250px; padding:8px; border-radius:6px; border:1px solid #ccc;"
>
<button class="btn">Search</button>
</form>

<div class="grid">

<?php
if(mysqli_num_rows($res)>0){
while($row=mysqli_fetch_assoc($res)){
?>

<div class="card">
<h4><?php echo $row['name'];?></h4>
<p>₹<?php echo $row['price'];?></p>
<a class="btn" href="cart.php?id=<?php echo $row['id'];?>">Add</a>
</div>

<?php
}
}else{
echo "<p style='text-align:center;'>No medicines found</p>";
}
?>

</div>
</div>