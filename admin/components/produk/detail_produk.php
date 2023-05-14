<!-- Detail Produk Modal -->
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <!-- Main content -->
          <section class="content">

            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none detail-produk-nama"></h3>
                <div class="col-12 row align-items-center justify-content-center" style="height: 440px;">
                  <img id="detail-image-produk" src="" alt="Product Image" style="width: 80%">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <h2 class="my-3" id="detail-produk-kode"></h2>
                <h3 class="my-3" id="detail-produk-nama"></h3>
                <p id="detail-produk-deskripsi" htmlspecialchars></p>

                <hr>
                <h4>Sisa Stok: <span id="detail-produk-stok"></span></h4>

                <h4 class="mt-3">Kategori: <div class="btn-group btn-group-toggle ml-3" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                      <span class="text-md" id="detail-kategori-produk"></span>
                    </label>
                  </div>
                </h4>

                <div class="bg-gray py-2 px-3 mt-4">
                  <h2 class="mb-0" id="detail-produk-harga-jual">
                  </h2>
                  <h4 class="mt-0">
                    <small>Harga Beli: <span id="detail-produk-harga-beli"></span> </small>
                  </h4>
                </div>

              </div>
            </div>

          </section>
          <!-- /.content -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  function handleGetProductDetail(payload) {
    try {
      var product = JSON.parse(payload);

      console.log(product, "cek");
      // Set the values in the modal
      document.getElementById("detail-produk-kode").innerHTML = "#" + product.kode;
      document.getElementById("detail-produk-nama").innerHTML = product.nama;
      document.getElementById("detail-produk-deskripsi").innerHTML = product.deskripsi;
      document.getElementById("detail-produk-harga-jual").innerHTML = 'Rp ' + numberWithCommas(product.harga_jual);
      document.getElementById("detail-produk-harga-beli").innerHTML = 'Rp ' + numberWithCommas(product.harga_beli);
      document.getElementById("detail-produk-stok").innerHTML = numberWithCommas(product.stok);
      document.getElementById("detail-image-produk").src = product.image_produk;
      document.getElementById("detail-kategori-produk").innerHTML = product.kategori_produk;
      document.getElementById("detail-produk-min-stok").innerHTML = numberWithCommas(product.min_stok);
    } catch (error) {
      console.log(error);
    }
  }

  // Function to format numbers with commas
  function numberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
</script>