<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Manajemen Produk</title>
<style>
table{border-collapse:collapse;width:100%}
td,th{border:1px solid #ddd;padding:10px;text-align:center}
a.btn{padding:6px 12px;background:#333;color:#fff;text-decoration:none;border-radius:5px}
a.btn:hover{background:orange;}
</style>
</head>
<body>

<h2>📦 Daftar Produk</h2>
<a href="tambah.php" class="btn">➕ Tambah Produk</a>
<br><br>

<table>
<tr style="background:#eee;">
<th>ID</th>
<th>Nama Produk</th>
<th>Harga</th>
<th>Stok</th>
<th>Kategori</th>
<th>Gambar</th>
<th>Tanggal Dibuat</th>
<th>Aksi</th>
</tr>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
while($d = mysqli_fetch_array($data)){
?>
<tr>
<td><?= $d['id_produk']; ?></td>
<td><?= $d['nama_produk']; ?></td>
<td>Rp<?= number_format($d['harga']); ?></td>
<td><?= $d['stok']; ?></td>
<td><?= $d['kategori']; ?></td>
<td><img src="upload/<?= $d['gambar']; ?>" width="70"></td>
<td><?= $d['tanggal_ditambahkan']; ?></td>
<td>
<a class="btn" href="edit.php?id=<?= $d['id_produk']; ?>">✏ Edit</a>
<a class="btn" style="background:#d11;" href="hapus.php?id=<?= $d['id_produk']; ?>" onclick="return confirm('Yakin hapus produk?')">🗑 Hapus</a>
</td>
</tr>
<?php } ?>
</table>

</body>
</html>
