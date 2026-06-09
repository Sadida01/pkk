<?php include "koneksi.php"; ?>

<?php
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];

    if($_FILES['gambar']['name'] != ""){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "upload/".$gambar);
    } else {
        $gambar = $d['gambar'];
    }

    mysqli_query($koneksi, "UPDATE produk SET 
        nama_produk='$nama',
        deskripsi='$deskripsi',
        harga='$harga',
        stok='$stok',
        gambar='$gambar',
        kategori='$kategori'
        WHERE id_produk='$id'");

    header("Location: produk.php?success=edit");
}
?>

<form method="POST" enctype="multipart/form-data">
<h2>✏ Edit Produk</h2>

Nama:<br><input type="text" name="nama" value="<?= $d['nama_produk']; ?>"><br><br>
Deskripsi:<br><textarea name="deskripsi"><?= $d['deskripsi']; ?></textarea><br><br>
Harga:<br><input type="number" name="harga" value="<?= $d['harga']; ?>"><br><br>
Stok:<br><input type="number" name="stok" value="<?= $d['stok']; ?>"><br><br>
Kategori:<br><input type="text" name="kategori" value="<?= $d['kategori']; ?>"><br><br>

Gambar Lama:<br>
<img src="upload/<?= $d['gambar']; ?>" width="100"><br>
Ganti Gambar: <input type="file" name="gambar"><br><br>

<button type="submit" name="update">Update</button>
</form>
<br>
<a href="produk.php">⬅ Kembali</a>
