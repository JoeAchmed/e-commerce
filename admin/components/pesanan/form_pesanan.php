<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="form-proses" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body pt-0">

            <div class="form-group d-none" id="order_id_form">
              <label for="id_order" class="col-form-label">Order ID</label>
              <input required id="id_order" name="id_order" type="text" class="form-control" value="" readonly>
            </div>

            <div id="tanggal_form" class="form-group d-none">
              <label>Date:</label>
              <input type="date" id="tanggal" name="tanggal" class="form-control datetimepicker-input" />
            </div>

            <div class="form-group">
              <label for="nama_pemesan" class="col-form-label">Nama Pemesan</label>
              <input required id="nama_pemesan" name="nama_pemesan" type="text" class="form-control" value="" placeholder="Contoh: John Doe">
            </div>

            <div class="form-group">
              <label for="alamat_pemesan" class="col-form-label">Alamat Pemesan</label>
              <input required id="alamat_pemesan" name="alamat_pemesan" type="text" class="form-control" value="" placeholder="Contoh: Jl.Bintara Raya, No.21">
            </div>

            <div class="form-group">
              <label for="no_hp" class="col-form-label">Nomor HP</label>
              <input required id="no_hp" name="no_hp" type="text" class="form-control" value="" placeholder="Contoh: 08123456789">
            </div>

            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input required id="email" name="email" value="" type="email" class="form-control" placeholder="Contoh: john.doe@mail.com">
            </div>

            <div class="form-group">
              <label for="produk_id" class="col-form-label">Produk</label>
              <div>
                <?php
                $sqlproduk = "SELECT * FROM produk";
                $rsproduk = $dbh->query($sqlproduk);
                ?>
                <select required id="produk_id" name="produk_id" class="custom-select">
                  <option value="" disabled selected>Pilih Produk</option>

                  <?php
                  foreach ($rsproduk as $rowproduk) {
                  ?>
                    <option value="<?= $rowproduk['id'] ?>"><?= $rowproduk['nama'] ?></option>
                  <?php
                  }
                  ?>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="jumlah_pesanan" class="col-form-label">Jumlah Pesanan</label>
              <input required id="jumlah_pesanan" name="jumlah_pesanan" value="" type="number" class="form-control" placeholder="Contoh: 12">
              <p id="stok_remain_product" class="text-danger m-1"></p>
            </div>

            <div class="form-group">
              <label for="deskripsi" class="col-form-label">Deskripsi Pesanan</label>
              <textarea id="summernote" name="deskripsi" value="" class="form-control" placeholder="Contoh: Lebar layar 21 inch"></textarea>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <input type="submit" id="tambah" class="btn btn-primary" name="proses" value="Simpan" />
          <input type="submit" id="ubah" class="btn btn-success" name="proses" value="Ubah" />
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  var stok_tersedia = 0;

  function getPayloadDetailForUpdate(payload) {
    var order = JSON.parse(payload);

    console.log(order, "test json");
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Ubah Pesanan";

    // Menampilkan order_id_form & tanggal
    document.getElementById("order_id_form").classList.remove("d-none");
    document.getElementById("tanggal_form").classList.remove("d-none");

    // Set value pemesan
    document.getElementById("id_order").value = order.order_id;
    document.getElementById("tanggal").value = order.tanggal;
    document.getElementById("nama_pemesan").value = order.nama_pemesan;
    document.getElementById("alamat_pemesan").value = order.alamat_pemesan;
    document.getElementById("no_hp").value = order.no_hp;
    document.getElementById("email").value = order.email;
    document.getElementById("produk_id").value = order.produk_id;
    document.getElementById("jumlah_pesanan").value = order.jumlah_pesanan;

    // Set nilai pada summernote
    $('#summernote').summernote('code', order.deskripsi);


    // Menampilkan button ubah dan menyembunyikan button simpan
    document.getElementById("ubah").classList.remove("d-none");
    document.getElementById("tambah").classList.add("d-none");

    // Mengatur render action untuk proses update
    document.getElementById("form-proses").action = "controller/pesanan/proses_pesanan.php?idedit=" + order.id;
  }

  function addOrder(payload) {
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Tambah Pesanan";
    handleStokProduct();

    // Hide order_id_form
    document.getElementById("order_id_form").classList.add("d-none");
    document.getElementById("tanggal_form").classList.add("d-none");

    // Set value pemesan
    document.getElementById("tanggal").value = null;
    document.getElementById("nama_pemesan").value = null;
    document.getElementById("alamat_pemesan").value = null;
    document.getElementById("no_hp").value = null;
    document.getElementById("email").value = null;
    document.getElementById("produk_id").value = "";
    document.getElementById("jumlah_pesanan").value = null;

    // Set nilai pada summernote
    $('#summernote').summernote('code', "");

    // Menampilkan button simpan dan menyembunyikan button ubah
    document.getElementById("ubah").classList.add("d-none");
    document.getElementById("tambah").classList.remove("d-none");

    // Mengatur render action untuk proses create
    document.getElementById("form-proses").action = "controller/pesanan/proses_pesanan.php";
  }

  function formatDate(dateString) {
    // Create a new Date object from the input date string
    var date = new Date(dateString);

    // Get the day, month, and year components
    var day = date.getDate();
    var month = date.getMonth() + 1; // Month index is zero-based
    var year = date.getFullYear();

    // Pad single-digit day or month with leading zero if needed
    if (day < 10) {
      day = '0' + day;
    }
    if (month < 10) {
      month = '0' + month;
    }

    // Assemble the formatted date string
    var formattedDate = day + '/' + month + '/' + year;

    // Return the formatted date string
    return formattedDate;
  }

  /* Mengenerate order id start */
  // Fungsi untuk mendapatkan inisial nama
  function getInitialName() {
    var namaPemesan = document.getElementById("nama_pemesan").value.trim();
    var initialArray = namaPemesan.split(" ").map(function(word) {
      return word.charAt(0).toUpperCase();
    });
    var initialName = initialArray.join("");
    return initialName;
  }

  // Fungsi untuk mengirim permintaan ke server dan mendapatkan kode produk
  function getProductCode() {
    handleStokProduct();

    var produkId = document.getElementById("produk_id").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "controller/pesanan/get_product_code.php?produk_id=" + produkId, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var productCode = xhr.responseText;

        generateOrderId(productCode);
      }
    };
    xhr.send();
  }

  // Fungsi untuk menghasilkan Order ID
  function generateOrderId(productCode) {
    var initialName = getInitialName();
    var orderId = "SF" + initialName + productCode;
    document.getElementById("id_order").value = orderId;
  }

  /* Mengenerate order id end */

  // Mengatur stok pesanan
  function handleStokProduct() {
    var produkId = document.getElementById("produk_id").value;
    var jumlahPesanan = document.getElementById("jumlah_pesanan");
    var alertStokHabis = document.getElementById("stok_remain_product");
    var jumlah = Number(jumlahPesanan.value || 0);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "controller/pesanan/get_stock_product.php?produk_id=" + produkId, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var stokProduk = Number(xhr.responseText);
        jumlahPesanan.removeAttribute("disabled");

        if (stokProduk === 0 && Boolean(jumlah)) {
          alertStokHabis.innerHTML = "Stok produk yang kamu pilih habis. Silakan pilih produk lainnya !";
          jumlahPesanan.setAttribute("disabled", true);
          jumlahPesanan.value = null;
          return;
        }

        if (jumlah > stokProduk) {
          alertStokHabis.innerHTML = `Stok produk yang kamu pilih hanya tersisa ${stokProduk} item. Masukkan jumlah kurang dari itu !`;
          jumlahPesanan.value = null;
          return;
        }

        alertStokHabis.innerHTML = "";
      }
    };
    xhr.send();
  }


  // Menambahkan event listener pada input nama pemesan
  document.getElementById("nama_pemesan").addEventListener("input", getProductCode);

  // Menambahkan event listener pada input pilihan produk
  document.getElementById("produk_id").addEventListener("change", getProductCode);

  // Mengatur jumlah pesanan
  document.getElementById("jumlah_pesanan").addEventListener("input", handleStokProduct);

</script>