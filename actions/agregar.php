<?php 

	// importar los modulos de db
	require 'db.php';

	// Iniciar la sesión
	session_start();

	////////////////////////////// Alertas ////////////////////////////

	$not_session = "M.toast({html: 'Antes tienes que iniciar sesión'});";
	$error = "M.toast({html: 'Ups! algo salió mal'});";

	////////////////////////////// Comprobaciones ////////////////////////////

	// si no hay sesión
	if(!isset($_SESSION['id_usuario'])) {
		// redireccionar con alerta
		redirect("../index.php", $not_session);
	}

	// si no hay id del producto
	if(!isset($_GET['id_producto'])) {
		// redireccionar con alerta
		redirect("../index.php", "");
	}

	////////////////////////////// Acciones ////////////////////////////

	// conectar a la base de datos
	$conn = connect_db();

	// obtener datos necesarios
	$id_usuario = $_SESSION['id_usuario'];
	$id_producto = $_GET['id_producto'];

	// definir las queries
	query($conn, "INSERT INTO carritos (id_usuario) SELECT id_usuario FROM usuarios
		WHERE id_usuario = $id_usuario AND NOT EXISTS (SELECT 1 FROM carritos WHERE id_usuario = $id_usuario);");
	$resultado = query($conn, "INSERT INTO items_carrito (id_carrito, id_producto, cantidad, precio_unitario)
			SELECT c.id_carrito, p.id_producto, 1, p.precio
			FROM carritos c
			JOIN productos p ON p.id_producto = $id_producto
			WHERE c.id_usuario = $id_usuario;");
	// checar el resultado
	if ($resultado) {
		// con alerta
		redirect("../carrito.php", "");
	} else {
		// con alerta
		redirect("../index.php", $error);
	}
?>