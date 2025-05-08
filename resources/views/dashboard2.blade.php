<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Opciones</title>
    @vite(['resources/css/dashboard2.css'])
</head>
<body>

    <div class="titulo">INFORMACIÓN DE LA EMPRESA</div>

    <div class="links">
      <ul class="links__list" style="--item-total:11">
        <li class="links__item" style="--item-count:1">
          <a class="links__link" href="{{ route('proyectos.showMision', $proyecto) }}">
            <span class="links__text">1. MISIÓN</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:2">
          <a class="links__link" href="{{ route('proyectos.showVision', $proyecto) }}">
            <span class="links__text">2. VISIÓN</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:3">
          <a class="links__link" href="{{ route('proyectos.valores.index', $proyecto) }}">
            <span class="links__text">3. VALORES</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:4">
          <a class="links__link" href="{{ route('proyectos.showObjetivos', $proyecto) }}">
            <span class="links__text">4. OBJETIVOS</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:5">
          <a class="links__link" href="{{ route('proyectos.showAnalisisInterno', $proyecto) }}">
            <span class="links__text">5. ANÁLISIS INTERNO</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:6">
          <a class="links__link" href="{{ route('proyectos.showCadenaDeValor', $proyecto) }}">
            <span class="links__text">6. CADENA DE VALOR</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:7">
          <a class="links__link" href="{{ route('proyectos.showMatrizParticipacion', $proyecto) }}">
            <span class="links__text">7. MATRIZ PARTICIPACIÓN</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:8">
          <a class="links__link" href="{{ route('proyectos.showLas5Fuerzas', $proyecto) }}">
            <span class="links__text">8. 5 FUERZAS PORTER</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:9">
          <a class="links__link" href="{{ route('proyectos.showPest', $proyecto) }}">
            <span class="links__text">9. PEST</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:10">
          <a class="links__link" href="{{ route('proyectos.showEstrategia', $proyecto) }}">
            <span class="links__text">10. ESTRATEGIA</span>
          </a>
        </li>
        <li class="links__item" style="--item-count:11">
          <a class="links__link" href="{{ route('proyectos.showMatrizCame', $proyecto) }}">
            <span class="links__text">11. MATRIZ CAME</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="titulo">RESUMEN DEL PLAN EJECUTIVO</div>

</body>
</html>