<?php 

	// importar los modulos de db
	require 'db.php';

	////////////////////////////// Errores ////////////////////////////

	// todas las alertas de error que vamos a usar
	$empty_field = "M.toast({html: 'No se aceptan campos vacíos'});";
	$incorrect = "M.toast({html: 'Correo o contraseña incorrectos'});";
	$welcome = "M.toast({html: 'Bienvenid@ de vuelta'});";

	////////////////////////////// Comprobaciones ////////////////////////////

	// todos los "name" de los inputs del formulario, recibidas por POST
	$params = array("email", "password");

	# 1 - verificar campos vacíos
	foreach ($params as $param) {
		// verificar que esten definidos y no vacios
		if (!isset($_POST[$param]) || empty($_POST[$param])) {
			// redirigir al login con alerta de campos vacios
			redirect("../login.php", $empty_field);
		}
	}

	# 2 - verificar el email
	if (strpos($_POST['email'], "@") == false) {
		// redirigir al login con una alerta
		redirect("../login.php", $incorrect);
	}

	////////////////////////////// base de datos ////////////////////////////

	// para este punto sabemos que los datos llegaron correctos

	// arrancar el sistema de sesiones
	session_start();

	// iniciar la conexión
	$conn = connect_db();

	// seleccionar los datos de la request
	$email = $_POST["email"];
	$password = $_POST["password"];

	// ejecutar la query para buscar la contraseña del usuario
	$res = query($conn, "SELECT id_usuario, password from usuarios where email='$email';");

	// si si se encontró el email
	if ($res->num_rows > 0) {
	    // Obtener la primera fila
	    $row = $res->fetch_assoc();
	    // comprobar las contraseñas
	    if ($password == $row['password']) {
	    	// si si coinciden, hay que guardar el id_usuario en la sesion
	    	$_SESSION['id_usuario'] = $row['id_usuario'];
	    	// y finalmente redirigir la galería
	    	redirect("../index.php", $welcome);
	    } else {
	    	// redirigir al login con una alerta
			redirect("../login.php", $incorrect);
	    }
	// si no se encontró el email
	} else {
		// redirigir al login con una alerta
		redirect("../login.php", $incorrect);
	}

	// 

?>