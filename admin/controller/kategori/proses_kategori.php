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

$_nama = $_POST['nama'];

$_proses = $_POST['proses'];


// array data
$ar_data[] = $_nama; // ? 2

if ($_proses == "Simpan") {
   // data baru
   $sql = "INSERT INTO kategori_produk (nama) VALUES (?)";
} else if ($_proses == "Ubah") {
   $ar_data[] = $idedit; // ? 8
   $sql = "UPDATE kategori_produk SET nama=? WHERE id=?";
}
if (isset($sql)) {
   $st = $dbh->prepare($sql);
   $st->execute($ar_data);
}


header('location:../../kelola_kategori.php?success='.$queryLabel);
?>