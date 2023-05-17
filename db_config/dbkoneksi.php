<?php 
  $host = 'localhost';
  // $db = 'dbpos';
  $db = 'db_ahma22291ti';
  // $user = 'root';
  $user = 'ahma22291ti';
  // $pass = '';
  $pass = '21610110222291';
  $charset='utf8mb4';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

  $opt = [
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false,
  ];

  $dbh =  new PDO($dsn,$user,$pass,$opt);

?>