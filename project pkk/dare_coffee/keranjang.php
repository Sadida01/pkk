<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja - Dare Coffee</title>
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
      --green:    #2e7d52;
      --red:      #c0392b;
      --white:    #ffffff;
      --card-r:   18px;
      --shadow:   0 4px 24px rgba(59,31,14,.10);
      --shadow-lg:0 8px 40px rgba(59,31,14,.16);
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

    /* ────────────── MAIN CONTENT (CART) ────────────── */
    .cart-container {
      flex: 1;
      max-width: 900px;
      width: 100%;
      margin: 40px auto;
      padding: 0 20px;
    }

    .cart-box {
      background: var(--white);
      border-radius: var(--card-r);
      padding: 40px 32px;
      box-shadow: var(--shadow);
      border: 1px solid var(--bg2);
    }

    .cart-box h2 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--brown);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    /* TABLE DESIGN */
    .table-responsive {
      overflow-x: auto;
      margin-bottom: 24px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th {
      background: var(--cream);
      color: var(--brown);
      font-weight: 600;
      padding: 16px;
      text-align: left;
      border-bottom: 2px solid var(--bg2);
    }

    td {
      padding: 16px;
      border-bottom: 1px solid var(--bg2);
      color: var(--brown);
      vertical-align: middle;
    }

    .product-name {
      font-weight: 600;
    }

    td.qty {
      text-align: center;
      font-weight: 500;
    }

    td.price {
      text-align: right;
      font-weight: 600;
      color: var(--caramel);
    }

    /* TOTAL BAR */
    .total-wrapper {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 20px 16px;
      background: var(--cream);
      border-radius: 12px;
      margin-top: 10px;
    }

    .total-label {
      font-size: 14px;
      color: var(--muted);
      margin-right: 16px;
    }

    .total-amount {
      font-size: 22px;
      font-weight: 700;
      color: var(--espresso);
    }

    /* BUTTONS AREA */
    .actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 32px;
      gap: 16px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      border-radius: 12px;
      text-decoration: none;
      font-family: 'Sora', sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: background .18s, transform .15s;
      border: none;
    }

    .btn-back {
      background: var(--bg2);
      color: var(--brown);
    }

    .btn-back:hover {
      background: #e0cdb8;
    }

    .btn-checkout {
      background: var(--caramel);
      color: var(--white);
    }

    .btn-checkout:hover {
      background: var(--espresso);
      transform: translateY(-1px);
    }
    
    .btn-checkout:active {
      transform: translateY(0);
    }

    /* ACTION HAPUS */
    .hapus {
      color: var(--red);
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      padding: 6px 12px;
      border-radius: 8px;
      background: #fde8e8;
      transition: background .18s;
    }

    .hapus:hover {
      background: #fcc;
    }

    /* EMPTY STATE */
    .empty-state {
      text-align: center;
      padding: 48px 20px;
      color: var(--muted);
    }

    .empty-state .icon {
      font-size: 48px;
      margin-bottom: 16px;
    }

    .empty-state p {
      font-size: 15px;
      margin-bottom: 24px;
    }
  </style>
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
<div class="cart-container">
  <div class="cart-box">
    <h2>🛒 Keranjang Belanja</h2>

    <?php if(empty($_SESSION['cart'])): ?>
      <div class="empty-state">
        <div class="icon">☕</div>
        <p>Keranjang belanjaanmu masih kosong, yuk cari kopi favoritmu dulu!</p>
        <a href="index.php#menu" class="btn btn-checkout">⬅ Lihat Menu Kopi</a>
      </div>
    <?php else: ?>
      
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Produk</th>
              <th style="text-align:center">Qty</th>
              <th style="text-align:right">Subtotal</th>
              <th style="text-align:center; width:100px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            foreach($_SESSION['cart'] as $id_produk => $qty){
              $id_produk = mysqli_real_escape_string($conn, $id_produk);
              $q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
              $p = mysqli_fetch_assoc($q);

              $subtotal = $p['harga'] * $qty;
              $total += $subtotal;
            ?>
              <tr>
                <td class="product-name"><?= htmlspecialchars($p['nama_produk']); ?></td>
                <td class="qty"><?= (int)$qty; ?></td>
                <td class="price">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                <td style="text-align:center">
                  <a href="keranjang_hapus.php?id=<?= $id_produk; ?>"
                     class="hapus"
                     onclick="return confirm('Hapus item ini?')">
                     🗑 Hapus
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="total-wrapper">
        <div class="total-label">Total Pembayaran:</div>
        <div class="total-amount">Rp <?= number_format($total, 0, ',', '.'); ?></div>
      </div>

      <div class="actions">
        <a href="index.php" class="btn btn-back">🏠 Kembali ke Home</a>
        <a href="checkout.php" class="btn btn-checkout">Lanjut Checkout ➔</a>
      </div>

    <?php endif; ?>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <strong>Dare Coffee</strong> &nbsp;·&nbsp; surganya pecinta kopi &nbsp;·&nbsp; &copy; 2025
</footer>

</body>
</html>