<?php
require_once '../db_config/dbkoneksi.php';

$sql = "SELECT produk.*, kategori_produk.nama AS kategori_produk
FROM produk
INNER JOIN kategori_produk ON produk.kategori_produk_id = kategori_produk.id";
$product = $dbh->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Molla Store | Menjual berbagai macam kebutuhan</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon-16x16.png">
  <link rel="shortcut icon" href="../assets/img/favicon.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Additional style -->
  <link rel="stylesheet" href="dist/css/additional-style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    require_once "./components/navbar.php";
    require_once "./components/sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid mb-4">
          <div class="row mb-2">
            <div class="col-sm-9">
              <h1 class="m-0">Kelola Produk</h1>
            </div><!-- /.col -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <!-- Modal -->
          <?php
          require_once "./components/produk/form_produk.php";
          require_once "./components/produk/detail_produk.php";
          ?>

          <div class="modal fade" id="confirm-delete">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-danger text-bold">Konfirmasi Hapus</h4>
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Data produk yang dihapus tidak dapat dikembalikan lagi. Anda yakin akan menghapus produk <span id="product-delete-name"></span> ?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i>
                    Tutup
                  </button>
                  <button type="button" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    <a id="iddel" style="text-decoration: none; color: inherit">
                      Hapus
                    </a>
                  </button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

          <!-- End Modal -->

          <div class="container-fluid">
            <div class="row">
              <div class="col-12">


                <!-- /.card -->
                <div class="card">

                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-sm-8 d-flex align-items-center">
                        <h4 class="m-0">Daftar Produk</h4>
                        <button type="button" class="btn btn-primary my-2 ml-4" data-toggle="modal" data-target="#modal-default" onclick="addProduct()">
                          <i class="fas fa-plus-circle mr-2"></i>
                          Tambah
                        </button>
                      </div>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr align="center">
                          <th>No</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
                          <th>Qty</th>
                          <th style="width: 20%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $nomor  = 1;
                        foreach ($product as $row) {
                        ?>
                          <tr>
                            <td align="center"><?= $nomor ?></td>
                            <td align="center"><?= $row['kode'] ?></td>
                            <td align="left"><?= $row['nama'] ?></td>
                            <td align="right"><?= 'Rp ' . number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                            <td align="right"><?= 'Rp ' . number_format($row['harga_jual'], 0, ',', '.'); ?></td>

                            <td align="center"><?= number_format($row['stok'], 0, ',', '.') ?></td>
                            <td align="center">
                              <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="handleGetProductDetail('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>')">
                                <i class="fas fa-eye"></i>
                                Detail
                              </a>
                              <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" onclick="getPayloadDetailForUpdate('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>')">
                                <i class="fas fa-edit"></i>
                                Ubah
                              </a>
                              <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" onclick="handleGetNameProduct('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>')">
                                <i class="fas fa-trash"></i>
                                Hapus
                              </a>
                            </td>
                          </tr>
                        <?php
                          $nomor++;
                        }
                        ?>
                      </tbody>
                    </table>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    </div>
    <!-- ./wrapper -->

    <?php
    require_once "./components/footer.php";
    ?>

    <script>
      // Get the current URL
      const url = new URL(window.location.href);

      // Get the URL search parameters
      const params = new URLSearchParams(url.search);

      // Get the value of a specific query parameter
      const success = params.get('success');
      const id = params.get('id');

      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });

        if (success) {
          Toast.fire({
            icon: 'success',
            title: `Sukses ${success === "create" ? "Tambah" : success === "update" ? "Ubah" : "Hapus"} Produk`,
            text: `Horee... Produk sukses ${success === "create" ? "ditambahkan" : success === "update" ? "diubah" : "dihapus"} !`
          });

          setTimeout(() => {
            // Remove a specific query parameter
            params.delete('success');

            // Update the URL without the deleted query parameter
            url.search = params.toString();

            // Replace the current URL with the updated URL
            window.history.replaceState(null, '', url.toString());
          }, 3000);
        }

      });

      function handleGetNameProduct(payload) {
        try {
          var row = JSON.parse(payload);
  
          // Akses properti row objek
          var nama = row.nama;
          var id = row.id;
  
          document.getElementById("product-delete-name").innerHTML = nama;
          document.getElementById("product-delete-name").classList.add("text-bold");
          document.getElementById("iddel").href = "controller/produk/hapus_produk.php?iddel=" + id;
        } catch (error) {
          console.log(error);
        }
      }
    </script>
</body>

</html>