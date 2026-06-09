<?php
session_start();
include "../koneksi.php";
if(!isset($_SESSION['admin'])) header("Location: ../login.php");
?>

<h2>Daftar Pesanan</h2>

<table border="1" cellpadding="8">
<tr>
  <th>ID</th>
  <th>Nama User</th>
  <th>Total</th>
  <th>Status</th>
  <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn,"
SELECT pesanan.*, user.nama 
FROM pesanan 
JOIN user ON pesanan.id_user=user.id_user
ORDER BY pesanan.id DESC
");

while($p=mysqli_fetch_assoc($q)){
?>
<tr>
  <td><?= $p['id'] ?></td>
  <td><?= $p['nama'] ?></td>
  <td>Rp <?= number_format($p['total'],0,',','.') ?></td>
  <td><?= $p['status'] ?></td>
  <td>
    <a href="pesanan_detail.php?id=<?= $p['id'] ?>">Detail</a> |
    <a href="status.php?id=<?= $p['id'] ?>&s=Diproses">ACC</a>
  </td>
</tr>
<?php } ?>
</table>
