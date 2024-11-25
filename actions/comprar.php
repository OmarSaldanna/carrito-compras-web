<?php
    // importar los modulos de db
    require 'db.php';
    // Iniciar la sesión 
    session_start();
    
    ////////////////////////////// Alertas ////////////////////////////
    $not_session = "M.toast({html: 'Antes tienes que iniciar sesión'});";
    $error = "M.toast({html: 'Ups! algo salió mal con tu compra'});";
    $empty_cart = "M.toast({html: 'Tu carrito está vacío'});";
    $success = "M.toast({html: 'Compra realizada con éxito'});";
    
    ////////////////////////////// Comprobaciones ////////////////////////////
    
    // si no hay sesión
    if(!isset($_SESSION['id_usuario'])) {
        // redireccionar con alerta
        redirect("../index.php", $not_session);
    }
    
    ////////////////////////////// Acciones ////////////////////////////
    
    // conectar a la base de datos
    $conn = connect_db();
    
    // Iniciar transacción para asegurar la integridad de los datos
    mysqli_begin_transaction($conn);
    
    try {
        // obtener datos necesarios
        $id_usuario = $_SESSION['id_usuario'];
        
        // Obtener el carrito activo del usuario
        $query_carrito = query($conn, "SELECT id_carrito FROM carritos WHERE id_usuario = $id_usuario");
        $carrito = mysqli_fetch_assoc($query_carrito);
        
        if(!$carrito) {
            // Si no hay carrito, redirigir con mensaje
            redirect("../carrito.php", $empty_cart);
        }
        
        $id_carrito = $carrito['id_carrito'];
        
        // Calcular el total de la compra
        $query_total = query($conn, "SELECT SUM(cantidad * precio_unitario) as total 
                                   FROM items_carrito 
                                   WHERE id_carrito = $id_carrito");
        $total = mysqli_fetch_assoc($query_total)['total'];
        
        // Crear nuevo registro en la tabla compras
        $query_compra = query($conn, "INSERT INTO compras (id_usuario, total, estado) 
                                    VALUES ($id_usuario, $total, 'completada')");
        
        if(!$query_compra) {
            throw new Exception("Error al crear la compra");
        }
        
        $id_compra = mysqli_insert_id($conn);
        
        // Transferir items del carrito a detalles_compra
        $query_transfer = query($conn, "INSERT INTO detalles_compra 
                                      (id_compra, id_producto, cantidad, precio_unitario)
                                      SELECT $id_compra, id_producto, cantidad, precio_unitario
                                      FROM items_carrito
                                      WHERE id_carrito = $id_carrito");
        
        if(!$query_transfer) {
            throw new Exception("Error al transferir items");
        }
        
        // Eliminar el carrito (esto eliminará también los items_carrito por el ON DELETE CASCADE)
        $query_delete = query($conn, "DELETE FROM carritos WHERE id_carrito = $id_carrito");
        
        if(!$query_delete) {
            throw new Exception("Error al eliminar el carrito");
        }
        
        // Si todo salió bien, confirmar la transacción
        mysqli_commit($conn);
        
        // Redireccionar con mensaje de éxito
        redirect("../compras.php", $success);
        
    } catch (Exception $e) {
        // Si algo salió mal, revertir todos los cambios
        mysqli_rollback($conn);
        
        // Redireccionar con mensaje de error
        redirect("../carrito.php", $error);
    }
?>