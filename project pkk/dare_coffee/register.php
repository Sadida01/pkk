<?php
session_start();
if(isset($_SESSION['user']) || isset($_SESSION['admin'])){
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun - Dare Coffee</title>
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

    nav a.btn-nav {
      background: var(--caramel);
      color: var(--white);
      padding: 9px 20px;
      border-radius: 10px;
      font-weight: 600;
    }

    nav a.btn-nav:hover { background: var(--espresso); }

    /* ────────────── REGISTER FORM ────────────── */
    .register-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .register-card {
      background: var(--white);
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
      border-radius: var(--card-r);
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--bg2);
    }

    .register-card h2 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--brown);
      text-align: center;
      margin-bottom: 8px;
    }

    .register-subtitle {
      font-size: 13px;
      color: var(--muted);
      text-align: center;
      margin-bottom: 28px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 6px;
      color: var(--brown);
      text-transform: uppercase;
      letter-spacing: .03em;
    }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      font-family: 'Sora', sans-serif;
      font-size: 14px;
      border: 1.5px solid var(--bg2);
      border-radius: 10px;
      background: var(--cream);
      color: var(--brown);
      transition: border-color .18s, background .18s;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--caramel);
      background: var(--white);
    }

    .btn-register {
      width: 100%;
      padding: 14px;
      background: var(--caramel);
      color: var(--white);
      border: none;
      border-radius: 12px;
      font-family: 'Sora', sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: background .18s, transform .15s;
      margin-top: 12px;
    }

    .btn-register:hover { background: var(--espresso); }
    .btn-register:active { transform: scale(.98); }

    .alert-error {
      background: #fde8e8;
      color: var(--red);
      border: 1px solid #f5b8b8;
      padding: 12px;
      border-radius: 10px;
      font-size: 13px;
      text-align: center;
      font-weight: 500;
      margin-bottom: 20px;
    }

    .register-footer {
      text-align: center;
      margin-top: 28px;
      font-size: 13px;
      color: var(--muted);
    }

    .register-footer a {
      color: var(--caramel);
      text-decoration: none;
      font-weight: 600;
    }

    .register-footer a:hover { text-decoration: underline; }

    /* ────────────── FOOTER ────────────── */
    footer {
      background: var(--brown);
      color: rgba(255,248,238,.7);
      text-align: center;
      padding: 28px 32px;
      font-size: 13px;
    }

    footer strong { color: var(--caramel2); }

    @media (max-width: 760px) {
      .header-inner { padding: 0 16px; }
      .register-card { padding: 32px 24px; }
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
      <a href="login.php">Masuk</a>
      <a href="register.php" class="btn-nav">Daftar</a>
    </nav>
  </div>
</header>

<!-- MAIN CONTENT WRAPPER -->
<div class="register-wrapper">
  <div class="register-card">
    <h2>Buat Akun</h2>
    <p class="register-subtitle">Daftar sekarang untuk mulai memesan kopi favoritmu</p>

    <!-- Notifikasi Error Saat Username Sudah Dipakai -->
    <?php if(isset($_GET['error'])){ ?>
      <div class="alert-error">
        ⚠️ Waduh, username tersebut sudah digunakan orang lain.
      </div>
    <?php } ?>

    <form action="proses_register.php" method="post">
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama lengkap Anda" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Buat username unik" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
      </div>

      <button type="submit" name="daftar" class="btn-register">Daftar Akun Baru</button>
    </form>

    <p class="register-footer">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </p>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <strong>Dare Coffee</strong> &nbsp;·&nbsp; surganya pecinta kopi &nbsp;·&nbsp; &copy; 2025
</footer>

</body>
</html>