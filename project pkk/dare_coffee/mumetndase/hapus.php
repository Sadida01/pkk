<?php 
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");

header("Location: produk.php?success=delete");
?>
