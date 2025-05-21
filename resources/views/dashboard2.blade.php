<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Opciones</title>
    @vite(['resources/css/dashboard2.css'])
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300" rel="stylesheet">
    <style>
        /* Estilo para el iframe */
        #content-frame {
            margin-left: 260px; /* Espacio para la barra lateral */
            width: calc(100% - 260px); /* Ajusta el ancho del iframe */
            height: 100vh; /* Ocupa toda la altura de la ventana */
            border: none; /* Sin bordes */
        }
    </style>
</head>
<body>
    <div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-folder fa-2x"></i>
                    <span class="nav-text">Proyectos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showMision', $proyecto) }}" target="content-frame">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">1. MISIÓN</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showVision', $proyecto) }}" target="content-frame">
                    <i class="fa fa-eye fa-2x"></i>
                    <span class="nav-text">2. VISIÓN</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.valores.index', $proyecto) }}" target="content-frame">
                    <i class="fa fa-heart fa-2x"></i>
                    <span class="nav-text">3. VALORES</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showObjetivos', $proyecto) }}" target="content-frame">
                    <i class="fa fa-bullseye fa-2x"></i>
                    <span class="nav-text">4. OBJETIVOS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showAnalisisInterno', $proyecto) }}" target="content-frame">
                    <i class="fa fa-search fa-2x"></i>
                    <span class="nav-text">5. ANÁLISIS INTERNO</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showCadenaDeValor', $proyecto) }}" target="content-frame">
                    <i class="fa fa-link fa-2x"></i>
                    <span class="nav-text">6. CADENA DE VALOR</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showAutodiagnosticoCadenaDeValor', $proyecto) }}" target="content-frame">
                    <i class="fa fa-stethoscope fa-2x"></i> {{-- Icono sugerido para autodiagnóstico --}}
                    <span class="nav-text">6.1 AUTODIAGNÓSTICO C.V.</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showMatrizParticipacion', $proyecto) }}" target="content-frame">
                    <i class="fa fa-table fa-2x"></i>
                    <span class="nav-text">7. MATRIZ PARTICIPACIÓN</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showAutodiagnosticoBCG', $proyecto) }}" target="content-frame">
                    <i class="fa fa-tasks fa-2x"></i> {{-- Icono cambiado --}}
                    <span class="nav-text">7.1 AUTODIAGNÓSTICO BCG</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showLas5Fuerzas', $proyecto) }}" target="content-frame">
                    <i class="fa fa-sitemap fa-2x"></i> {{-- Icono cambiado a fa-sitemap --}}
                    <span class="nav-text">8. LAS 5 FUERZAS DE PORTER</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showAutodiagnosticoPorter', $proyecto) }}" target="content-frame">
                    <i class="fa fa-search-plus fa-2x"></i> {{-- Icono sugerido para autodiagnóstico Porter --}}
                    <span class="nav-text">8.1 AUTODIAGNÓSTICO PORTER</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showPest', $proyecto) }}" target="content-frame">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text">9. PEST</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showEstrategia', $proyecto) }}" target="content-frame">
                    <i class="fa fa-lightbulb-o fa-2x"></i>
                    <span class="nav-text">10. ESTRATEGIA</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyectos.showMatrizCame', $proyecto) }}" target="content-frame">
                    <i class="fa fa-th fa-2x"></i>
                    <span class="nav-text">11. MATRIZ CAME</span>
                </a>
            </li>
        </ul>
        <ul class="logout">
    <li>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off fa-2x"></i>
            <span class="nav-text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
    </nav>

    <!-- Iframe donde se cargará el contenido -->
    <iframe id="content-frame" name="content-frame" src=""></iframe>
</body>
</html>