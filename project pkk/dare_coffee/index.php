<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dare Coffee</title>
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
    html { scroll-behavior: smooth; }

    body {
      font-family: 'Sora', sans-serif;
      background: var(--bg);
      color: var(--brown);
      min-height: 100vh;
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

    nav a.btn-cart {
      background: var(--bg2);
      color: var(--brown);
      padding: 9px 18px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    nav a.btn-cart:hover { background: #e8d8c4; }

    /* ────────────── HERO ────────────── */
    .hero {
      background: var(--brown);
      overflow: hidden;
      position: relative;
    }

    .hero-inner {
      max-width: 1200px;
      margin: auto;
      padding: 64px 32px 56px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
    }

    .hero-left { flex: 1; min-width: 280px; }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(201,123,42,.22);
      color: var(--caramel2);
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .08em;
      padding: 6px 14px;
      border-radius: 100px;
      margin-bottom: 20px;
    }

    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(36px, 5vw, 60px);
      font-weight: 700;
      color: var(--white);
      line-height: 1.15;
      margin-bottom: 16px;
    }

    .hero h1 span { color: var(--caramel2); font-style: italic; }

    .hero-desc {
      font-size: 15px;
      font-weight: 300;
      color: rgba(255,248,238,.65);
      line-height: 1.75;
      max-width: 420px;
      margin-bottom: 32px;
    }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    .btn-hero-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--caramel);
      color: var(--white);
      font-size: 14px;
      font-weight: 600;
      padding: 14px 28px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: background .2s, transform .15s;
    }

    .btn-hero-primary:hover { background: var(--caramel2); transform: translateY(-1px); }

    .btn-hero-ghost {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255,255,255,.10);
      color: rgba(255,248,238,.85);
      font-size: 14px;
      font-weight: 500;
      padding: 14px 28px;
      border-radius: 12px;
      border: 1.5px solid rgba(255,255,255,.15);
      cursor: pointer;
      text-decoration: none;
      transition: background .2s;
    }

    .btn-hero-ghost:hover { background: rgba(255,255,255,.18); }

    .hero-stats {
      display: flex;
      gap: 32px;
      margin-top: 44px;
      padding-top: 32px;
      border-top: 1px solid rgba(255,255,255,.10);
      flex-wrap: wrap;
    }

    .hero-stat strong {
      display: block;
      font-size: 28px;
      font-family: 'Playfair Display', serif;
      color: var(--caramel2);
      margin-bottom: 2px;
    }

    .hero-stat span {
      font-size: 12px;
      color: rgba(255,248,238,.5);
      font-weight: 400;
      text-transform: uppercase;
      letter-spacing: .08em;
    }

    /* Hero image side */
    .hero-right {
      flex: 0 0 360px;
      position: relative;
    }

    .hero-img-main {
      width: 100%;
      height: 340px;
      object-fit: cover;
      border-radius: 20px;
      display: block;
    }

    .hero-img-badge {
      position: absolute;
      bottom: -16px;
      left: -20px;
      background: var(--white);
      border-radius: 16px;
      padding: 14px 20px;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .hero-img-badge-icon { font-size: 28px; }

    .hero-img-badge-text strong {
      display: block;
      font-size: 14px;
      font-weight: 700;
      color: var(--brown);
    }

    .hero-img-badge-text span {
      font-size: 12px;
      color: var(--muted);
    }

    /* ────────────── FILTER TABS ────────────── */
    
    /* ────────────── MAIN LAYOUT ────────────── */
    .main {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 32px 80px;
    }

    .section-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
    }

    .section-head h2 {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--brown);
    }

    .admin-add-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--green);
      color: var(--white);
      font-size: 13px;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 10px;
      text-decoration: none;
      transition: opacity .2s;
    }

    .admin-add-btn:hover { opacity: .88; }

    /* ────────────── PRODUCT GRID ────────────── */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(248px, 1fr));
      gap: 20px;
    }

    .pcard {
      background: var(--white);
      border-radius: var(--card-r);
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: box-shadow .25s, transform .25s;
    }

    .pcard:hover {
      box-shadow: var(--shadow-lg);
      transform: translateY(-4px);
    }

    .pcard-img {
      position: relative;
      height: 200px;
      overflow: hidden;
    }

    .pcard-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform .5s;
    }

    .pcard:hover .pcard-img img { transform: scale(1.06); }

    .stok-badge {
      position: absolute;
      top: 12px;
      right: 12px;
      background: var(--white);
      color: var(--brown);
      font-size: 11px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 100px;
      border: 1.5px solid var(--bg2);
    }

    .stok-badge.low { background: #fff3e0; color: #e65100; border-color: #ffe0b2; }
    .stok-badge.empty { background: #fde8e8; color: var(--red); border-color: #fbb; }

    .pcard-body {
      padding: 16px 18px 18px;
    }

    .pcard-name {
      font-size: 16px;
      font-weight: 700;
      color: var(--brown);
      margin-bottom: 6px;
      line-height: 1.3;
    }

    .pcard-desc {
      font-size: 12px;
      color: var(--muted);
      margin-bottom: 14px;
      line-height: 1.5;
      min-height: 18px;
    }

    .pcard-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .pcard-price {
      font-size: 18px;
      font-weight: 700;
      color: var(--caramel);
    }

    .pcard-price small {
      display: block;
      font-size: 11px;
      font-weight: 400;
      color: var(--muted);
      margin-bottom: 1px;
    }

    /* BUY BUTTON */
    .btn-add-cart {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--caramel);
      color: var(--white);
      font-size: 13px;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-family: 'Sora', sans-serif;
      transition: background .18s, transform .15s;
      text-decoration: none;
      white-space: nowrap;
    }

    .btn-add-cart:hover { background: var(--espresso); transform: scale(1.03); }

    .btn-add-cart:active { transform: scale(.98); }

    /* Guest prompt */
    .btn-login-buy {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--bg2);
      color: var(--espresso);
      font-size: 12px;
      font-weight: 600;
      padding: 10px 16px;
      border-radius: 10px;
      text-decoration: none;
      white-space: nowrap;
      transition: background .18s;
    }

    .btn-login-buy:hover { background: #e0cdb8; }

    /* ADMIN BUTTONS */
    .btn-edit-card {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: #fff8ee;
      color: var(--caramel);
      border: 1.5px solid #f5ddb0;
      font-size: 12px;
      font-weight: 600;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-family: 'Sora', sans-serif;
      transition: background .18s;
    }

    .btn-edit-card:hover { background: #fdecc8; }

    .btn-del-card {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: #fde8e8;
      color: var(--red);
      border: 1.5px solid #f5b8b8;
      font-size: 12px;
      font-weight: 600;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-family: 'Sora', sans-serif;
      cursor: pointer;
      transition: background .18s;
    }

    .btn-del-card:hover { background: #fcc; }

    /* ────────────── EMPTY & PROMO ────────────── */
    .empty-state {
      grid-column: 1/-1;
      text-align: center;
      padding: 80px 20px;
      color: var(--muted);
    }

    .empty-state .icon { font-size: 48px; margin-bottom: 16px; }

    .empty-state p { font-size: 16px; }

    /* Promo Banner */
    .promo-banner {
      background: linear-gradient(135deg, var(--espresso) 0%, #8b4513 100%);
      border-radius: 16px;
      padding: 28px 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 36px;
      flex-wrap: wrap;
    }

    .promo-text strong {
      display: block;
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      color: var(--white);
      margin-bottom: 4px;
    }

    .promo-text span {
      font-size: 14px;
      color: rgba(255,248,238,.7);
    }

    .promo-tag {
      background: var(--caramel2);
      color: var(--brown);
      font-size: 13px;
      font-weight: 700;
      padding: 10px 22px;
      border-radius: 100px;
      white-space: nowrap;
    }

    /* ────────────── FLOATING CART ────────────── */
    .fab-cart {
      display: none;
      position: fixed;
      bottom: 28px;
      right: 28px;
      z-index: 99;
      background: var(--caramel);
      color: var(--white);
      padding: 14px 22px;
      border-radius: 100px;
      font-size: 14px;
      font-weight: 700;
      text-decoration: none;
      box-shadow: 0 6px 32px rgba(201,123,42,.4);
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background .2s, transform .15s;
    }

    .fab-cart:hover { background: var(--espresso); transform: translateY(-2px); }

    /* ────────────── FOOTER ────────────── */
    footer {
      background: var(--brown);
      color: rgba(255,248,238,.7);
      text-align: center;
      padding: 28px 32px;
      font-size: 13px;
    }

    footer strong { color: var(--caramel2); }

    /* ────────────── RESPONSIVE ────────────── */
    @media (max-width: 760px) {
      .header-inner { padding: 0 16px; }
      .hero-inner { padding: 40px 20px 48px; }
      .hero-right { flex: 0 0 100%; }
      .main { padding: 28px 16px 60px; }
      .filter-inner { padding: 0 16px; }
      .promo-banner { padding: 22px 22px; }
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
      <a href="#menu">Menu</a>

      <?php if(isset($_SESSION['admin'])): ?>
        <span class="greeting">👋 Admin</span>
        <a href="logout.php" class="btn-nav" onclick="return confirm('Logout?')">Logout</a>

      <?php elseif(isset($_SESSION['user'])): ?>
        <span class="greeting">👋 <?= htmlspecialchars($_SESSION['nama']); ?></span>
        <a href="keranjang.php" class="btn-cart">🛒 Keranjang</a>
        <a href="logout.php" class="btn-nav" onclick="return confirm('Logout?')">Logout</a>

      <?php else: ?>
        <a href="login.php">Masuk</a>
        <a href="register.php" class="btn-nav">Daftar</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <div class="hero-left">
      <div class="hero-badge">☕ &nbsp;Kopi Premium Pilihan</div>
      <h1>Setiap Tegukan<br>Punya <span>Cerita</span></h1>
      <p class="hero-desc">Dari biji pilihan terbaik hingga ke cangkirmu. Nikmati koleksi minuman kopi dan non-kopi kami yang dibuat dengan penuh cinta.</p>
      <div class="hero-actions">
        <button class="btn-hero-primary" onclick="document.getElementById('menu').scrollIntoView({behavior:'smooth'})">
          🛍️ &nbsp;Pesan Sekarang
        </button>
        <?php if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
          <a href="login.php" class="btn-hero-ghost">Masuk Dulu →</a>
        <?php endif; ?>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><strong>20+</strong><span>Varian Menu</span></div>
        <div class="hero-stat"><strong>4.9★</strong><span>Rating</span></div>
        <div class="hero-stat"><strong>100%</strong><span>Biji Pilihan</span></div>
      </div>
    </div>
    <div class="hero-right">
      <img src="img/warung.jpg" alt="Dare Coffee" class="hero-img-main">
      <div class="hero-img-badge">
        <div class="hero-img-badge-icon">🏆</div>
        <div class="hero-img-badge-text">
          <strong>Best Seller</strong>
          <span>Caramel Latte</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FILTER BAR -->


<!-- MAIN CONTENT -->
<div class="main" id="menu">

  <?php if(!isset($_SESSION['admin'])): ?>
  <!-- PROMO BANNER -->
  <div class="promo-banner">
    <div class="promo-text">
      <strong>☀️ Promo Pagi! Hemat 15%</strong>
      <span>Order sebelum jam 10.00 · Berlaku setiap hari</span>
    </div>
    <div class="promo-tag">Klaim Promo →</div>
  </div>
  <?php endif; ?>

  <div class="section-head">
    <h2>Menu Kami</h2>
    <?php if(isset($_SESSION['admin'])): ?>
      <a href="admin/produk_add.php" class="admin-add-btn">+ Tambah Produk</a>
    <?php endif; ?>
  </div>

  <div class="product-grid" id="product-grid">
    <?php
    $q = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk ASC");
    if (mysqli_num_rows($q) == 0):
    ?>
      <div class="empty-state">
        <div class="icon">☕</div>
        <p>Produk belum tersedia. Nantikan menu kami!</p>
      </div>
    <?php else: while($p = mysqli_fetch_assoc($q)): 
      $stok = (int)$p['stok'];
      $stok_class = $stok <= 0 ? 'empty' : ($stok <= 5 ? 'low' : '');
      $stok_label = $stok <= 0 ? 'Habis' : ($stok <= 5 ? "Sisa $stok" : "Stok $stok");
    ?>
      <div class="pcard" data-cat="kopi">
        <div class="pcard-img">
          <img src="img/<?= htmlspecialchars($p['gambar']); ?>" alt="<?= htmlspecialchars($p['nama_produk']); ?>" loading="lazy">
          <div class="stok-badge <?= $stok_class ?>"><?= $stok_label ?></div>
        </div>
        <div class="pcard-body">
          <div class="pcard-name"><?= htmlspecialchars($p['nama_produk']); ?></div>
          <div class="pcard-desc">Racikan spesial Dare Coffee</div>
          <div class="pcard-footer">
            <div class="pcard-price">
              <small>Mulai dari</small>
              Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
            </div>

            <?php if(isset($_SESSION['admin'])): ?>
              <div style="display:flex;gap:6px">
                <a href="admin/produk_edit.php?id=<?= $p['id_produk']; ?>" class="btn-edit-card">✏️ Edit</a>
                <a href="admin/produk_delete.php?id=<?= $p['id_produk']; ?>"
                   class="btn-del-card"
                   onclick="return confirm('Hapus produk ini?')">🗑</a>
              </div>

            <?php elseif(isset($_SESSION['user'])): ?>
              <?php if($stok > 0): ?>
                <form method="post" action="keranjang_add.php">
                  <input type="hidden" name="id_produk" value="<?= $p['id_produk']; ?>">
                  <button type="submit" class="btn-add-cart">🛒 Beli</button>
                </form>
              <?php else: ?>
                <span class="btn-login-buy" style="opacity:.5;cursor:not-allowed">Habis</span>
              <?php endif; ?>

            <?php else: ?>
              <a href="login.php" class="btn-login-buy">Masuk → Beli</a>
            <?php endif; ?>

          </div>
        </div>
      </div>
    <?php endwhile; endif; ?>
  </div>

</div>

<!-- FLOATING CART (user only) -->
<?php if(isset($_SESSION['user'])): ?>
<a href="keranjang.php" class="fab-cart">🛒 &nbsp;Lihat Keranjang</a>
<?php endif; ?>

<!-- FOOTER -->
<footer>
  <strong>Dare Coffee</strong> &nbsp;·&nbsp; surganya pecinta kopi &nbsp;·&nbsp; &copy; 2025
</footer>

<script>
  /* Filter tabs */
  const tabs = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('.pcard');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const cat = tab.dataset.cat;
      cards.forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
      });
    });
  });
</script>

</body>
</html>