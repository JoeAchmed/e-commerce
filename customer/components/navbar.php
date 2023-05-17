<header class="header">
  <div class="header-top">
    <div class="container">
      <div class="header-left">
        <div id="google_translate_element"></div>
      </div><!-- End .header-left -->


      <div class="header-right py-3">
        <ul class="top-menu">
          <li>
            <a href="#">Links</a>
            <ul>
              <li><a href="tel:#"><i class="icon-phone"></i>Call: (+62)812-7106-2214</a></li>
              <li <?php if ($activePage == 'about') echo 'class="text-primary"'; ?>><a href="about.php">About Us</a></li>
              <li <?php if ($activePage == 'contact') echo 'class="text-primary"'; ?>><a href="contact.php">Contact Us</a></li>
              <li><a href="../admin/index.php"><i class="icon-user"></i>Login</a></li>
            </ul>
          </li>
        </ul><!-- End .top-menu -->
      </div><!-- End .header-right -->
    </div><!-- End .container -->
  </div><!-- End .header-top -->

  <div class="header-middle sticky-header">
    <div class="container">
      <div class="header-left">
        <button class="mobile-menu-toggler">
          <span class="sr-only">Toggle mobile menu</span>
          <i class="icon-bars"></i>
        </button>

        <a href="index.php" class="logo">
          <img src="assets/images/logo.png" alt="Molla Logo" width="105" height="25">
        </a>

        <nav class="main-nav">
          <ul class="menu sf-arrows">
            <li <?php if ($activePage == 'home') echo 'class="active"'; ?>>
              <a href="index.php">Home</a>
            </li>
            <li <?php if ($activePage == 'product') echo 'class="active"'; ?>>
              <a href="product.php">Product</a>
            </li>
            <li <?php if ($activePage == 'transactions') echo 'class="active"'; ?>>
              <a href="transactions.php">Transactions</a>
            </li>
          </ul><!-- End .menu -->
        </nav><!-- End .main-nav -->
      </div><!-- End .header-left -->

      <div class="header-right">
        <div class="header-search">
          <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
          <form action="#" method="get">
            <div class="header-search-wrapper">
              <label for="q" class="sr-only">Search</label>
              <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
            </div><!-- End .header-search-wrapper -->
          </form>
        </div><!-- End .header-search -->

        <div class="dropdown cart-dropdown">
          <a href="cart.php" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
            <i class="icon-shopping-cart" onclick="window.location.replace('cart.php')"></i>
            <span class="cart-count" id="navbar-cart-count">1</span>
          </a>

          <div id="empty-nav-product" class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products">
              <div class="product">
                <div class="product-cart-details">
                  <h4 class="product-title">
                    <a id="navbar-product-name"></a>
                  </h4>

                  <div class="cart-product-info">
                    <span class="cart-product-qty"></span>
                    x <span class="cart-product-qty"></span>
                  </div>
                </div><!-- End .product-cart-details -->

                <figure class="product-image-container">
                  <a id="navbar-product-image" href="" class="product-image">
                  </a>
                </figure>
                <a href="#" class="btn-remove" title="Remove Product" onclick="localStorage.removeItem('product_cart'), window.location.href = 'index.php'"><i class="icon-close"></i></a>
              </div><!-- End .product -->
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
              <span>Total</span>

              <span class="cart-total-price"></span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
              <a href="cart.php" class="btn btn-primary">View Cart</a>
              <a href="checkout.php" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
            </div><!-- End .dropdown-cart-total -->
          </div><!-- End .dropdown-menu -->
        </div><!-- End .cart-dropdown -->
      </div><!-- End .header-right -->
    </div><!-- End .container -->
  </div><!-- End .header-middle -->
</header><!-- End .header -->

<script>
  var empty_nav_product = document.getElementById("empty-nav-product");
  var product_cart = JSON.parse(localStorage.getItem('product_cart'));
  var product_name = document.getElementById("navbar-product-name");
  var product_image = document.getElementById("navbar-product-image");
  var navbar_cart_count = document.getElementById("navbar-cart-count");
  var cart_product_qty = document.getElementsByClassName("cart-product-qty");
  var cart_total_price = document.getElementsByClassName("cart-total-price");
  var total_product = product_cart?.total_pembelian_cust ?? product_cart?.min_stok;

  if (!product_cart) {
    empty_nav_product.classList.add("d-none");
    navbar_cart_count.classList.add("d-none");
  } else {
    empty_nav_product.classList.remove("d-none");
    navbar_cart_count.classList.remove("d-none");
    product_name.innerHTML = product_cart?.nama;
    product_name.setAttribute("href", `detail.php?produk_id=${product_cart?.id}`);
    product_image.innerHTML = `<img src="${product_cart?.image_produk}" alt="product">`;
    product_image.setAttribute("href", `detail.php?produk_id=${product_cart?.id}`);
    cart_product_qty[0].innerHTML = total_product;
    cart_product_qty[1].innerHTML = product_cart?.harga_jual?.toLocaleString("ID");
    cart_total_price[0].innerHTML = "Rp " + (product_cart?.harga_jual * total_product).toLocaleString("ID");
  }

  var translateElement;

  function googleTranslateElementInit() {
    console.log("langsung masuk sini ga");
    translateElement = new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,id',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');

    translateElement.onRemove = function() {
      translateElement.removeEventListener("pageChange", updateSelectedLanguage);
      translateElement.removeEventListener("afterTranslate", updateSelectedLanguage);
    };

    translateElement.onRender = function() {
      translateElement.addEventListener("pageChange", updateSelectedLanguage);
      translateElement.addEventListener("afterTranslate", updateSelectedLanguage);
    };
  }

  googleTranslateElementInit();
</script>