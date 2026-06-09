<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran</title>

<style>
*{
  box-sizing:border-box;
  font-family:'Segoe UI',sans-serif;
}

body{
  background:#f6f1ec;
  background-image:url("img/coffee-bg.png"); /* opsional */
  background-size:120px;
  background-repeat:repeat;
}

.card{
  max-width:380px;
  margin:60px auto;
  background:#fff;
  border-radius:14px;
  padding:26px;
  box-shadow:0 8px 25px rgba(0,0,0,.12);
}

.card h2{
  text-align:center;
  color:#4b2e2e;
  margin-bottom:6px;
}

.card p{
  text-align:center;
  font-size:13px;
  color:#777;
  margin-bottom:22px;
}

.pay-btn{
  width:100%;
  height:52px;
  border-radius:12px;
  font-size:15px;
  font-weight:600;
  display:flex;
  align-items:center;
  justify-content:center;
  text-decoration:none;
  border:none;
  cursor:pointer;
  transition:.25s;
}

.pay-btn:not(:last-child){
  margin-bottom:14px;
}

.wa{
  background:#25D366;
  color:#fff;
}

.wa:hover{
  background:#1eb958;
}

.qris{
  background:#3e2723;
  color:#fff;
}

.qris:hover{
  background:#2d1a17;
}

#qrisBox{
  display:none;
  margin-top:20px;
  text-align:center;
  animation:fade .3s;
}

#qrisBox img{
  width:210px;
  border-radius:10px;
  box-shadow:0 4px 10px rgba(0,0,0,.15);
}

#qrisBox p{
  margin-top:10px;
  font-size:13px;
  color:#555;
}

@keyframes fade{
  from{opacity:0;transform:translateY(-5px)}
  to{opacity:1;transform:translateY(0)}
}
</style>

</head>
<body>

<div class="card">
  <h2>Dare Coffee</h2>
  <p>Pilih metode pembayaran favoritmu</p>

  <a href="proses_wa.php" class="pay-btn wa">
    Bayar via WhatsApp
  </a>

  <button class="pay-btn qris" onclick="toggleQris()">
    Bayar via QRIS
  </button>

  <div id="qrisBox">
    <img src="img/qr.jpg">
    <p>Scan QRIS lalu kirim bukti pembayaran via WhatsApp</p>
  </div>
</div>

<script>
function toggleQris(){
  const q = document.getElementById('qrisBox');
  q.style.display = q.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>
