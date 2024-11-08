<script type="text/javascript">
  // Código a ejecutar cuando el DOM se ha cargado
	document.addEventListener("DOMContentLoaded", function() {
		// una alerta de bienvenida
		<?php
			// si recibimos alguna alerta
			if (isset($_GET['alert'])) {
				// mandarla
				echo $_GET['alert'];
			}
		?>
	});
</script>