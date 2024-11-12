<?php 
  // codigo inicial de verificacion de sesion:
  // si ya hay sesion iniciada, redirigimos al dashboard
  // iniciamos el mecanismo de sesiones
  session_start();

  // Verificar si no existe una sesión iniciada
  if(isset($_SESSION['id_usuario'])) {
    // redirigir a la galeria
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php require "components/meta.php"; ?>
  <style>
    body {
      background-color: #fafafa;
    }
    .registration-card {
      background: white;
      padding: 30px;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-top: 50px;
    }
    .input-field label {
      color: #757575;
    }
    .input-field input:focus + label {
      color: #424242 !important;
    }
    .input-field input:focus {
      border-bottom: 1px solid #424242 !important;
      box-shadow: 0 1px 0 0 #424242 !important;
    }
    .helper-text {
      color: #9e9e9e;
    }
    .btn-register {
      width: 100%;
      margin-top: 20px;
    }
    .registration-title {
      color: #212121;
      margin-bottom: 30px;
    }
    .terms-text {
      margin-top: 20px;
      color: #757575;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="space"></div>
  <div class="space"></div>

  <div class="container">
    <div class="row">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="registration-card">
          <h4 class="center-align registration-title">Crear Cuenta</h4>
          
          <form id="registration-form" method="POST" action="actions/signup.php">
            <!-- Username Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">person</i>
              <input name="username" id="username" type="text" class="validate" required value="<?php echo isset($_GET['username']) ? $_GET['username'] : ""; ?>">
              <label for="username">Nombre</label>
              <span class="helper-text" data-error="Nombre requerido">¿Cómo te llamas?</span>
            </div>

            <!-- Email Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">email</i>
              <input id="email" name="email" type="email" class="validate" required value="<?php echo isset($_GET['email']) ? $_GET['email'] : ""; ?>">
              <label for="email">Email</label>
              <span class="helper-text" data-error="Ingresa un email válido">Tu correo electrónico</span>
            </div>

            <!-- Password Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">lock</i>
              <input id="password" name="password" type="password" class="validate" required minlength="8">
              <label for="password">Contraseña</label>
              <span class="helper-text">Mínimo 8 characteres</span>
            </div>

            <!-- Confirm Password Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">lock_outline</i>
              <input id="confirm_password" name="second" type="password" class="validate" required>
              <label for="confirm_password">Confirma la contraseña</label>
              <span class="helper-text" data-error="Las contraseñas no coinciden">Repite tu contraseña</span>
            </div>

            <!-- Terms and Conditions Checkbox -->
            <label class="grey-text">
              <input type="checkbox" name="terms">
              <span>Acepto los terminos y condiciones</span>
            </label>

            <!-- Submit Button -->
            <button class="btn black waves-effect waves-light btn-register" type="submit">
              Crear Cuenta
              <i class="material-icons right">send</i>
            </button>

            <!-- Additional Information -->
            <p class="center-align terms-text">
              ¿Ya tienes cuenta? <a href="login.php" class="grey-text text-darken-3">Inicia Sesión</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require "components/alert.php"; ?>

</body>
</html>