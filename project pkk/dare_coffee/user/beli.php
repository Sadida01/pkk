<?php
$no_wa = "6282223561415";

$nama_produk = $_POST['nama_produk'];
$harga       = $_POST['harga'];
$qty         = $_POST['qty'];

$total = $harga * $qty;

// format pesan WhatsApp
$pesan = "Halo Admin, saya ingin melakukan pembelian:%0A"
       . "Produk : $nama_produk%0A"
       . "Jumlah : $qty%0A"
       . "Harga  : Rp " . number_format($harga,0,',','.') . "%0A"
       . "Total  : Rp " . number_format($total,0,',','.') . "%0A%0A"
       . "Mohon diproses ya 🙏";

$url = "https://wa.me/$no_wa?text=$pesan";

// redirect ke WhatsApp
header("Location: $url");
exit;
