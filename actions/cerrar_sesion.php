<?php 
	// importar los modulos de db
	require 'db.php';

	// Iniciar la sesión
	session_start();

	// Eliminar todas las variables de la sesión
	$_SESSION = array();

	// Invalidar la sesión
	session_destroy();

	// hacer el redirect al index
	redirect("../index.php", "M.toast({html: 'Nos vemos luego'});");
?>