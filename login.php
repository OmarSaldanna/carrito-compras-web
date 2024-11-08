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
    .login-card {
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
    .btn-login {
      width: 100%;
      margin-top: 20px;
    }
    .login-title {
      color: #212121;
      margin-bottom: 30px;
    }
    .additional-links {
      margin-top: 20px;
      color: #757575;
      font-size: 0.9rem;
    }
    .remember-me {
      margin-top: 15px;
    }
  </style>
</head>
<body>
  
  <div class="space"></div>
  <div class="space"></div>

  <div class="container">
    <div class="row">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="login-card">
          <h4 class="center-align login-title">Iniciar Sesión</h4>
          
          <form id="login-form" action="actions/login.php" method="POST">
            <!-- Email/Username Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">person</i>
              <input id="user_email" name="email" type="text" class="validate" required>
              <label for="user_email">Email o nombre de usuario</label>
              <span class="helper-text" data-error="Este campo es requerido">Ingresa tu email o nombre de usuario</span>
            </div>

            <!-- Password Field -->
            <div class="input-field">
              <i class="material-icons prefix grey-text">lock</i>
              <input id="password" name="password" type="password" class="validate" required>
              <label for="password">Contraseña</label>
              <span class="helper-text" data-error="Este campo es requerido">Ingresa tu contraseña</span>
            </div>

            <!-- Remember Me Checkbox -->
            <label class="grey-text remember-me">
              <input type="checkbox" name="remember">
            </label>

            <!-- Submit Button -->
            <button class="btn black waves-effect waves-light btn-login" type="submit">
              Iniciar Sesión
              <i class="material-icons right">login</i>
            </button>

            <!-- Additional Links -->
            <div class="center-align additional-links">
              <p>
                <a href="#" class="grey-text text-darken-3">¿Olvidaste tu contraseña?</a>
              </p>
              <p>
                ¿No tienes cuenta? <a href="signup.php" class="grey-text text-darken-3">Regístrate</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require "components/alert.php"; ?>

</body>
</html>