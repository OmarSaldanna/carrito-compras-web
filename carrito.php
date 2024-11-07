<!DOCTYPE html>
<html>
<head>
  <?php require "components/meta.php"; ?>
  <style>
    .cart-item {
      border-bottom: 1px solid #e0e0e0;
      padding: 20px 0;
    }
    .product-image {
      max-width: 150px;
      height: auto;
    }
    .quantity-selector {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .price {
      color: #424242;
      font-weight: 500;
    }
    .remove-btn {
      color: #757575;
    }
    .summary-card {
      background-color: #fafafa;
      padding: 20px;
      border-radius: 4px;
    }
  </style>
</head>
<body>

  <?php require "components/navbar.php"; ?>  

  <div class="space"></div>
  <div class="space"></div>

  <div class="container">
    <div class="row">
      <!-- Cart Items Section -->
      <div class="col s12 m8">
        <h1>Carrito de Compras</h1>
        
        <!-- Cart Item 1 -->
        <div class="cart-item">
          <div class="row valign-wrapper">
            <div class="col s12 m3">
              <img src="stock/images_02c7e2cb7b91ef3b.png" alt="Imagen 1" class="product-image">
            </div>
            <div class="col s12 m6">
              <h6 class="grey-text text-darken-4">Product Name 1</h6>
              <p class="grey-text">Imagen</p>
            </div>
            <div class="col s12 m3">
              <h6 class="price">$99.99</h6>
              <a href="#!" class="remove-btn"><i class="material-icons">close</i></a>
            </div>
          </div>
        </div>

        <!-- Cart Item 2 -->
        <div class="cart-item">
          <div class="row valign-wrapper">
            <div class="col s12 m3">
              <img src="stock/images_1af064522c445d41.png" alt="Imagen 2" class="product-image">
            </div>
            <div class="col s12 m6">
              <h6 class="grey-text text-darken-4">Product Name 2</h6>
              <p class="grey-text">Imagen</p>
            </div>
            <div class="col s12 m3">
              <h6 class="price">$149.99</h6>
              <a href="#!" class="remove-btn"><i class="material-icons">close</i></a>
            </div>
          </div>
        </div>

        <!-- Cart Item 3 -->
        <div class="cart-item">
          <div class="row valign-wrapper">
            <div class="col s12 m3">
              <img src="stock/images_5798d711a7bb78d0.png" alt="Imagen 2" class="product-image">
            </div>
            <div class="col s12 m6">
              <h6 class="grey-text text-darken-4">Product Name 2</h6>
              <p class="grey-text">Imagen</p>
            </div>
            <div class="col s12 m3">
              <h6 class="price">$99.99</h6>
              <a href="#!" class="remove-btn"><i class="material-icons">close</i></a>
            </div>
          </div>
        </div>

      </div>



      <!-- Order Summary Section -->
      <div class="col s12 m4">
        <div class="summary-card">
          <h5 class="grey-text text-darken-3">Productos</h5>
          <div class="divider"></div>
          <div class="row">
            <div class="col s6">
              <p>Subtotal</p>
              <p>Servicio</p>
              <p>Impuestos</p>
            </div>
            <div class="col s6 right-align">
              <p>$249.98</p>
              <p>$9.99</p>
              <p>$25.00</p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col s6">
              <h6>Total</h6>
            </div>
            <div class="col s6 right-align">
              <h6>$284.97</h6>
            </div>
          </div>
          <button class="btn black waves-effect waves-light btn-large full-width">
            Confirmar Compra
          </button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>