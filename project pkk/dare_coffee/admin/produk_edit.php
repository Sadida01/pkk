<?php
include "../koneksi.php";

// Melindungi parameter ID dari SQL Injection
$id = mysqli_real_escape_string($conn, $_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
$p = mysqli_fetch_assoc($q);

if (isset($_POST['update'])) {
  // Melindungi input form dari SQL Injection
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $harga = mysqli_real_escape_string($conn, $_POST['harga']);
  $stok = mysqli_real_escape_string($conn, $_POST['stok']);

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];

  if ($gambar) {
    move_uploaded_file($tmp, "../img/" . $gambar);
    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', gambar='$gambar' WHERE id_produk='$id'");
  } else {
    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id_produk='$id'");
  }

  header("Location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk - Dare Coffee Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg:       #fdf8f2;
      --bg2:      #f5ede0;
      --brown:    #3b1f0e;
      --espresso: #5c2d0e;
      --caramel:  #c97b2a;
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

    .admin-badge {
      font-size: 12px;
      font-weight: 600;
      background: var(--espresso);
      color: var(--white);
      padding: 6px 14px;
      border-radius: 20px;
      letter-spacing: 0.05em;
    }

    /* ────────────── MAIN CONTAINER ────────────── */
    .form-container {
      flex: 1;
      max-width: 480px;
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
      font-size: 26px;
      font-weight: 700;
      color: var(--brown);
      text-align: center;
      margin-bottom: 24px;
    }

    /* FORM ELEMENTS */
    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--brown);
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
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

    input[type="file"] {
      padding: 8px 12px;
      background: var(--white);
      cursor: pointer;
    }

    input:focus {
      outline: none;
      border-color: var(--caramel);
      background: var(--white);
    }

    /* IMAGE PREVIEW */
    .current-img-box {
      background: var(--bg);
      border: 1.5px dashed var(--bg2);
      padding: 12px;
      border-radius: 10px;
      text-align: center;
      margin-top: 6px;
    }

    .current-img-box p {
      font-size: 11px;
      color: var(--muted);
      margin-bottom: 8px;
      font-weight: 500;
    }

    img {
      display: block;
      margin: 0 auto;
      border-radius: 8px;
      border: 2px solid var(--white);
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
      max-height: 120px;
      object-fit: cover;
    }

    /* BUTTONS */
    .btn {
      width: 100%;
      padding: 14px;
      margin-top: 10px;
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

    .btn-submit {
      background: var(--caramel);
      color: var(--white);
    }

    .btn-submit:hover {
      background: var(--espresso);
    }

    .btn-home {
      background: var(--bg2);
      color: var(--brown);
    }

    .btn-home:hover {
      background: #e0cdb8;
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
</head>
<body>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <a href="../index.php" class="logo">
      <div class="logo-icon">☕</div>
      <span class="logo-text">Dare Coffee</span>
    </a>
    <div class="admin-badge">PANEL ADMIN</div>
  </div>
</header>

<!-- MAIN WRAPPER -->
<div class="form-container">
  <div class="box">
    <h2>Edit Data Produk</h2>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama">Nama Produk</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>
      </div>

      <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" value="<?= (int)$p['harga'] ?>" required>
      </div>

      <div class="form-group">
        <label for="stok">Jumlah Stok</label>
        <input type="number" id="stok" name="stok" value="<?= (int)$p['stok'] ?>" required>
      </div>

      <div class="form-group">
        <label for="gambar">Ganti Foto Baru (Opsional)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
        
        <div class="current-img-box">
          <p>📸 Gambar Saat Ini:</p>
          <img src="../img/<?= $p['gambar'] ?>" alt="Foto <?= htmlspecialchars($p['nama_produk']) ?>">
        </div>
      </div>

      <button type="submit" name="update" class="btn btn-submit">🔄 Perbarui Data Produk</button>
      <a href="../index.php" class="btn btn-home">🏠 Kembali ke Home</a>
    </form>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <strong>Dare Coffee Admin Area</strong> &nbsp;·&nbsp; &copy; 2026
</footer>

</body>
</html>