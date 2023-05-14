<div class="row justify-content-center">
  <?php
  $number = 1;
  foreach ($product as $rowproduct) {
    $is_available = $rowproduct["stok"] > 0;
  ?>
    <div class="col-6">
      <div class="product product-7 text-center">
        <figure class="product-media">
          <span class="product-label label-<?= $is_available ? "new" : "out" ?>"><?= $is_available ? "On Stock" : "Out of Stock" ?></span>
          <a href="detail.php?produk_id=<?= $rowproduct["id"] ?>">
            <img src="<?= $rowproduct["image_produk"] ?>" alt="Product image" class="product-image">
          </a>

          <div class="product-action <?= $rowproduct['stok'] == 0 ? 'd-none' : '' ?>" onclick="localStorage.setItem('product_cart', '<?php echo htmlspecialchars(json_encode($rowproduct), ENT_QUOTES, 'UTF-8'); ?>')">
            <a href="cart.php" class="btn-product btn-cart"><span>add to cart</span></a>
          </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
          <div class="product-cat">
            <a href="#"><?= $rowproduct["kategori_produk"] ?></a>
          </div><!-- End .product-cat -->
          <h3 class="product-title"><a href="detail.php"><?= $rowproduct["nama"] ?></a></h3><!-- End .product-title -->
          <div class="product-price">
            Rp <?= number_format($rowproduct["harga_jual"], 0, ',', '.') ?>
          </div><!-- End .product-price -->
          <div class="ratings-container">
            <span class="ratings-text">(Stok <?= $rowproduct["stok"] == 0 ? 'Habis' : $rowproduct["stok"] ?>)</span>
          </div><!-- End .rating-container -->
        </div><!-- End .product-body -->
      </div><!-- End .product -->
    </div><!-- End .col-sm-6 -->
  <?php
  }
  ?>
</div>