<?php 
  // codigo inicial de verificacion de sesion:
  // si ya hay sesion iniciada, redirigimos al dashboard
  // iniciamos el mecanismo de sesiones
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  // verificar la sesion
  $loged = isset($_SESSION['id_usuario']);
?>
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper black">
      <a href="index.php" class="brand-logo right hide-on-small-only">AI Stock&nbsp;&nbsp;&nbsp;</a>
      <!-- Botón de menú hamburguesa -->
      <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <!-- el se cerrar o iniciar sesión -->
        <li><a href="<?php echo $loged ? "actions/cerrar_sesion.php" : "login.php"; ?>" class="waves-effect waves-light btn white black-text"><?php echo $loged ? "Cerrar" : "Iniciar"; ?> Sesión<i class="material-icons left">log<?php echo $loged ? "out" : "in"; ?></i></a></li>
        <!-- botones desabilitados según la sesión -->
        <li><a href="carrito.php" class="<?php echo $loged ? "" : "hide"; ?>"><i class="material-icons right">shopping_basket</i>Carrito</a></li>
        <li><a href="compras.php" class="<?php echo $loged ? "" : "hide"; ?>"><i class="material-icons right">burst_mode</i>Mis Compras</a></li>
        <!-- otros -->
        <li><a href="nosotros.php">Nosotros</a></li>
        <li><a href="index.php">Galería</a></li>
      </ul>
      
      <!-- Logo centrado para móviles -->
      <a href="index.php" class="brand-logo center hide-on-med-and-up">AI Stock</a>
    </div>
  </nav>
</div>

<!-- Menú lateral para móviles -->
<ul class="sidenav" id="mobile-nav">
  <li class="sidenav-header black white-text">
    <div class="user-view">
      <h4 class="center">AI Stock</h4>
    </div>
  </li>
  <li><div class="divider"></div></li>
  <!-- el se cerrar o iniciar sesión -->
  <li><a href="<?php echo $loged ? "actions/cerrar_sesion.php" : "login.php"; ?>" class="waves-effect">
    <i class="material-icons">log<?php echo $loged ? "out" : "in"; ?></i>
    <?php echo $loged ? "Cerrar" : "Iniciar"; ?> Sesión
  </a></li>
  <!-- botones desabilitados según la sesión -->
  <li class="<?php echo $loged ? "" : "hide"; ?>">
    <a href="carrito.php" class="waves-effect">
      <i class="material-icons">shopping_basket</i>Carrito
    </a>
  </li>
  <li class="<?php echo $loged ? "" : "hide"; ?>">
    <a href="compras.php" class="waves-effect">
      <i class="material-icons">burst_mode</i>Mis Compras
    </a>
  </li>
  <!-- otros -->
  <li><a href="nosotros.php" class="waves-effect">
    <i class="material-icons">info</i>Nosotros
  </a></li>
  <li><a href="index.php" class="waves-effect">
    <i class="material-icons">photo_library</i>Galería
  </a></li>
</ul>

<!-- Script para inicializar el sidenav -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, {
    edge: 'left',
    draggable: true,
    inDuration: 250,
    outDuration: 200
  });
});
</script>