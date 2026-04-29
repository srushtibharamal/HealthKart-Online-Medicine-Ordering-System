<?php
include "config.php";
mysqli_query($conn,"DELETE FROM medicines WHERE id=$_GET[id]");
header("Location:admin_dashboard.php");
?>