<?php 
	// importar los modulos de db
	require 'db.php';

	////////////////////////////// Errores ////////////////////////////

	// todas las alertas de error que vamos a usar
	$empty_field = "M.toast({html: 'No se aceptan campos vacíos'});";
	$incorrect_mail = "M.toast({html: 'Correo incorrecto'});";
	$no_matching_passwords = "M.toast({html: 'Las contraseñas no coinciden'});";
	$existing_mail = "M.toast({html: 'El correo ya existe'});";
	$terms_not_accepted = "M.toast({html: 'Acepta los terminos y condiciones'});";
	$unexpected = "M.toast({html: 'Ups! algo salió mal'});";
	// mensaje de bienvenida
	$welcome = "M.toast({html: 'Bienvenid@ a AI Stock'});";


	////////////////////////////// Comprobaciones ////////////////////////////

	// todos los "name" de los inputs del formulario, recibidas por POST
	$params = array("email", "password", "username", "second");

	# 1 - verificar campos vacíos
	foreach ($params as $param) {
		// verificar que esten definidos y no vacios
		if (!isset($_POST[$param]) || empty($_POST[$param])) {
			// redirigir al signup con alerta de campos vacios
			redirect("../signup.php", $empty_field);
		}
	}

	# 2 - verificar el email
	if (strpos($_POST['email'], "@") == false) {
		// redirigir al signup con una alerta
		redirect("../signup.php", $incorrect."&username=".$_POST['username']);
	}

	# 3 - comprobar las contraseñas
	if ($_POST['password'] != $_POST['second']) {
		redirect("../signup.php", $no_matching_passwords."&username=".$_POST['username']."&email=".$_POST['email']);
	}

	# 4 - verificar que hayan sido aceptados los terminos y condiciones
	if (!isset($_POST['terms'])) {
		redirect("../signup.php", $terms_not_accepted."&username=".$_POST['username']."&email=".$_POST['email']);
	}

	# 5 - verificar que el correo no exista en la base de datos
	// iniciar la conexión
	$conn = connect_db();
	// seleccionar el email
	$email = $_POST["email"];
	// ejecutar la query para buscar si el usuario ya existe
	$res = query($conn, "SELECT * from usuarios where email='$email';");
	// si si se encontró el email
	if ($res->num_rows > 0) {
		redirect("../signup.php", $existing_mail."&username=".$_POST['username']);
	}

	////////////////////////////// base de datos ////////////////////////////

	// para este punto sabemos que los datos llegaron correctos
	// y que el usuario no existe

	// seleccionar los datos de la request
	// $email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	// ejecutar la query para insertar un nuevo usuario en la base de datos
    $res = query($conn, "INSERT INTO usuarios (email, username, password) VALUES ('$email', '$username', '$password')");

    // Verificar si hubo un error en la query
    if (!$res) {
        // Manejar el error de la query
        redirect("../signup.php", $unexpected);
    // si todo bien, creamos la sesión y redirigimos a la galería
    } else {
    	// ejecutar la query pero ahora para conocer su id
    	$res = query($conn, "SELECT id_usuario from usuarios where email='$email';");
    	$row = $res->fetch_assoc();
    	// iniciar la sesión
    	session_start();
    	$_SESSION['id_usuario'] = $row["id_usuario"];
    	// y redirigir con una alerta
    	redirect("../index.php", $welcome);
    }

?>