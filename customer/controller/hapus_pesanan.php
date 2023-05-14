<?php 
require_once '../../db_config/dbkoneksi.php';

$currentQuery = $_SERVER['QUERY_STRING'];

// Parse the query string into an associative array
parse_str($currentQuery, $queryParams);

// Access individual query parameters
$iddel = $queryParams['iddel'];

// bikin query sql
$sql = "DELETE FROM pesanan WHERE id=?";
// siapin query
$st = $dbh->prepare($sql);
// eksekusi query
$st->execute([$iddel]);

header('location:../transactions.php?success=delete');
?>