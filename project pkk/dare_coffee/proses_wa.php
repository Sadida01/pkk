<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['checkout']) || empty($_SESSION['cart'])){
  header("Location: index.php");
  exit;
}

$data = $_SESSION['checkout'];
$pesan = "Halo Admin Dare Coffee,%0A%0A";
$pesan .= "Pesanan:%0A";

$total = 0;

foreach($_SESSION['cart'] as $id => $qty){
  $q = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
  $p = mysqli_fetch_assoc($q);

  $sub = $p['harga'] * $qty;
  $total += $sub;

  // KURANGI STOK
  mysqli_query($conn,
    "UPDATE produk SET stok = stok - $qty WHERE id_produk='$id'");

  $pesan .= "- ".$p['nama_produk']." (".$qty.") = Rp ".number_format($sub,0,',','.')."%0A";
}

$pesan .= "%0ATotal: Rp ".number_format($total,0,',','.');
$pesan .= "%0A%0ANama: ".$data['nama'];
$pesan .= "%0AEmail: ".$data['email'];
$pesan .= "%0AAlamat: ".$data['alamat'];
$pesan .= "%0ACatatan: ".$data['keterangan'];

unset($_SESSION['cart'], $_SESSION['checkout']);

$wa = "6289618619357"; // GANTI NOMER DI SINI
header("Location: https://wa.me/$wa?text=$pesan");
exit;
