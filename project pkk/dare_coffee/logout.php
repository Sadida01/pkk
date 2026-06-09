<?php
session_start();
session_unset();   // hapus semua session
session_destroy(); // hancurkan session
header("location:index.php");
exit;
