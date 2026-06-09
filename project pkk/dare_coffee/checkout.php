<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user']) || empty($_SESSION['cart'])){
  header("Location: keranjang.php");
  exit;
}

// siapkan detail pesanan
$pesanan = "";
$total = 0;
$no = 1;

foreach($_SESSION['cart'] as $id => $qty){
  $id = mysqli_real_escape_string($conn, $id);
  $q = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
  $p = mysqli_fetch_assoc($q);

  $sub = $p['harga'] * $qty;
  $total += $sub;

  $pesanan .= "$no. {$p['nama_produk']} (x$qty) = Rp ".number_format($sub,0,',','.')."\n";
  $no++;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Dare Coffee</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg:       #fdf8f2;
      --bg2:      #f5ede0;
      --brown:    #3b1f0e;
      --espresso: #5c2d0e;
      --caramel:  #c97b2a;
      --caramel2: #e8a44a;
      --cream:    #fff8ee;
      --muted:    #9c8878;
      --white:    #ffffff;
      --card-r:   18px;
      --shadow:   0 4px 24px rgba(59,31,14,.10);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Sora', sans-serif;
      background: var(--bg);
      color: var(--brown);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ────────────── HEADER ────────────── */
    header {
      background: var(--white);
      border-bottom: 1.5px solid var(--bg2);
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .header-inner {
      max-width: 1200px;
      margin: auto;
      padding: 0 32px;
      height: 68px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .logo-icon {
      width: 38px; height: 38px;
      background: var(--caramel);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 20px;
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--brown);
      letter-spacing: .02em;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    nav a {
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      color: var(--muted);
      padding: 8px 14px;
      border-radius: 8px;
      transition: background .18s, color .18s;
    }

    nav a:hover { background: var(--bg2); color: var(--brown); }

    nav .greeting {
      font-size: 13px;
      font-weight: 500;
      color: var(--brown);
      padding: 0 8px;
    }

    nav a.btn-nav {
      background: var(--caramel);
      color: var(--white);
      padding: 9px 20px;
      border-radius: 10px;
      font-weight: 600;
    }

    nav a.btn-nav:hover { background: var(--espresso); }

    /* ────────────── MAIN CONTAINER ────────────── */
    .checkout-container {
      flex: 1;
      max-width: 520px;
      width: 100%;
      margin: 40px auto;
      padding: 0 20px;
    }

    .box {
      background: var(--white);
      border-radius: var(--card-r);
      padding: 40px 32px;
      box-shadow: var(--shadow);
      border: 1px solid var(--bg2);
    }

    h2 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--brown);
      text-align: center;
      margin-bottom: 24px;
    }

    /* TOTAL BANNER */
    .total {
      background: var(--cream);
      padding: 16px;
      border-radius: 12px;
      font-weight: 700;
      color: var(--espresso);
      text-align: center;
      font-size: 18px;
      border: 1.5px dashed var(--caramel);
      margin-bottom: 24px;
    }

    /* FORM ELEMENTS */
    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--brown);
      margin-bottom: 6px;
    }

    input, textarea {
      width: 100%;
      padding: 12px 16px;
      border-radius: 10px;
      border: 1.5px solid var(--bg2);
      background: var(--bg);
      color: var(--brown);
      font-family: 'Sora', sans-serif;
      font-size: 14px;
      transition: border-color .2s, background .2s;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: var(--caramel);
      background: var(--white);
    }

    textarea { resize: none; height: 90px; }

    /* BUTTONS */
    .btn {
      width: 100%;
      padding: 14px;
      margin-top: 12px;
      border-radius: 12px;
      font-family: 'Sora', sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: background .18s, transform .15s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
    }

    .wa {
      background: var(--caramel);
      color: var(--white);
    }
    .wa:hover {
      background: var(--espresso);
    }

    .qris {
      background: var(--cream);
      color: var(--caramel);
      border: 2px solid var(--caramel);
    }
    .qris:hover {
      background: var(--caramel);
      color: var(--white);
    }

    .btn-home {
      background: var(--bg2);
      color: var(--brown);
    }
    .btn-home:hover {
      background: #e0cdb8;
    }

    /* QRIS DISPLAY BOX */
    .qris-box {
      display: none;
      text-align: center;
      margin-top: 24px;
      padding-top: 20px;
      border-top: 1.5px solid var(--bg2);
    }

    .qris-box p {
      font-size: 14px;
      margin-bottom: 12px;
    }

    .qris-box img {
      width: 240px;
      border-radius: 12px;
      border: 4px solid var(--white);
      box-shadow: var(--shadow);
    }

    .qris-box .note {
      font-size: 12px;
      color: var(--muted);
      margin-top: 12px;
    }

    /* ────────────── FOOTER ────────────── */
    footer {
      text-align: center;
      padding: 24px;
      font-size: 13px;
      color: var(--muted);
      background: var(--white);
      border-top: 1.5px solid var(--bg2);
      margin-top: auto;
    }
  </style>

  <script>
    function validasi(){
      const n = document.getElementById('nama').value.trim();
      const e = document.getElementById('email').value.trim();
      const a = document.getElementById('alamat').value.trim();
      if(n=="" || e=="" || a==""){
        alert("Lengkapi data terlebih dahulu");
        return false;
      }
      return true;
    }

    function bayarWA(){
      if(!validasi()) return;

      const n = document.getElementById('nama').value;
      const e = document.getElementById('email').value;
      const a = document.getElementById('alamat').value;
      const k = document.getElementById('ket').value;

      const pesan = `Halo Admin Dare Coffee,
Saya ingin konfirmasi pesanan ☕🔥

🛒 Pesanan:
<?= str_replace("\n", "\\n", $pesanan) ?>
💰 Total: Rp <?= number_format($total,0,',','.') ?>

Nama: ${n}
Email: ${e}
Alamat: ${a}
Keterangan: ${k || "-"}`;

      window.open(
        "https://wa.me/6289618619357?text="+encodeURIComponent(pesan),
        "_blank"
      );
    }

    function tampilQRIS(){
      if(!validasi()) return;
      document.getElementById("qris").style.display = "block";
      document.getElementById("qris").scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</head>

<body>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <a href="index.php" class="logo">
      <div class="logo-icon">☕</div>
      <span class="logo-text">Dare Coffee</span>
    </a>
    <nav>
      <a href="index.php#menu">Menu</a>
      <span class="greeting">👋 <?= htmlspecialchars($_SESSION['nama'] ?? 'Pelanggan'); ?></span>
      <a href="logout.php" class="btn-nav" onclick="return confirm('Logout?')">Logout</a>
    </nav>
  </div>
</header>

<!-- MAIN WRAPPER -->
<div class="checkout-container">
  <div class="box">
    <h2>Checkout</h2>

    <div class="total">
      Total Pembayaran: Rp <?= number_format($total,0,',','.') ?>
    </div>

    <div class="form-group">
      <label for="nama">Nama Lengkap</label>
      <input id="nama" placeholder="Masukkan nama lengkap Anda">
    </div>

    <div class="form-group">
      <label for="email">Alamat Email</label>
      <input id="email" type="email" placeholder="contoh@email.com">
    </div>

    <div class="form-group">
      <label for="alamat">Alamat Pengiriman / Meja</label>
      <textarea id="alamat" placeholder="Tulis alamat lengkap atau nomor meja jika makan di tempat"></textarea>
    </div>

    <div class="form-group">
      <label for="ket">Keterangan Tambahan</label>
      <textarea id="ket" placeholder="Contoh: Less sugar, es agak banyak (opsional)"></textarea>
    </div>

    
    <button class="btn qris" onclick="tampilQRIS()">📱 Bayar via QRIS</button>
    <button class="btn wa" onclick="bayarWA()">💬 Kirim Bukti Pembayaran (WhatsApp)</button>
    <a href="index.php" class="btn btn-home">🏠 Kembali ke Home</a>

    <!-- QRIS TARGET DISPLAY -->
    <div class="qris-box" id="qris">
      <p><b>Silakan Scan QRIS di Bawah Ini:</b></p>
      <img src="img/qr.jpeg" alt="QRIS Code Dare Coffee">
      <p class="note">Jika sudah melakukan prmbayaran, silahkan kirim bukti pembayaran dan detail pesanan.</p>
    </div>

  </div>
</div>

<!-- FOOTER -->
<footer>
  <strong>Dare Coffee</strong> &nbsp;·&nbsp; Surganya pecinta kopi &nbsp;·&nbsp; &copy; 2026
</footer>

</body>
</html>