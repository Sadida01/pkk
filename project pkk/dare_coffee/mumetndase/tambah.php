<?php 
include "../koneksi.php"; // <-- ubah path sesuai posisi file
?>

<?php
if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];

    // --- Upload File ---
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // Pastikan folder upload ada
    if(!is_dir("upload")){
        mkdir("upload");
    }

    move_uploaded_file($tmp, "upload/".$gambar);

    mysqli_query($koneksi, "INSERT INTO produk VALUES('', '$nama', '$deskripsi', '$harga', '$stok', '$gambar', '$kategori', now())");

    header("Location: produk.php?success=add");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
<h2>➕ Tambah Produk</h2>
Nama Produk:<br>
<input type="text" name="nama" required><br><br>

Deskripsi:<br>
<textarea name="deskripsi"></textarea><br><br>

Harga:<br>
<input type="number" name="harga" required><br><br>

Stok:<br>
<input type="number" name="stok" required><br><br>

Kategori:<br>
<input type="text" name="kategori"><br><br>

Gambar:<br>
<input type="file" name="gambar" required><br><br>

<button type="submit" name="simpan">Simpan</button>
</form>
<br>
<a href="produk.php">⬅ Kembali</a>
