<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user']) || !isset($_POST['checkout'])){
  header("Location: checkout.php");
  exit;
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$ket = $_POST['keterangan'];

$pesan = "Halo Admin Dare Coffee,%0A";
$pesan .= "Saya ingin memesan:%0A%0A";

$total = 0;

foreach($_SESSION['cart'] as $id_produk => $qty){

  $q = mysqli_query($conn,
    "SELECT * FROM produk WHERE id_produk='$id_produk'");
  $p = mysqli_fetch_assoc($q);

  $subtotal = $p['harga'] * $qty;
  $total += $subtotal;

  // KURANGI STOK
  mysqli_query($conn,
    "UPDATE produk SET stok = stok - $qty
     WHERE id_produk='$id_produk'");

  $pesan .= "☕ ".$p['nama_produk']."%0A";
  $pesan .= "Jumlah: ".$qty."%0A";
  $pesan .= "Subtotal: Rp ".number_format($subtotal,0,',','.')."%0A%0A";
}

$pesan .= "--------------------%0A";
$pesan .= "Nama: $nama%0A";
$pesan .= "Email: $email%0A";
$pesan .= "Alamat: $alamat%0A";
$pesan .= "Catatan: $ket%0A";
$pesan .= "Terima kasih 🙏";

// kosongkan keranjang
unset($_SESSION['cart']);

$wa = "6289618619357"; // GANTI NOMER DI SINI

header("Location: https://wa.me/$wa?text=$pesan");
exit;
