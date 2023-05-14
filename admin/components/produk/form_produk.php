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
            <div class="form-group">
              <label for="kode" class="col-form-label">Kode</label>
              <input required id="kode" name="kode" type="text" class="form-control" value="" placeholder="Contoh: TV10">
            </div>
            <div class="form-group">
              <label for="nama" class="col-form-label">Nama Produk</label>
              <input required id="nama" name="nama" type="text" class="form-control" value="" placeholder="Contoh: Televisi">
            </div>
            <div class="form-group">
              <label for="harga_beli" class="col-form-label">Harga Beli</label>
              <input required id="harga_beli" name="harga_beli" value="" type="number" class="form-control" placeholder="Contoh: 1000000">
            </div>
            <div class="form-group">
              <label for="stok" class="col-form-label">Stok</label>
              <input required id="stok" name="stok" value="" type="number" class="form-control" placeholder="Contoh: 25">
            </div>
            <div class="form-group">
              <label for="min_stok" class="col-form-label">Minimal Pembelian</label>
              <input required id="min_stok" name="min_stok" value="" type="number" class="form-control" placeholder="Contoh: 1">
            </div>
            <div class="form-group">
              <label for="image_produk" class="col-form-label">Gambar Produk</label>
              <input required id="image_produk" name="image_produk" value="" type="text" class="form-control" placeholder="Contoh: https://avatar.jpg">
            </div>
            <div class="form-group">
              <label for="kategori" class="col-form-label">Kategori Produk</label>
              <div>
                <?php
                $sqlkategori = "SELECT * FROM kategori_produk";
                $rskategori = $dbh->query($sqlkategori);
                ?>
                <select required id="kategori" name="kategori" class="custom-select">
                  <option value="" disabled selected>Pilih Kategori</option>
                  <?php
                  foreach ($rskategori as $rowkategori) {
                  ?>
                    <option value="<?= $rowkategori['id'] ?>"><?= $rowkategori['nama'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="col-form-label">Deskripsi Produk</label>
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
  $(document).ready(function() {
    $('#summernote').summernote({
      height: 200,
      callbacks: {
        onChange: function(contents, $editable) {
          console.log(contents);
          // Disini Anda dapat mengakses value summernote dan melakukan operasi yang diperlukan
        }
      }
    });
  });

  function getPayloadDetailForUpdate(payload) {
    var row = JSON.parse(payload);
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Ubah Produk";

    // Akses properti row objek
    var kode = row.kode;
    var nama = row.nama;
    var harga_beli = row.harga_beli;
    var stok = row.stok;
    var min_stok = row.min_stok;
    var kategori_produk = row.kategori_produk_id;
    var image_produk = row.image_produk;
    var deskripsi = row.deskripsi;

    // Set value ke input
    document.getElementById("kode").value = kode;
    document.getElementById("nama").value = nama;
    document.getElementById("harga_beli").value = harga_beli;
    document.getElementById("stok").value = stok;
    document.getElementById("min_stok").value = min_stok;
    document.getElementById("kategori").value = kategori_produk;
    document.getElementById("image_produk").value = image_produk;

    // Set nilai pada summernote
    $('#summernote').summernote('code', deskripsi);

    // Menampilkan button ubah dan menyembunyikan button simpan
    document.getElementById("ubah").classList.remove("d-none");
    document.getElementById("tambah").classList.add("d-none");

    // Mengatur render action untuk proses update
    document.getElementById("form-proses").action = "controller/produk/proses_produk.php?idedit=" + row.id;
  }

  function addProduct() {
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Tambah Produk";

    // Reset values
    document.getElementById("kode").value = null;
    document.getElementById("nama").value = null;
    document.getElementById("harga_beli").value = null;
    document.getElementById("stok").value = null;
    document.getElementById("min_stok").value = null;
    document.getElementById("image_produk").value = null;
    document.getElementById("kategori").value = "";
    $('#summernote').summernote('code', "");

    // Menampilkan button simpan dan menyembunyikan button ubah
    document.getElementById("ubah").classList.add("d-none");
    document.getElementById("tambah").classList.remove("d-none");

    // Mengatur render action untuk proses create
    document.getElementById("form-proses").action = "controller/produk/proses_produk.php";
  }
</script>