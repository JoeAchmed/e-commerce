<!-- Detail Produk Modal -->
<div class="modal fade bg-yellow" id="modal-detail">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 80vw">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container-fluid row align-items-center">
          <h4 class="modal-title">Order Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body mt-2">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-12">
                      <h4 class="text-bold">
                        <img src="../assets/img/logo.png" alt="Logo Molla" width="80">
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
                      Order ID: <strong id="order_id"></strong><br>
                      Order Date: <strong class="tanggal_pesanan"></strong><br>
                      Account: <strong>968-34567</strong>
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
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Product Code #</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="detail_jumlah_pesanan px-3"></td>
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
                      <p class="lead">Payment Method:</p>
                      <figure class="footer-payments row">
                        <img src="assets/images/credit/visa.png" class="pr-2" alt="Visa">
                        <img src="assets/images/credit/mastercard.png" class="px-2" alt="Mastercard">
                        <img src="assets/images/credit/american-express.png" class="px-2" alt="American Express">
                        <img src="assets/images/credit/paypal2.png" class="px-2" alt="Paypal">
                      </figure>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <td> <strong>Subtotal:</strong></td>
                            <td class="subtotal"></td>
                          </tr>
                          <tr>
                            <td> <strong>Shipping:</strong></td>
                            <td>Free</td>
                          </tr>
                          <tr>
                            <td> <strong>Total:</strong></td>
                            <td class="subtotal"></td>
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
    console.log("test", order);
    // Set value pemesan
    document.getElementsByClassName("tanggal_pesanan")[0].textContent = formatDate(order.tanggal);
    document.getElementById("order_id").textContent = "#" + order.order_id;
    document.getElementById("detail_nama_pemesan").textContent = order.nama_pemesan;
    document.getElementById("detail_alamat_pemesan").textContent = order.alamat_pemesan;
    document.getElementsByClassName("detail_jumlah_pesanan")[0].textContent = order.jumlah_pesanan;
    document.getElementById("detail_no_hp").textContent = order.no_hp;
    document.getElementById("email_pemesan").textContent = order.email;

    // Set value produk
    document.getElementById("nama_produk").textContent = order.nama_produk;
    document.getElementById("kode_produk").textContent = order.kode_produk;
    document.getElementById("kategori_produk").textContent = order.kategori_produk;
    document.getElementById("harga_jual").textContent = "Rp " + (order.harga_jual).toLocaleString("ID");
    document.getElementsByClassName("subtotal")[0].textContent = "Rp " + (subtotal).toLocaleString("ID");
    document.getElementsByClassName("subtotal")[1].textContent = "Rp " + (subtotal).toLocaleString("ID");
    document.getElementsByClassName("subtotal")[2].textContent = "Rp " + (subtotal).toLocaleString("ID");
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