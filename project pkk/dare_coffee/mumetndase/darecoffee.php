<a href="produk.php">📦 Kelola Produk</a>
<?php include "koneksi.php";?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dare Coffee</title>
  <style>
    /* ===== Global / Layout (mirip kode awal) ===== */
    :root{
      --bg:#f7f7f7;
      --dark:#222;
      --accent:orange;
      --panel:#f1f1f1;
      --green:#1b9a3a;
      --form-bg:#2a2a2a;
      --footer:#111;
    }
    *{box-sizing:border-box}
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: var(--bg);
      color: #333;
    }
    header {
      background: var(--dark);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      color: white;
    }
    header h1 {
      font-size: 22px;
      color: var(--accent);
      margin:0;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
    }
    nav a:hover {
      color: var(--accent);
    }

    /* Hero (sama) */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 50px;
      background: url('https://lh3.googleusercontent.com/p/AF1QipMKSRQ7hh5paJ_ex8UGJXfE_yJLszgSrmiNUskY=s1360-w1360-h1020-rw') no-repeat center center/cover;
      color: white;
    }
    .hero-text {
      max-width: 55%;
    }
    .hero-text h2 {
      font-size: 54px;
      margin: 0 0 10px 0;
      letter-spacing:1px;
    }
    .hero-text h2 span { color: var(--accent); }
    .hero-text p {
      margin: 15px 0 25px 0;
      max-width: 80%;
      line-height:1.6;
    }
    .hero-text button {
      padding: 12px 22px;
      border: none;
      border-radius: 6px;
      background: var(--accent);
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    .hero-text button:hover{ background:#ff9900 }
    .hero-img img{ border-radius:20px; max-width:320px; width:100%; display:block; }

    /* Menu Section (style preserved) */
    .menu {
      padding: 50px 20px;
      background: #fff;
      text-align: center;
    }
    .menu h2 {
      color: #333;
      margin-bottom: 30px;
      font-size:28px;
    }
    .menu-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1100px;
      margin: auto;
    }
    .card {
      background: var(--panel);
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 8px 14px rgba(0,0,0,0.06);
      transition: transform 0.25s;
      display:flex;
      flex-direction:column;
    }
    .card:hover { transform: translateY(-6px); }
    .card img {
      width:100%;
      border-radius: 12px;
      object-fit:cover;
      height: 220px;
    }
    .card h3 {
      margin: 15px 0 6px;
      color: #222;
    }
    .card p {
      font-size: 14px;
      color: #555;
      flex:1;
    }
    .price {
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0;
      color: var(--green);
    }
    .stock {
      color: #666;
      font-size:13px;
      margin-bottom:8px;
    }
    .card .btn-row{
      margin-top:10px;
      display:flex;
      gap:10px;
      justify-content:center;
    }
    .card button {
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      background: var(--accent);
      color: white;
      cursor: pointer;
    }
    .card button[disabled]{
      background:#ccc; cursor:not-allowed;
    }

    /* Keranjang floating button & modal */
    #cart {
      position: fixed;
      right: 20px;
      bottom: 20px;
      background: var(--accent);
      color: white;
      border: none;
      border-radius: 50px;
      width: 60px;
      height: 60px;
      font-size: 22px;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(0,0,0,0.25);
      display:flex;
      align-items:center;
      justify-content:center;
    }
    #cart .count {
      position: absolute;
      top:6px; right:6px;
      background:#222; color:white;
      width:20px; height:20px; border-radius:50%;
      display:flex; align-items:center; justify-content:center;
      font-size:12px;
    }
    .cart-modal {
      position: fixed;
      top: 0; left: 0; width:100%; height:100%;
      background: rgba(0,0,0,0.6);
      display: none;
      align-items: center; justify-content:center;
      padding:20px;
    }
    .cart-content {
      background: #fff;
      border-radius: 10px;
      width: 100%;
      max-width: 700px;
      padding: 20px;
      max-height: 80vh;
      overflow:auto;
    }
    .cart-item{
      display:flex; align-items:center; justify-content:space-between;
      gap:10px; border-bottom:1px solid #eee; padding:12px 0;
    }
    .cart-item .left{
      display:flex; gap:12px; align-items:center;
    }
    .cart-item img{ width:64px; height:48px; object-fit:cover; border-radius:6px;}
    .cart-item .qty-control button{
      padding:6px 9px; margin:0 4px; border-radius:6px; border:none; cursor:pointer;
    }
    .cart-total{ text-align:right; font-weight:bold; margin-top:12px; }

    .cart-buttons { text-align:right; margin-top:12px; }
    .cart-buttons button{ padding:10px 14px; margin-left:8px; border-radius:6px; border:none; cursor:pointer;}
    .checkout-btn{ background: #1b9a3a; color:white; }

    /* Order form (match screenshot: dark section, centered form) */
    .order {
      padding: 50px;
      background: var(--form-bg);
      text-align: center;
      color: white;
      display: none; /* tampilkan saat checkout */
    }
    .order h2 { color: var(--accent); margin-bottom:18px; font-size:26px; }
    .form-card {
      margin: 0 auto; max-width: 700px; text-align:left;
      background: transparent;
    }
    form label{ display:block; margin:10px 0 6px; }
    form input, form textarea, form select {
      width:100%;
      padding:12px;
      border-radius:6px;
      border: none;
      font-size:14px;
      background:#fff;
      color:#222;
    }
    form button.submit {
      margin-top: 18px;
      padding: 14px;
      width:100%;
      background: var(--accent);
      color:white;
      border:none;
      border-radius:8px;
      font-size:16px;
      cursor:pointer;
    }
    .order .small-note{ color:#ddd; font-size:13px; margin-top:8px; }

    footer {
      background: var(--footer);
      text-align: center;
      padding: 15px;
      margin-top: 30px;
      font-size: 14px;
      color: white;
    }

    /* Responsive tweaks */
    @media (max-width:800px){
      .hero{ padding:30px; flex-direction:column; gap:20px; align-items:flex-start; }
      .hero-img img{ max-width:260px; }
      .card img{ height:180px; }
      .menu-container{ padding:0 12px; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Dare Coffee</h1>
    <nav>
      <a href="#">Home</a>
      <a href="#menu" onclick="document.getElementById('menu').scrollIntoView({behavior:'smooth'})">Menu</a>
      <a href="#order" id="navOrder" onclick="showOrderFromNav(event)">Order</a>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-text">
      <h2>DARE <span>COFFEE</span></h2>
      <p>Rasakan kenikmatan kopi terbaik dengan kualitas premium dan cita rasa khas Dare Coffee.</p>
      <button onclick="document.getElementById('menu').scrollIntoView({behavior:'smooth'})">Lihat Menu</button>
    </div>
    <div class="hero-img">
      <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13" alt="coffee" />
    </div>
  </section>

  <!-- Menu -->
  <section class="menu" id="menu">
    <h2>Menu Kopi Kami</h2>
    <div class="menu-container" id="menuContainer">
      <!-- Kartu produk akan di-generate oleh JS -->
    </div>
  </section>

  <!-- Keranjang floating -->
  <button id="cart" title="Lihat Keranjang">🛒 <span class="count" id="cartCount">0</span></button>

  <!-- Modal Keranjang -->
  <div class="cart-modal" id="cartModal">
    <div class="cart-content">
      <h2>Keranjang Belanja</h2>
      <div id="cartItems"></div>
      <div class="cart-total" id="cartTotal">Total: Rp0</div>
      <div class="cart-buttons">
        <button onclick="tutupCart()">Tutup</button>
        <button class="checkout-btn" onclick="checkout()">Checkout</button>
      </div>
    </div>
  </div>

  <!-- Order Section (form hitam sesuai screenshot) -->
  <section class="order" id="order">
    <h2>Form Pemesanan Kopi</h2>
    <div class="form-card">
      <form id="orderForm" onsubmit="kirimPesanan(); return false;">
        <label>Nama Lengkap</label>
        <input type="text" id="nama" placeholder="Masukkan nama Anda" required>

        <label>Nomor HP</label>
        <input type="tel" id="hp" placeholder="Contoh: 08xxxxxxxxxx" required>

        <label>Alamat Lengkap</label>
        <textarea id="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda" required></textarea>

        <label>Metode Pemesanan</label>
        <select id="metode">
          <option value="Ambil di tempat">Ambil di tempat</option>
          <option value="Antar">Antar</option>
        </select>

        <label>Catatan Tambahan</label>
        <textarea id="catatan" rows="3" placeholder="Contoh: tanpa gula, ekstra susu..."></textarea>

        <div class="small-note">Ringkasan pesanan akan dikirim ke WhatsApp setelah tombol "Kirim Pesanan".</div>

        <button class="submit" type="submit">Kirim Pesanan</button>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Dare Caffe. All rights reserved.</p>
  </footer>

<script>
/* ====== Konfigurasi ====== */
const WA_NUMBER = "6285166458392"; // ubah jika perlu

/* ====== Data produk (lengkap sesuai kode awal) ======
   tiap produk memiliki: id, nama, harga (angka), stok, img
*/
const produkList = [
  {id:1, nama:"Tubruk", harga:25000, stok:10, img:"https://dcostseafood.id/wp-content/uploads/2022/03/Kopi-Tubruk.jpg"},
  {id:2, nama:"Americano", harga:28000, stok:8, img:"https://miro.medium.com/v2/resize:fit:1100/format:webp/1*6eQJzYpORcnTJp8k5iHq7Q.jpeg"},
  {id:3, nama:"Filter", harga:18000, stok:12, img:"https://i.pinimg.com/1200x/8a/50/9e/8a509e80a255b25b54774a4437debf0e.jpg"},
  {id:4, nama:"Kopi Sikak", harga:26000, stok:9, img:"https://www.brighteyedbaker.com/wp-content/uploads/2025/05/Creamy-Coffee-Soda.jpg"},
  {id:5, nama:"Vietnam Drip", harga:30000, stok:7, img:"https://img-global.cpcdn.com/recipes/6d31e574e394ab79/680x781cq80/vietnam-drip-coffee-foto-resep-utama.jpg"},
  {id:6, nama:"Kopsu Aren", harga:22000, stok:6, img:"https://d1r9hss9q19p18.cloudfront.net/uploads/2020/03/OEANG-6.jpg"},
  {id:7, nama:"Kopsu Kelapa", harga:27000, stok:10, img:"https://coffeeland.co.id/wp-content/uploads/2021/06/e12fac35f7e823bc32ed973e03aafce2.jpg"},
  {id:8, nama:"Kopsu Banana", harga:24000, stok:11, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxfHQK1Qekq27u6l3pMseNFwfEJ-Rf99bkLA&s"},
  {id:9, nama:"Latte", harga:29000, stok:8, img:"https://i.pinimg.com/1200x/a8/75/bd/a875bd2ef9ed3b4bd08b0120750ea915.jpg"},
  {id:10, nama:"Lemon Mojito", harga:20000, stok:14, img:"https://i.pinimg.com/1200x/35/4e/98/354e9821e13b93d8f1f83b8d1b33a536.jpg"},
  {id:11, nama:"Lemon Tea", harga:30000, stok:6, img:"https://i.pinimg.com/1200x/8f/fc/9e/8ffc9e0ef080db4b4dc3b33b377dfcf8.jpg"},
  {id:12, nama:"Leci Tea", harga:32000, stok:5, img:"https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3"},
  {id:13, nama:"Chocolate Latte", harga:28000, stok:7, img:"https://i.pinimg.com/1200x/21/96/e8/2196e8c9c4b892e429e48f8717276f81.jpg"},
  {id:14, nama:"Choco Banana Latte", harga:25000, stok:6, img:"https://image.idntimes.com/post/20250714/1000053529_3490d052-0df4-490d-a06d-eed845678f05.jpg"},
  { id:15, nama:"Matcha Latte", harga:27000, stok:9, img:"https://images.unsplash.com/photo-1584539565553-24bbee2b96c4?q=80&w=600&fit=crop"},
{ id:16, nama:"Kombucha", harga:25000, stok:10, img:"https://images.unsplash.com/photo-1612197989954-9b40f2ebbee1?q=80&w=600&fit=crop"}


 ];

/* ====== State Keranjang ====== */
let cart = []; // array item {id,nama,harga,jumlah,img}

/* ====== Render produk ke halaman (tampilan seperti kode pertama) ====== */
const menuContainer = document.getElementById('menuContainer');

function renderProduk(){
  menuContainer.innerHTML = '';
  produkList.forEach(p=>{
    // tampilan stok: jika 0 maka disable button
    const disabled = p.stok <= 0 ? 'disabled' : '';
    const stokText = p.stok <= 0 ? 'Stok habis' : `Stok: ${p.stok}`;
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <img src="${p.img}" alt="${p.nama}">
      <h3>${p.nama}</h3>
      <p>${escapeHtml(p.namaDescription || getDefaultDescription(p.nama))}</p>
      <div class="price">Rp${numberWithDots(p.harga)}</div>
      <div class="stock">${stokText}</div>
      <div class="btn-row">
        <button ${disabled} onclick="tambahKeCart(${p.id})">Pesan</button>
      </div>
    `;
    menuContainer.appendChild(card);
  });
}
function getDefaultDescription(name){
  // fallback description mirip kode awal (sederhana)
  return {
    "Tubruk": "Kopi hitam tradisional khas Indonesia dengan rasa kuat dan pekat.",
    "Americano": "Espresso yang dicampur dengan air panas, ringan namun tetap kuat rasa kopinya.",
    "Filter": "Kopi disaring secara manual untuk menghasilkan cita rasa yang jernih dan halus.",
    "Kopi Sikak": "Minuman yang menggabungkan rasa kopi dengan kesegaran air berkarbonasi atau soda.",
    "Vietnam Drip": "Kopi khas Vietnam yang diseduh perlahan dengan rasa kuat dan manis.",
    "Kopsu Aren": "Kopi susu dengan tambahan gula aren alami, manis dan beraroma khas.",
    "Kopsu Kelapa": "Kopi susu dengan campuran santan kelapa yang gurih dan creamy.",
    "Kopsu Banana": "Kopi susu dengan rasa pisang yang unik dan menyegarkan.",
    "Latte": "Perpaduan espresso dan susu steamed yang lembut, cocok untuk semua kalangan.",
    "Lemon Mojito": "Minuman menyegarkan dengan lemon, soda, dan daun mint.",
    "Lemon Tea": "Teh segar dengan rasa lemon yang asam-manis, cocok diminum dingin.",
    "Leci Tea": "Minuman teh fermentasi yang segar dengan rasa asam manis alami.",
    "Chocolate Latte": "Campuran kopi dan cokelat yang creamy, cocok untuk pecinta rasa manis.",
    "Choco Banana Latte": "Latte manis dengan kombinasi cokelat dan pisang.",
    "Matcha Latte": "Kopi susu creamy dengan sirup pandan yang harum dan unik.",
    "Kombucha": "Perpaduan kopi dan lemonade yang asam segar, cocok untuk cuaca panas."
  }[name] || "";
}

/* ====== Utilities ====== */
function numberWithDots(x){
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
function escapeHtml(text){
  if(!text) return '';
  return text.replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

/* ====== Keranjang: tambah, ubah, hapus ====== */
function tambahKeCart(id){
  const produk = produkList.find(p=>p.id===id);
  if(!produk) return;
  if(produk.stok <= 0){ alert('Stok habis!'); return; }

  const existing = cart.find(i=>i.id===id);
  if(existing){
    existing.jumlah++;
  } else {
    cart.push({ id:produk.id, nama:produk.nama, harga:produk.harga, jumlah:1, img:produk.img });
  }
  produk.stok--; // kurangi stok global
  renderProduk();
  updateCartUI();
}

function ubahJumlahCart(id, delta){
  const item = cart.find(i=>i.id===id);
  const produk = produkList.find(p=>p.id===id);
  if(!item || !produk) return;
  if(delta > 0){
    if(produk.stok <= 0){ alert('Stok habis!'); return; }
    item.jumlah++; produk.stok--;
  } else {
    if(item.jumlah > 1){
      item.jumlah--; produk.stok++;
    } else {
      // jika jumlah jadi 0 maka hapus
      hapusDariCart(id);
      return;
    }
  }
  renderProduk();
  updateCartUI();
}

function hapusDariCart(id){
  const item = cart.find(i=>i.id===id);
  if(!item) return;
  // kembalikan stok
  const produk = produkList.find(p=>p.id===id);
  if(produk) produk.stok += item.jumlah;
  cart = cart.filter(i=>i.id!==id);
  renderProduk();
  updateCartUI();
}

/* ====== Update UI Keranjang (modal) ====== */
const cartCountEl = document.getElementById('cartCount');
const cartModal = document.getElementById('cartModal');
const cartItemsEl = document.getElementById('cartItems');
const cartTotalEl = document.getElementById('cartTotal');

function updateCartUI(){
  // count
  const totalCount = cart.reduce((s,i)=>s+i.jumlah,0);
  cartCountEl.innerText = totalCount;
  // items
  cartItemsEl.innerHTML = '';
  let totalPrice = 0;
  if(cart.length === 0){
    cartItemsEl.innerHTML = '<p>Keranjang kosong.</p>';
  } else {
    cart.forEach(it=>{
      const sub = it.harga * it.jumlah;
      totalPrice += sub;
      const node = document.createElement('div');
      node.className = 'cart-item';
      node.innerHTML = `
        <div class="left">
          <img src="${it.img}" alt="${it.nama}">
          <div>
            <div style="font-weight:bold">${it.nama}</div>
            <div style="font-size:13px;color:#666">Rp${numberWithDots(it.harga)} x ${it.jumlah} = Rp${numberWithDots(sub)}</div>
          </div>
        </div>
        <div class="right">
          <div class="qty-control" style="display:flex;align-items:center;">
            <button onclick="ubahJumlahCart(${it.id},1)">+</button>
            <button onclick="ubahJumlahCart(${it.id},-1)">-</button>
            <button style="background:#e74c3c;color:#fff;border:none;padding:6px 8px;border-radius:6px;margin-left:8px;" onclick="hapusDariCart(${it.id})">Hapus</button>
          </div>
        </div>
      `;
      cartItemsEl.appendChild(node);
    });
  }
  cartTotalEl.innerText = 'Total: Rp' + numberWithDots(totalPrice);
}

/* ====== Event: buka / tutup cart ====== */
document.getElementById('cart').addEventListener('click', ()=> {
  cartModal.style.display = 'flex';
  updateCartUI();
});
function tutupCart(){
  cartModal.style.display = 'none';
}

/* tutup modal bila klik di luar content */
cartModal.addEventListener('click', (e)=>{
  if(e.target === cartModal) tutupCart();
});

/* ====== Checkout -> tampilkan form (order section) ====== */
function checkout(){
  if(cart.length === 0){ alert('Keranjang kosong!'); return; }
  tutupCart();
  // tampilkan section order (mirip screenshot: form area gelap)
  document.getElementById('order').style.display = 'block';
  // scroll ke form
  document.getElementById('order').scrollIntoView({behavior:'smooth'});
}

/* klik nav Order */
function showOrderFromNav(e){
  e.preventDefault();
  // jika ada isi cart, tetap tunjukkan form. Jika tidak ada, juga boleh.
  document.getElementById('order').style.display = 'block';
  document.getElementById('order').scrollIntoView({behavior:'smooth'});
}

/* ====== Submit order -> kirim WA ====== */
function kirimPesanan(){
  if(cart.length === 0){ alert('Keranjang kosong! Tambahkan produk terlebih dahulu.'); return; }

  const nama = document.getElementById('nama').value.trim();
  const hp = document.getElementById('hp').value.trim();
  const alamat = document.getElementById('alamat').value.trim();
  const metode = document.getElementById('metode').value;
  const catatan = document.getElementById('catatan').value.trim();

  if(!nama || !hp || !alamat){ alert('Mohon lengkapi Nama, Nomor HP, dan Alamat.'); return; }

  // susun pesan
  let pesan = `Halo Dare Caffe!%0A%0APesan dari website:%0A`;
  cart.forEach(i=>{
    pesan += `- ${i.nama} x${i.jumlah} (Rp${numberWithDots(i.harga)})%0A`;
  });
  const total = cart.reduce((s,i)=>s + i.harga * i.jumlah, 0);
  pesan += `%0ATotal: Rp${numberWithDots(total)}%0A%0A`;
  pesan += `Nama: ${encodeURIComponent(nama)}%0A`;
  pesan += `HP: ${encodeURIComponent(hp)}%0A`;
  pesan += `Alamat: ${encodeURIComponent(alamat)}%0A`;
  pesan += `Metode: ${encodeURIComponent(metode)}%0A`;
  if(catatan) pesan += `Catatan: ${encodeURIComponent(catatan)}%0A`;

  // buka WA
  const url = `https://wa.me/${WA_NUMBER}?text=${pesan}`;
  window.open(url, '_blank');

  // setelah mengirim, kosongkan cart (simulasi) dan update UI
  cart = [];
  // reset stok? (kita sudah mengganti stok saat add/remove). Setelah checkout kita anggap sudah terproses.
  renderProduk();
  updateCartUI();
  // sembunyikan form & beri notifikasi singkat
  alert('Pesanan akan dikirim ke WhatsApp. Terima kasih!');
  document.getElementById('order').style.display = 'none';
}

/* ====== Inisialisasi ====== */
renderProduk();
updateCartUI();

</script>

</body>
</html>
