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

$_kode = $_POST['kode'];
$_nama = $_POST['nama'];
$_harga = $_POST['harga_beli'];
$_stok = $_POST['stok'];
$_minstok = $_POST['min_stok'];
$_kategori = $_POST['kategori'];
$_deskripsi = $_POST['deskripsi'];
$_image_produk = $_POST['image_produk'];

$_proses = $_POST['proses'];

// array data
$ar_data[] = $_kode; // ? 1
$ar_data[] = $_nama; // ? 2
$ar_data[] = $_harga; // 3
$ar_data[] = 1.2 * $_harga;
$ar_data[] = $_stok;
$ar_data[] = $_minstok;
$ar_data[] = $_deskripsi;
$ar_data[] = $_image_produk;
$ar_data[] = $_kategori; // ? 7

if ($_proses == "Simpan") {
   // data baru
   $sql = "INSERT INTO produk (kode,nama,harga_beli,harga_jual,stok,
    min_stok,deskripsi,image_produk,kategori_produk_id) VALUES (?,?,?,?,?,?,?,?,?)";
} else if ($_proses == "Ubah") {
   $ar_data[] = $idedit; // ? 8
   $sql = "UPDATE produk SET kode=?,nama=?,harga_beli=?,harga_jual=?,
    stok=?,min_stok=?,deskripsi=?,image_produk=?,kategori_produk_id=? WHERE id=?";
}
if (isset($sql)) {
   $st = $dbh->prepare($sql);
   $st->execute($ar_data);
}


header('location:../../kelola_produk.php?success='.$queryLabel);
?>