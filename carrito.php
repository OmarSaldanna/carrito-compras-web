<?php 

  // importar los modulos necesarios
  require "actions/db.php";

  // iniciar la sesión
  session_start();

  // conectar la db
  $conn = connect_db();

  // obtener el id de usuario
  $id_usuario = $_SESSION['id_usuario'];

  // Obtener el carrito activo del usuario
  $sql_carrito = "SELECT c.id_carrito 
                  FROM carritos c 
                  WHERE c.id_usuario = $id_usuario
                  ORDER BY c.fecha_creacion DESC 
                  LIMIT 1";

  // ejcutar la query
  $result_carrito = query($conn, $sql_carrito);
  // obtener los datos
  $carrito = $result_carrito->fetch_assoc();

  if ($carrito) {
    $id_carrito = $carrito['id_carrito'];
    // Obtener los items del carrito con detalles del producto
    $sql_items = query($conn, "SELECT ic.*, p.imagen_url, p.categorias, p.id_producto 
                  FROM items_carrito ic 
                  JOIN productos p ON ic.id_producto = p.id_producto 
                  WHERE ic.id_carrito = $id_carrito");
  }

  // Calcular totales
  $subtotal = 0;
  $servicio = 9.99;
  $impuestos = 0;
?>

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

  <div class="container">
    <div class="row">
      <!-- Cart Items Section -->
      <div class="col s12 m8">
        <h1>Carrito de Compras</h1>
        
        <!-- Cart Item 1 -->
        <?php 
          // si si hay carrito y hay productos
          if ($carrito && $sql_items->num_rows > 0) {
            // por cada item
            while ($item = $sql_items->fetch_assoc()) {
              // calculos de precio
              $subtotal += $item['precio_unitario'] * $item['cantidad'];
              $impuestos = $subtotal * 0.10; // 10% de impuestos
              // mostrar el producto
              echo '
                <div class="cart-item">
                  <div class="row valign-wrapper">
                    <div class="col s12 m3">
                      <img src="stock/'. $item["imagen_url"] .'" alt="Imagen 1" class="product-image">
                    </div>
                    <div class="col s12 m6">
                      <h5 class="grey-text text-darken-4">'. $item["categorias"] .'</h5>
                    </div>
                    <div class="col s12 m3">
                      <h6 class="price">$'. $item['precio_unitario'] .'</h6>
                      <a href="actions/eliminar.php?id_producto='. $item['id_producto'] .'" class="remove-btn"><i class="material-icons">remove_shopping_cart</i></a>
                    </div>
                  </div>
                </div>';
            }
          }
          else {
            redirect("index.php", "M.toast({html: 'Tu carrito está vacío'});");
          }
        ?>

        <div class="space"></div>
        <a class="waves-effect waves-light btn black" href="index.php"><i class="material-icons right">add_shopping_cart</i>Seguir comprando</a>

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
                <p>$<?php echo number_format($subtotal, 2); ?></p>
                <p>$<?php echo number_format($servicio, 2); ?></p>
                <p>$<?php echo number_format($impuestos, 2); ?></p>
              </div>
            </div>
            <div class="divider"></div>
            <div class="row">
              <div class="col s6">
                <h6>Total</h6>
              </div>
              <div class="col s6 right-align">
                <h6>$<?php echo number_format($subtotal + $servicio + $impuestos, 2); ?></h6>
              </div>
            </div>
            <button class="btn black waves-effect waves-light btn-large full-width">
              Confirmar Compra
            </button>
          </div>
        </div>
      </div>
  </div>

  <?php require "components/alert.php"; ?>

</body>
</html>