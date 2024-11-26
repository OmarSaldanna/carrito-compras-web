<?php 
	
	// iniciar las sesiones
	session_start();
	// importar de la db
	require "../actions/db.php";

	// si ni siquiera hay sesiones
	if (!isset($_SESSION['id_usuario'])) {
		redirect("../index.php", "M.toast({html: 'Error _'});");
	}

	// usuario de omarlara997@gmail.com
	if ($_SESSION['id_usuario'] != 5) {
		redirect("../index.php", "M.toast({html: 'Error'});");
	}

	// if everything okey, then select * from db
	$conn = connect_db();

	// alertas a usar
	// todas las alertas de error que vamos a usar
	$error = "M.toast({html: 'Ups! algo salió mal'});";
	$created = "M.toast({html: 'Creado correctamente'});";
	$removed = "M.toast({html: 'Eliminado correctamente'});";
	$edited = "M.toast({html: 'Actualizado correctamente'});";

	// determinar la accion
	switch ($_GET['action']) {
	    case 'create':
	    	// get the params
	    	$precio = $_GET['precio'];
	    	$categorias = $_GET['categorias'];
	    	$imagen_url = $_GET['imagen_url'];
	    	// hacer la query
	    	query($conn, "INSERT INTO productos (precio, imagen_url, categorias) VALUES ($precio, '$imagen_url', '$categorias');");
	    	// y redirigir
	    	redirect("index.php", $created);
	        break;

	    case 'edit':
	    	// get the params
	    	$precio = $_GET['precio'];
	    	$categorias = $_GET['categorias'];
	    	$imagen_url = $_GET['imagen_url'];
	    	$id_producto = $_GET['id_producto'];
	    	// hacer la query
	    	query($conn, "UPDATE productos SET precio = $precio, imagen_url = '$imagen_url', categorias = '$categorias' WHERE id_producto = $id_producto;");
	    	// y redirigir
	    	redirect("index.php", $edited);
	        break;

	    case 'remove':
	    	// get the params
	    	$id_producto = $_GET['id_producto'];
	    	// hacer la query
	    	query($conn, "DELETE FROM productos WHERE id_producto = $id_producto;");
	    	// y redirigir
	    	redirect("index.php", $removed);
	        break;
	    default:
	    	redirect("index.php", $error);
	        break;
	}

?>