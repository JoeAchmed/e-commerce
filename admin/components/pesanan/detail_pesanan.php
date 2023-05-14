<!-- Detail Produk Modal -->
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="callout callout-info">
                  <h5><i class="fas fa-info"></i> Deskripsi Pesanan:</h5>
                  <span id="deskripsi_pesanan"></span>
                </div>

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-12">
                      <h4 class="text-bold">
                        <img src="../assets/img/logo.png" alt="Logo Molla" width="80">
                        <small class="float-right detail_tanggal_pesanan"></small>
                      </h4>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- info row -->
                  <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      From
                      <address>
                        <strong>Admin, Inc.</strong><br>
                        Jl. Bintara 14, No. 61<br>
                        Kota Bekasi, ZIP 17134<br>
                        Phone: (+62)812-7106-2214<br>
                        Email: info@molla.com
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      To
                      <address>
                        <strong id="detail_nama_pemesan"></strong><br>
                        <span id="detail_alamat_pemesan"></span><br>
                        Phone: <span id="detail_no_hp"></span><br>
                        Email: <span id="email_pemesan"></span>
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      Order ID: <strong id="detail_order_id"></strong><br>
                      Tanggal Order: <strong class="detail_tanggal_pesanan"></strong><br>
                      Akun: <strong>968-34567</strong>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <!-- Table row -->
                  <div class="row">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Jumlah</th>
                            <th>Produk</th>
                            <th>Kode Produk #</th>
                            <th>Deskripsi</th>
                            <th>Harga Jual</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="detail_jumlah_pesanan"></td>
                            <td id="nama_produk"></td>
                            <td id="kode_produk"></td>
                            <td id="kategori_produk"></td>
                            <td id="harga_jual"></td>
                            <td class="subtotal"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                      <p class="lead">Metode Pembayaran:</p>
                      <img src="dist/img/credit/visa.png" alt="Visa">
                      <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                      <img src="dist/img/credit/american-express.png" alt="American Express">
                      <img src="dist/img/credit/paypal2.png" alt="Paypal">
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <p class="lead">Tanggal Pembayaran 2/22/2014</p>

                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td class="subtotal"></td>
                          </tr>
                          <tr>
                            <th>Harga Beli x Qty (<b class="detail_jumlah_pesanan"></b>)</th>
                            <td id="total_harga_beli"></td>
                          </tr>
                          <tr>
                            <th>Total Keuntungan:</th>
                            <td id="total_keuntungan"></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.invoice -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script>
  function handleGetOrderDetail(payload) {
    var order = JSON.parse(payload);

    var subtotal = order.harga_jual * order.jumlah_pesanan;
    var total_harga_beli = order.harga_beli * order.jumlah_pesanan;
    // Set value pemesan
    document.getElementsByClassName("detail_tanggal_pesanan")[0].textContent = "Date: " + formatDate(order.tanggal);
    document.getElementsByClassName("detail_tanggal_pesanan")[1].textContent = formatDate(order.tanggal);
    document.getElementById("detail_order_id").textContent = "#" + order.order_id;
    document.getElementById("deskripsi_pesanan").textContent = order.deskripsi;
    document.getElementById("detail_nama_pemesan").textContent = order.nama_pemesan;
    document.getElementById("detail_alamat_pemesan").textContent = order.alamat_pemesan;
    document.getElementsByClassName("detail_jumlah_pesanan")[0].textContent = order.jumlah_pesanan;
    document.getElementsByClassName("detail_jumlah_pesanan")[1].textContent = order.jumlah_pesanan;
    document.getElementById("detail_no_hp").textContent = order.no_hp;
    document.getElementById("email_pemesan").textContent = order.email;

    // Set value produk
    document.getElementById("nama_produk").textContent = order.nama_produk;
    document.getElementById("kode_produk").textContent = order.kode_produk;
    document.getElementById("kategori_produk").textContent = order.kategori_produk;
    document.getElementById("harga_jual").textContent = "Rp " + (order.harga_jual).toLocaleString("ID");
    document.getElementsByClassName("subtotal")[0].textContent = "Rp " + (subtotal).toLocaleString("ID");
    document.getElementsByClassName("subtotal")[1].textContent = "Rp " + (subtotal).toLocaleString("ID");
    document.getElementById("total_harga_beli").textContent = "Rp " + (total_harga_beli).toLocaleString("ID");
    document.getElementById("total_keuntungan").textContent = "Rp " + (subtotal - total_harga_beli).toLocaleString("ID");
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
</script>