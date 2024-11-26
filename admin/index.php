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
	$result = query($conn, "Select * from productos");

	// en caso de edits
	$edit = isset($_GET['action']);

?>
<!DOCTYPE html>
<html>
<head>
	<?php require "../components/meta.php"; ?>
	<title>Admin</title>
</head>
<body>

	<!-- titulo -->
	<div class="row">
		<div class="container center">
			<h2>Panel de Administración</h2>
		</div>
	</div>

	<!-- formulario -->

	<div class="row">
		<div class="col s10 offset-s1">
			<div class="row">
			    <form class="col s12" action="actions.php" method="GET">
			      <div class="row">
			      	<?php echo $edit ? '<input name="id_producto" class="hide" value="'.$_GET['id_producto'].'">' : ""; ?>
			      	
			        <div class="input-field col s6">
			          <input value="<?php echo $edit ? $_GET['precio'] : ""; ?>" placeholder="Placeholder" id="precio" type="number" class="validate" name="precio">
			          <label for="precio">Precio</label>
			        </div>
			        <div class="input-field col s6">
			          <input value="<?php echo $edit ? $_GET['categorias'] : ""; ?>" id="categorias" type="text" class="validate" name="categorias">
			          <label for="categorias">Categorías</label>
			        </div>
			        <div class="input-field col s12">
			          <input value="<?php echo $edit ? $_GET['imagen_url'] : ""; ?>" id="imagen" type="text" class="validate" name="imagen_url">
			          <label for="imagen">Path de la imagen</label>
			        </div>
			      </div>

			      <div class="row">
			      	<div class="col s4 offset-s1">
			      		<button class="btn waves-effect waves-light" type="submit" name="action" value="create" <?php echo $edit ? "disabled" : ""; ?>>Crear
    						<i class="material-icons right">send</i>
  						</button>
			      	</div>
			      	<div class="col s4 offset-s1">
			      		<button class="btn waves-effect waves-light blue" type="submit" name="action" value="edit" <?php echo $edit ? "" : "disabled"; ?>>Guardar
    						<i class="material-icons right">send</i>
  						</button>
  						<a href="index.php" class="btn waves-effect waves-light red" type="submit" name="action" value="edit" <?php echo $edit ? "" : "disabled"; ?>>Cancelar
    						<i class="material-icons right">close</i>
  						</a>
			      	</div>
			      </div>
			    </form>
			  </div>
		</div>
	</div>


	<!-- tabla -->
	<div class="row">
		<div class="col l8 offset-l2 s12">
			<table class="striped">
		        <thead>
		          <tr>
		              <th>Id</th>
		              <th>Precio</th>
		              <th>Categorías</th>
		              <th>Imagen</th>
		              <th>Acciones</th>
		          </tr>
		        </thead>

		        <tbody>
					<?php
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['id_producto']) . '</td>';
							echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
							echo '<td>' . htmlspecialchars($row['categorias']) . '</td>';
							echo '<td>stock/' . htmlspecialchars($row['imagen_url']) . '</td>';
							echo '<td><!-- acciones aquí --></td>';
							echo '<td>
						          	<a class="waves-effect waves-light btn blue" href="?id='. $row['id_producto'] .'&action=edit&precio='.$row['precio'].'&categorias='.$row['categorias'].'&imagen_url='.$row['imagen_url'].'&id_producto='.$row['id_producto'].'">Actualizar</a>
						          	<a class="waves-effect waves-light btn red" href="actions.php?id_producto='. $row['id_producto'] .'&action=remove">Eliminar</a>
						          </td>';

							echo '</tr>';
						}
					?>
		          </tr>
		        </tbody>
		      </table>
		</div>
	</div>


	<!-- alertas -->
	<?php require "../components/alert.php"; ?>
</body>
</html>