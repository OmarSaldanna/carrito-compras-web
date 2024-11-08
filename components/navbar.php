<?php 
  // codigo inicial de verificacion de sesion:
  // si ya hay sesion iniciada, redirigimos al dashboard
  // iniciamos el mecanismo de sesiones
  session_start();
  // verificar la sesion
  $loged = isset($_SESSION['id_usuario']);
?>

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper black">
      <a href="index.php" class="brand-logo right">AI Stock&nbsp;&nbsp;&nbsp;</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <!-- el se cerrar o iniciar sesión -->
        <li><a href="<?php echo $loged ? "actions/cerrar_sesion.php" : "login.php"; ?>" class="waves-effect waves-light btn white black-text"><?php echo $loged ? "Cerrar" : "Iniciar"; ?> Sesión</a></li>
        <!-- botones desabilitados según la sesión -->
        <li><a href="carrito.php" class="<?php echo $loged ? "" : "hide"; ?>"><i class="material-icons right">shopping_basket</i>Carrito</a></li>
        <li><a href="perfil.php" class="<?php echo $loged ? "" : "hide"; ?>"><i class="material-icons right">person</i>Mi cuenta</a></li>
        <!-- otros -->
        <li><a href="nosotros.php">Nosotros</a></li>
        <li><a href="index.php">Galería</a></li>
      </ul>
    </div>
  </nav>
</div>