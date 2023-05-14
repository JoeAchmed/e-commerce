<?php
require_once '../../../db_config/dbkoneksi.php';
?>
<?php
$currentQuery = $_SERVER['QUERY_STRING'];

// Parse the query string into an associative array
parse_str($currentQuery, $queryParams);

// Access individual query parameters
$idedit = $queryParams['idedit'];
$queryLabel = "create";

if (isset($idedit)) {
  $queryLabel = "update";
}

$_tanggal = date("Y-m-d");
$_nama_pemesan = $_POST['nama_pemesan'];
$_alamat_pemesan = $_POST['alamat_pemesan'];
$_no_hp = $_POST['no_hp'];
$_email = $_POST['email'];
$_jumlah_pesanan = $_POST['jumlah_pesanan'];
$_deskripsi = $_POST['deskripsi'];
$_produk_id = $_POST['produk_id'];
$_order_id = $_POST['id_order'];

$_proses = $_POST['proses'];

// array data
$ar_data[] = $_tanggal;
$ar_data[] = $_nama_pemesan;
$ar_data[] = $_alamat_pemesan;
$ar_data[] = $_no_hp;
$ar_data[] = $_email;
$ar_data[] = $_jumlah_pesanan;
$ar_data[] = $_deskripsi;
$ar_data[] = $_produk_id;
$ar_data[] = $_order_id;

if ($_proses == "Simpan") {
  // data baru
  $sql = "INSERT INTO pesanan (tanggal,nama_pemesan,alamat_pemesan,no_hp,
     email,jumlah_pesanan,deskripsi,produk_id,order_id) VALUES (?,?,?,?,?,?,?,?,?)";
} else if ($_proses == "Ubah") {
  $_tanggal = $_POST['tanggal'];

  $ar_data[] = $idedit; // ? 8
  $sql = "UPDATE pesanan SET tanggal=?,nama_pemesan=?,alamat_pemesan=?,
     no_hp=?,email=?,jumlah_pesanan=?,deskripsi=?,produk_id=?,order_id=? WHERE id=?";
}

// Mengurangi jumlah stok produk
$sql_kurangi_stok = "UPDATE produk SET stok = stok - ? WHERE id = ?";

if (isset($sql)) {
  $st = $dbh->prepare($sql);
  $st_kurangi_stok = $dbh->prepare($sql_kurangi_stok);
  
  $st->execute($ar_data);
  $st_kurangi_stok->execute([$_jumlah_pesanan, $_produk_id]);
}

header('location:../../kelola_pesanan.php?success=' . $queryLabel);
?>