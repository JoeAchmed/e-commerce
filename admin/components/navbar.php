<?php
$sql = 'SELECT COUNT(*) AS jumlah_pesanan
          FROM pesanan
          WHERE tanggal >= CURDATE() - INTERVAL 1 DAY
            AND tanggal < CURDATE();
          ';
$count_order = $dbh->query($sql);

if (!$count_order) {
  echo $dbh->errorInfo(); // Display any database errors
  echo $sql; // Display the actual SQL query
}

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav d-flex align-items-center">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="kelola_pesanan.php">
        <i class="far fa-bell fa-lg"></i>
        <span class="badge badge-warning navbar-badge"><?= $count_order || 0 ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?= $count_order || 0 ?> Notifikasi</span>
        <div class="dropdown-divider"></div>
        <a href="kelola_pesanan.php" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> <?= $count_order || 0 ?> Pesanan Baru
          <span class="float-right text-muted text-sm">1 Hari</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="kelola_pesanan.php" class="dropdown-item dropdown-footer">Lihat Pesanan</a>
      </div>
    </li>
  </ul>

  <ul class="navbar-nav">
    <!-- Profile Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        <i class="far fa-user-circle fa-lg mr-2"></i>
        <span>Admin</span>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a href="../customer/index.php" class="nav-link d-flex align-items-center">
          <i class="nav-icon fas fa-sign-out-alt mr-2"></i>
          <span>
            Logout
          </span>
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->