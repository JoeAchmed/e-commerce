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
              <label for="nama" class="col-form-label">Nama Kategori</label>
              <input required id="nama" name="nama" type="text" class="form-control" value="" placeholder="Contoh: Elektronik">
            </div>
            <div class="form-group">
              <label for="image_kategori" class="col-form-label">Gambar Kategori</label>
              <input required id="image_kategori" name="image_kategori" type="text" class="form-control" value="" placeholder="Contoh: https://minuman.jpg">
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
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Ubah Kategori";

    // Akses properti row objek
    var nama = row.nama;
    var image_kategori = row.image_kategori;

    // Set value ke input
    document.getElementById("nama").value = nama;
    document.getElementById("image_kategori").value = image_kategori;

    // Menampilkan button ubah dan menyembunyikan button simpan
    document.getElementById("ubah").classList.remove("d-none");
    document.getElementById("tambah").classList.add("d-none");

    // Mengatur render action untuk proses update
    document.getElementById("form-proses").action = "controller/kategori/proses_kategori.php?idedit=" + row.id;
  }

  function addProduct() {
    document.getElementsByClassName("modal-title")[0].innerHTML = "Form Tambah Kategori";

    // Reset values
    document.getElementById("nama").value = null;
    document.getElementById("image_kategori").value = null;

    // Menampilkan button simpan dan menyembunyikan button ubah
    document.getElementById("ubah").classList.add("d-none");
    document.getElementById("tambah").classList.remove("d-none");

    // Mengatur render action untuk proses create
    document.getElementById("form-proses").action = "controller/kategori/proses_kategori.php";
  }
</script>