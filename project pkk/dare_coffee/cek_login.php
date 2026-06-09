<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // CEK ADMIN (plain text)
  $q = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$username' AND password='$password'");

  if(mysqli_num_rows($q) > 0){
    $_SESSION['admin'] = $username;
    header("Location: index.php");
    exit;
  }

  // CEK USER (plain text juga, karena password di DB tidak di-hash)
  $q2 = mysqli_query($conn,
    "SELECT * FROM user WHERE username='$username' AND password='$password'");
  $data = mysqli_fetch_assoc($q2);

  if($data){
    $_SESSION['user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];
    header("Location: index.php");
    exit;
  }

  header("Location: login.php?error=1");
}
?>