<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit;
}

$id = $_POST['id_produk'];
$qty = 1;

if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = [];
}

$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;

/* kalau klik beli langsung */
if(isset($_POST['beli'])){
  header("Location: checkout.php");
} else {
  header("Location: keranjang.php");
}
