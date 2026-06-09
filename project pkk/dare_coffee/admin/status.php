<?php
include "../koneksi.php";
$id=$_GET['id'];
$s=$_GET['s'];
mysqli_query($conn,"UPDATE pesanan SET status='$s' WHERE id='$id'");
header("Location: pesanan.php");
