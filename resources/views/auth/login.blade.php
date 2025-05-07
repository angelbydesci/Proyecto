{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/css/login.css', 'resources/js/app.js'])
</head>
<body>
  <div class="login-container"> 
    <div class="hands-effect"></div>
    
    <div class="login-box">
      <div class="logo-container">
        <video autoplay muted loop playsinline width="120" height="120">
          <source src="https://cdnl.iconscout.com/lottie/premium/thumb/planning-animated-icon-download-in-lottie-json-gif-static-svg-file-formats--business-strategy-management-vol-1-pack-icons-7961250.mp4" type="video/mp4">
          Tu navegador no soporta el video.
        </video>
      </div>
      <h1>Gestión PlanificaTI</h1>
      <h2>Iniciar Sesión</h2>

      @if ($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="tu@email.com">
        </div>

        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" name="password" id="password" required placeholder="••••••••">
        </div>

        <button type="submit">Entrar</button>
      </form>

      <div class="links">
        <a href="#">¿Olvidaste tu contraseña?</a>
        <a href="#">¿No tienes una cuenta? Regístrate</a>
      </div>
    </div>
  </div>
</body>
</html>