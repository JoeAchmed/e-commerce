 <?php
  $currentURL = $_SERVER['PHP_SELF'];
  $lowercaseUrl = strtolower($currentURL);
  ?>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index.php" class="brand-link">
     <img src="../assets/img/favicon.ico" alt="Molla Logo" class="brand-image" style="opacity: .8">
     <span class="brand-text text-uppercase">Molla Store</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">

     <!-- SidebarSearch Form -->
     <div class="form-inline mt-3 pb-3 mb-3 border-bottom">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="index.php" class="nav-link dashboard">
             <i class="nav-icon fas fa-home"></i>
             <p>
               Dashboard
             </p>
           </a>

         </li>
         <li class="nav-item">
           <a href="kelola_produk.php" class="nav-link kelola_produk">
             <i class="nav-icon fas fa-list"></i>
             <p>
               Kelola Produk
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="kelola_kategori.php" class="nav-link kelola_kategori">
             <i class="nav-icon fas fa-laptop"></i>
             <p>
               Kelola Kategori
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="kelola_pesanan.php" class="nav-link kelola_pesanan">
             <i class="nav-icon fas fa-shopping-cart"></i>
             <p>
               Kelola Pesanan
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>

 <script>
   let path = window.location.pathname;
   let dashboard = document.getElementsByClassName("dashboard");
   let kelola_produk = document.getElementsByClassName("kelola_produk");
   let kelola_pesanan = document.getElementsByClassName("kelola_pesanan");
   let kelola_kategori = document.getElementsByClassName("kelola_kategori");

   switch (path) {
     case "/project_uts/admin/index.php":
       dashboard[0].classList.add("active");
       kelola_produk[0].classList.remove("active");
       kelola_pesanan[0].classList.remove("active");
       break;
     case "/project_uts/admin/kelola_produk.php":
       dashboard[0].classList.remove("active");
       kelola_produk[0].classList.add("active");
       kelola_pesanan[0].classList.remove("active");
       break;
     case "/project_uts/admin/kelola_pesanan.php":
       dashboard[0].classList.remove("active");
       kelola_produk[0].classList.remove("active");
       kelola_pesanan[0].classList.add("active");
       break;
     default:
       break;
   }
 </script>