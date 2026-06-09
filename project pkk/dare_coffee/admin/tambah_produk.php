<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
<h2>Tambah Produk Dare Coffee</h2>
<form method="post" enctype="multipart/form-data">
    Nama Produk : <input type="text" name="nama_produk" required><br><br>
    Deskripsi : <br><textarea name="deskripsi"></textarea><br><br>
    Harga : <input type="number" name="harga" required><br><br>
    Stok : <input type="number" name="stok"><br><br>
    Gambar : <input type="file" name="gambar"><br><br>
    <input type="submit" name="simpan" value="Simpan">
</form>

<?php
if(isset($_POST['simpan'])){
    $nama  = $_POST['nama_produk'];
    $desk  = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $file  = $_FILES['gambar']['name'];
    $tmp   = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "img/".$file);

    mysqli_query($conn, "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar)
                         VALUES ('$nama','$desk','$harga','$stok','$file')");
    echo "<script>alert('Data disimpan');location='index.php';</script>";
}
?>
</body>
</html>
