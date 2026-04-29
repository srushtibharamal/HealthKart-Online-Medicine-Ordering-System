<?php
session_start();
include "config.php";

// SEARCH
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
<b>Admin Panel</b>
</div>

<div>
<a class="nav-btn logout-btn" href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<!-- ADD MEDICINE -->
<div class="form-box" style="max-width:400px;">
<h3>Add Medicine</h3>

<form method="POST">
<input type="text" name="name" placeholder="Medicine Name" required>
<input type="number" name="price" placeholder="Price" required>
<input type="number" name="stock" placeholder="Stock" required>
<button class="btn" name="add">Add</button>
</form>
</div>

<?php
if(isset($_POST['add'])){
mysqli_query($conn,"
INSERT INTO medicines(name,price,stock) 
VALUES('$_POST[name]','$_POST[price]','$_POST[stock]')
");
}
?>

<h2 style="text-align:center;">Manage Medicines</h2>

<!-- 🔍 SEARCH BAR -->
<form method="GET" style="text-align:center; margin-bottom:20px;">
<input 
    type="text" 
    name="search" 
    placeholder="Search medicines..." 
    value="<?php echo $search; ?>"
    style="width:250px; padding:8px; border-radius:6px;"
>
<button class="btn">Search</button>
</form>

<div class="grid">

<?php while($row=mysqli_fetch_assoc($res)){ ?>

<div class="card">
<h4><?php echo $row['name'];?></h4>
<p>₹<?php echo $row['price'];?></p>
<p>Stock: <?php echo $row['stock'];?></p>

<a class="btn" href="edit_medicine.php?id=<?php echo $row['id'];?>">Edit</a>
<a class="btn" style="background:#e74c3c;" href="delete_medicine.php?id=<?php echo $row['id'];?>">Delete</a>
</div>

<?php } ?>

</div>
</div>