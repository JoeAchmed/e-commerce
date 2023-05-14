<div class="products mb-3">
  <?php
  $number = 1;
  foreach ($product as $rowproduct) {
    $is_available = $rowproduct["stok"] > 0;
  ?>
    <div class="product product-list" key="produk-list-<?= $number ?>">
      <div class="row">
        <div class="col-6 col-lg-3">
          <figure class="product-media">
            <span class="product-label label-<?= $is_available ? "new" : "out" ?>"><?= $is_available ? "On Stock" : "Out of Stock" ?></span>
            <a href="detail.php?produk_id=<?= $rowproduct["id"] ?>">
              <img src="<?= $rowproduct["image_produk"] ?>" alt="Product image" class="product-image">
            </a>
          </figure><!-- End .product-media -->
        </div><!-- End .col-sm-6 col-lg-3 -->

        <div class="col-6 col-lg-3 order-lg-last">
          <div class="product-list-action">
            <div class="product-price">
              Rp <?= number_format($rowproduct["harga_jual"], 0, ',', '.') ?>
            </div><!-- End .product-price -->
            <div class="ratings-container p-0">
              <span class="ratings-text">(Stok <?= $rowproduct["stok"] == 0 ? 'Habis' : $rowproduct["stok"] ?>)</span>
            </div><!-- End .rating-container -->

            <div class="product-action <?= $rowproduct['stok'] == 0 ? 'd-none' : '' ?>" onclick="localStorage.setItem('product_cart', '<?php echo htmlspecialchars(json_encode($rowproduct), ENT_QUOTES, 'UTF-8'); ?>')">
              <a href="cart.php" class="btn-product btn-cart"><span>add to cart</span></a>
            </div><!-- End .product-action -->

          </div><!-- End .product-list-action -->
        </div><!-- End .col-sm-6 col-lg-3 -->

        <div class="col-lg-6">
          <div class="product-body product-action-inner">
            <div class="product-cat">
              <a href="#"><?= $rowproduct["kategori_produk"] ?></a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="detail.php"><?= $rowproduct["nama"] ?></a></h3><!-- End .product-title -->

            <div class="product-content">
              <p><?= $rowproduct["deskripsi"] ?></p>
            </div><!-- End .product-content -->
          </div><!-- End .product-body -->
        </div><!-- End .col-lg-6 -->
      </div><!-- End .row -->
    </div><!-- End .product -->

  <?php
  }
  ?>
</div><!-- End .products -->