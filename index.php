<?php 
  // importar los modulos necesarios
  require "actions/db.php";

  // passed page
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  // funcion para seleccionar los n 15 items de la tabla
  function getPaginatedProducts() {
    // conectar la db
    $conn = connect_db();
    // definir el numero de items por pagina
    $itemsPorPagina = 15;
    // verificamos que el parámetro exista y si no será la primera
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // calculamos el offset
    $offset = ($paginaActual - 1) * $itemsPorPagina;
    // hacemos la query
    $query = "SELECT * FROM productos LIMIT $offset, $itemsPorPagina";
    // ejecutamos la query
    $resultado = query($conn, $query);
    // retornar el resultado
    return [
      'productos' => mysqli_fetch_all($resultado, MYSQLI_ASSOC),
      'paginaActual' => $paginaActual
    ];
  }



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos</title>
	<?php require "components/meta.php"; ?>
</head>
<body>
	<?php require "components/navbar.php"; ?>

  <div class="space"></div>
  
  <div class="section white">
	<!-- titulo -->
	<div class="row container">
        <h1 class="gray-text header"><span class="marked space-left">Explora</span> Nuestra Galería</h1>
	</div>
  </div>

  <div class="space"></div>

  <!-- apartado de imágenes -->

  <!-- # -p considerando el código php de arriba, quiero que esos 15 elementos seleccionados de la base de datos los escribas mediante php en div .row cada tres imágenes, considera que los datos lucen de la siguiente manera: (1, 63, 'images_79ad8f8434955a7b.png', 'abstracto ícono arte') siendo (id_producto, precio, imagen_url, categorias). Quiero que el botón de a, redireccione a actions/agrefar.php y que por get pases la id_producto. En los span coloca cada una de las categorías (que vienen separadas por espacios en los datos)  -->
  <?php
    // obtenemos los productos
    $productosData = getPaginatedProducts();
    // seleccionamos las filas
    $productos = $productosData['productos'];
    // por cada tres filas
    foreach (array_chunk($productos, 3) as $chunk) {
    // empezamos la row
    echo '<div class="row container">';
      // ahora por cada producto
      foreach ($chunk as $producto) {
        // por cada categoría
        $categorias = explode(' ', $producto['categorias']);
        // imprimirmos las apan de cateorías y la imagen
        echo '<div class="col s4">
          <div class="card">
            <div class="card-image">
              <img src="stock/' . $producto['imagen_url'] . '">
              <span class="card-title">';
        foreach ($categorias as $categoria) {
          echo '<span class="badge white">' . htmlspecialchars($categoria) . '</span>';
        }

        echo '</span>
              <a href="actions/agregar.php?id_producto=' . $producto['id_producto'] . '" class="btn-floating halfway-fab waves-effect waves-light black"><i class="material-icons">add</i></a>
            </div>
          </div>
        </div>';
      }
    echo '</div>';
    }
  ?>

  <div class="space"></div>

  <!-- cosas del pagination -->
  <div class="row">
    <div class="container center">
      <ul class="pagination">
        <li class="<?php echo $page == 1 ? "disabled " : "waves-effect"; ?>"><a href="<?php echo $page > 1 ? "index.php?page=".$page-1 : "#!"; ?>"><i class="material-icons">chevron_left</i></a></li>
        <li class="<?php echo $page == 1 ? "active black white-text" : "waves-effect"; ?>"><a href="index.php?page=1">1</a></li>
        <li class="<?php echo $page == 2 ? "active black white-text" : "waves-effect"; ?>"><a href="index.php?page=2">2</a></li>
        <li class="<?php echo $page == 3 ? "active black white-text" : "waves-effect"; ?>"><a href="index.php?page=3">3</a></li>
        <li class="<?php echo $page == 4 ? "active black white-text" : "waves-effect"; ?>"><a href="index.php?page=4">4</a></li>
        <li class="<?php echo $page == 4 ? "disabled " : "waves-effect"; ?>"><a href="<?php echo $page < 4 ? "index.php?page=".$page+1 : "#!"; ?>"><i class="material-icons">chevron_right</i></a></li>
      </ul>
    </div>
  </div>

  <?php require "components/footer.php"; ?>
	<?php require "components/alert.php"; ?>


  <script type="text/javascript">
  	 document.addEventListener('DOMContentLoaded', function() {
	    var elems = document.querySelectorAll('.parallax');
	    var instances = M.Parallax.init(elems, {});
	  });
  </script>
</body>
</html>