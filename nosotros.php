<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos</title>
	<?php require "components/meta.php"; ?>
  <style>
    /* Personalización de las tabs */
    .tabs .indicator {
        background-color: #424242 !important; /* Gris oscuro para el indicador */
    }

    .tabs .tab a:focus,
    .tabs .tab a:focus.active {
        background-color: rgba(66, 66, 66, 0.1) !important; /* Gris transparente para el foco */
    }
  </style>
</head>
<body>
	<?php require "components/navbar.php"; ?>

  <!-- parallax e inicio -->
  <div class="parallax-container">
    <div class="parallax"><img src="assets/fondo-index.jpg"></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h1 class="gray-text header"><span class="marked space-left">DALL-E 3</span> Stock</h1>
      <p class="gray-text lighten-3 justify">Descubre una colección única de imágenes generadas por inteligencia artificial en nuestra página web. Explora la creatividad y originalidad de estas obras digitales creadas por algoritmos avanzados, que ofrecen una experiencia visual innovadora y fascinante. Sumérgete en un mundo de arte generado por IA y encuentra la pieza perfecta para tu proyecto o colección personal. ¡Bienvenido a la vanguardia de la creatividad digital!</p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="assets/fondo-index.jpg"></div>
  </div>
  <div class="section white">

	<div class="row container">
        <h1 class="gray-text header"><span class="marked space-left">Descubre</span> Lo Que Tenemos Para Ti</h1>
	</div>
  </div>

  <!-- relleno -->
  <div class="space"></div>

  <!-- contenido del about us -->

  <div class="section">
    <div class="row container">
      <div class="col s5">
        <div class="card-panel black">
          <span class="white-text">
            <h2>AI Stock</h2>
            <p>Bienvenidos a AI Stock Gallery, tu destino premium para arte digital generado por inteligencia artificial. Desde 2023, nos dedicamos a revolucionar el mundo del arte digital, ofreciendo una curada colección de imágenes únicas y sorprendentes.</p>
          </span>
          <div class="card-image">
            <img class="responsive-img" src="assets/logo.png" alt="AI Art Example">
          </div>
        </div>
      </div>
      <div class="col s6 offset-s1 card">
        <div class="card-content">
          <h2>¿Cómo Comprar?</h2>
          <p>Descubre una colección única de imágenes generadas por inteligencia artificial en nuestra galería. Explora la creatividad y originalidad de estas obras digitales creadas por algoritmos avanzados, que ofrecen una experiencia visual innovadora y fascinante.</p>
        </div>
        <div class="card-tabs">
          <!-- Agregamos clases personalizadas para los colores -->
          <ul class="tabs tabs-fixed-width">
            <li class="tab"><a class="active black-text" href="#test4">Elige</a></li>
            <li class="tab"><a class="black-text" href="#test5">Compra</a></li>
            <li class="tab"><a class="black-text" href="#test6">Disfruta</a></li>
          </ul>
        </div>
        <div class="card-content grey lighten-4">
          <div id="test4"><p>Navega por nuestra extensa biblioteca de imágenes generadas por IA. Cada pieza es única y está lista para ser descargada en alta resolución. Utiliza nuestros filtros inteligentes para encontrar exactamente lo que necesitas.</p></div>
          <div id="test5"><p>Proceso de compra simple y seguro. Precios competitivos y licencias claras. Obtén acceso instantáneo a tus imágenes después de la compra.</p></div>
          <div id="test6"><p>Descarga tus imágenes en múltiples formatos y resoluciones. Usa nuestras obras en tus proyectos comerciales o personales con total confianza y respaldo legal.</p></div>
        </div>
      </div>
    </div>
  </div>


	<?php require "components/footer.php"; ?>


  <script type="text/javascript">
  	M.AutoInit();
  </script>
</body>
</html>