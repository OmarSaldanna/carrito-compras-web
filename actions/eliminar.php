<?php
    // importar los modulos de db
    require 'db.php';
    // Iniciar la sesión 
    session_start();

    ////////////////////////////// Alertas ////////////////////////////
    
    $not_session = "M.toast({html: 'Antes tienes que iniciar sesión'});";
    $error = "M.toast({html: 'Ups! algo salió mal'});";
    $success = "M.toast({html: 'Producto eliminado del carrito'});";
    
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
    
    // Primero obtenemos el id_carrito del usuario
    $query_carrito = query($conn, "SELECT id_carrito FROM carritos WHERE id_usuario = $id_usuario");
    $carrito = mysqli_fetch_assoc($query_carrito);
    
    if($carrito) {
        $id_carrito = $carrito['id_carrito'];
        // Eliminar el producto del carrito
        $resultado = query($conn, "DELETE FROM items_carrito 
                                 WHERE id_carrito = $id_carrito 
                                 AND id_producto = $id_producto");
        
        if ($resultado) {
            // Verificar si el carrito quedó vacío
            $check_empty = query($conn, "SELECT COUNT(*) as count FROM items_carrito WHERE id_carrito = $id_carrito");
            $items_count = mysqli_fetch_assoc($check_empty)['count'];
            
            if($items_count == 0) {
                // Si el carrito está vacío, opcionalmente podemos eliminar el registro del carrito
                query($conn, "DELETE FROM carritos WHERE id_carrito = $id_carrito");
            }
            
            // redireccionar con alerta de éxito
            redirect("../carrito.php", $success);
        } else {
            // redireccionar con alerta de error
            redirect("../carrito.php", $error);
        }
    } else {
        // redireccionar con alerta de error
        redirect("../carrito.php", $error);
    }
?>