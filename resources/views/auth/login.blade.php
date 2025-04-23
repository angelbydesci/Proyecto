<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: Arial, sans-serif;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
      background-size: cover;
      background-position: center;
      opacity: 0.3;
      animation: mover 30s ease-in-out infinite alternate;
      z-index: -1;
    }

    @keyframes mover {
      0% { background-position: center top; }
      100% { background-position: center bottom; }
    }

    .login-container {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      position: relative;
    }

    /* Efecto de manos mejorado */
    .hands-effect {
      position: absolute;
      width: 500px;
      height: 500px;
      background: url('https://media.tenor.com/5C4z4y9X9yAAAAAM/hands-up.gif') center/contain no-repeat;
      opacity: 0.5;
      z-index: 0;
      animation: float 4s ease-in-out infinite, pulse 2s ease-in-out infinite;
      pointer-events: none;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-10px) scale(1.02); }
    }

    @keyframes pulse {
      0%, 100% { opacity: 0.4; }
      50% { opacity: 0.6; }
    }

    .login-box {
  background: rgba(255, 255, 255, 0.95);
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4); /* sombra más intensa */
  width: 100%;
  max-width: 400px;
  position: relative;
  z-index: 1;
  backdrop-filter: blur(2px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

    h1, h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    h1 {
      font-size: 28px;
      color: #007bff;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #555;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 16px;
      transition: border 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }

    button {
      margin-top: 25px;
      width: 100%;
      padding: 14px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: bold;
    }

    button:hover {
      background-color: #0069d9;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .error-messages {
      margin-top: 20px;
      background-color: rgba(255, 0, 0, 0.1);
      color: #b00020;
      padding: 12px;
      border-left: 4px solid red;
      border-radius: 6px;
      font-size: 14px;
    }

    .links {
      margin-top: 25px;
      text-align: center;
    }

    .links a {
      color: #007bff;
      text-decoration: none;
      display: block;
      margin: 10px 0;
      font-size: 14px;
      transition: color 0.2s;
    }

    .links a:hover {
      color: #0056b3;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="hands-effect"></div>
    
    <div class="login-box">
  <div style="text-align: center; margin-bottom: 20px;">
    <video autoplay muted loop playsinline width="120" height="120" style="border-radius: 12px;">
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
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="tu@email.com">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required placeholder="••••••••">

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