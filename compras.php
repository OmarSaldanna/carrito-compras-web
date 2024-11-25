<?php
    // importar los modulos de db
    require 'actions/db.php';
    // Iniciar la sesión 
    session_start();
    
    ////////////////////////////// Alertas ////////////////////////////
    $not_session = "M.toast({html: 'Antes tienes que iniciar sesión'});";
    
    ////////////////////////////// Comprobaciones ////////////////////////////
    // si no hay sesión
    if(!isset($_SESSION['id_usuario'])) {
        // redireccionar con alerta
        redirect("index.php", $not_session);
    }
    
    ////////////////////////////// Acciones ////////////////////////////
    // conectar a la base de datos
    $conn = connect_db();
    $id_usuario = $_SESSION['id_usuario'];
    
    // Obtener todas las compras del usuario con sus detalles e información de productos
    $query = "SELECT c.id_compra, c.fecha_compra, c.total, c.estado,
                     d.cantidad, d.precio_unitario,
                     p.imagen_url, p.categorias
              FROM compras c
              JOIN detalles_compra d ON c.id_compra = d.id_compra
              JOIN productos p ON d.id_producto = p.id_producto
              WHERE c.id_usuario = $id_usuario
              ORDER BY c.fecha_compra DESC";
    
    $resultado = query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require "components/meta.php"; ?>
    <style>
        .purchase-card {
            height: 100%;
        }
        .purchase-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .purchase-info {
            padding: 10px !important;
        }
        .category-chip {
            margin: 2px;
        }
        .date-badge {
            position: absolute;
            right: 10px;
            top: 10px;
            background: rgba(0,0,0,0.5);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
</head>
<body>

<?php require "components/navbar.php"; ?>

<div class="space"></div>

<div class="container">
    <div class="row">
        <div class="col s12">
            <h2 class="center-align">Mis Imágenes Compradas</h2>
        </div>
    </div>

    <div class="space"></div>

    <div class="row">
        <?php if(mysqli_num_rows($resultado) > 0): ?>
            <?php while($compra = mysqli_fetch_assoc($resultado)): ?>
                <div class="col s12 m6 l4">
                    <div class="card purchase-card">
                        <div class="card-image">
                            <img src="stock/<?php echo htmlspecialchars($compra['imagen_url']); ?>" 
                                 alt="Imagen comprada" 
                                 class="purchase-image">
                            <span class="date-badge">
                                <?php echo date('d/m/Y', strtotime($compra['fecha_compra'])); ?>
                            </span>
                        </div>
                        <div class="card-content purchase-info">
                            <div class="purchase-details">
                                <p>
                                    <i class="material-icons tiny">attach_money</i>
                                    Precio: $<?php echo number_format($compra['precio_unitario'], 2); ?>
                                </p>
                            </div>
                            <div class="categories">
                                <?php 
                                    $categorias = explode(',', $compra['categorias']);
                                    foreach($categorias as $categoria): 
                                        $categoria = trim($categoria);
                                        if(!empty($categoria)):
                                ?>
                                    <div class="chip category-chip">
                                        <?php echo htmlspecialchars($categoria); ?>
                                    </div>
                                <?php 
                                        endif;
                                    endforeach; 
                                ?>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="<?php echo htmlspecialchars($compra['imagen_url']); ?>" 
                               download
                               class="waves-effect waves-light btn-small black">
                                <i class="material-icons left">file_download</i>
                                Descargar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col s12">
                <div class="card-panel center-align">
                    <i class="material-icons medium">shopping_basket</i>
                    <p>Aún no has comprado ninguna imagen.</p>
                    <a href="galeria.php" class="waves-effect waves-light btn">
                        Ir a la galería
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require "components/alert.php"; ?>

</body>
</html>