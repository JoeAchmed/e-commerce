<?php
require_once '../../../db_config/dbkoneksi.php';
?>

<?php

// Mendapatkan kode produk berdasarkan ID produk
if (isset($_GET['produk_id'])) {
  $produkId = $_GET['produk_id'];
  $sql = "SELECT kode FROM produk WHERE id = :produkId";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':produkId', $produkId);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $productCode = $result['kode'];

  // Mengirimkan kode produk ke JavaScript sebagai respon
  echo $productCode;
}
?>