<?php
include "../koneksi.php";
$id=$_GET['id'];
?>

<h2>Detail Pesanan</h2>

<table border="1" cellpadding="8">
<tr>
  <th>Produk</th>
  <th>Qty</th>
  <th>Harga</th>
</tr>

<?php
$q=mysqli_query($conn,"
SELECT pd.*, p.nama_produk
FROM pesanan_detail pd
JOIN produk p ON pd.id_produk=p.id_produk
WHERE pd.id_pesanan='$id'
");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
  <td><?= $d['nama_produk'] ?></td>
  <td><?= $d['qty'] ?></td>
  <td>Rp <?= number_format($d['harga'],0,',','.') ?></td>
</tr>
<?php } ?>
</table>
