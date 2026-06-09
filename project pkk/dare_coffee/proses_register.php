<?php
include "koneksi.php";

if(isset($_POST['daftar'])){

  $nama     = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // cek username
  $cek = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
  if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('Username sudah dipakai');location='register.php';</script>";
    exit;
  }

  // SIMPAN TANPA HASH ❌
  $hash = $password;

  mysqli_query($conn,"INSERT INTO user(nama,username,password)
                      VALUES('$nama','$username','$hash')");

  echo "<script>alert('Register berhasil');location='login.php';</script>";
}
?>