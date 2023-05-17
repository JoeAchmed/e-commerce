<!-- Detail Produk Modal -->
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <tr>
          <td>
            <img id="image-kategori" src="" alt="Image Kategori" class="py-2" width="300">
          </td>
        </tr>
        <tr>
          <td>
            <h5>Nama Kategori:</h5>
          </td>
          <td>
            <button class="btn btn-primary w-25" id="nama-kategori"></button>
          </td>
        </tr>
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
      var category = JSON.parse(payload);
      document.getElementById("nama-kategori").innerHTML = category.nama;
      document.getElementById("image-kategori").setAttribute("src", category.image_kategori);
     
    } catch (error) {
      console.log(error);
    }
  }

  // Function to format numbers with commas
  function numberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
</script>