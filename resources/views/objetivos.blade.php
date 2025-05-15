{{-- resources/views/objetivos.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="container">
    <!-- Título -->
    <h2>OBJETIVOS ESTRATEGICOS</h2>
    
    <!-- Primer párrafo -->
    <p>El siguiente paso es establecer los objetivos de una empresa en relación al sector al que pertenece.</p>
    
    <!-- Explicación objetivos estratégicos -->
    <div class="mb-4">
        <p>Un <strong>OBJETIVO ESTRATÉGICO</strong> es un fin deseado, clave para la organización y para la consecución de su visión. Para una correcta planificación construya los objetivos formando una pirámide. Los objetivos de cada nivel indican qué es lo que quiere lograrse, siendo la estructura de objetivos que está en el nivel inmediatamente inferior la que indica el cómo. Por tanto, cada objetivo es un fin en sí mismo, pero también a la vez un medio para el logro de los objetivos del nivel superior.</p>
    </div>

    <!-- Espacio para imagen (se implementará después) -->
    <div class="text-center my-4 p-3 border rounded bg-light">
        <p class="text-muted">[Espacio para imagen de pirámide de objetivos]</p>
    </div>

    <!-- Tipos de objetivos -->
    <div class="mb-4">
        <h4>Objetivos estratégicos:</h4>
        <p>Concretan el contenido de la misión. Suelen referirse al crecimiento, rentabilidad y a la sostenibilidad de la empresa. Su horizonte es entre 3 a 5 años.</p>
        
        <h4>Objetivos operativos:</h4>
        <p>Son la concreción anual de los objetivos estratégicos. Han de ser claros, concisos y medibles. Se puede distinguir dos tipos de objetivos específicos:</p>
        <ol>
            <li><strong>Funcionales:</strong> objetivos formulados por áreas o departamentos</li>
            <li><strong>Operativos:</strong> objetivos que se centran en operaciones y acciones concretas</li>
        </ol>
        <p>Cualquier objetivo formulado tiene que presentar los siguientes atributos:</p>
    </div>

    <!-- Tabla METAS -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th style="width: 10%">Letra</th>
                    <th>Atributo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>M</strong></td>
                    <td>MEDIBLES: que se les pueda asignar indicadores cuantitativos</td>
                </tr>
                <tr>
                    <td><strong>E</strong></td>
                    <td>ESPECÍFICOS: que sean enunciados de forma clara, breve y comprensible</td>
                </tr>
                <tr>
                    <td><strong>T</strong></td>
                    <td>TRAZABLES: que permita un registro de seguimiento y control</td>
                </tr>
                <tr>
                    <td><strong>A</strong></td>
                    <td>ALCANZABLES: realistas y motivadores</td>
                </tr>
                <tr>
                    <td><strong>S</strong></td>
                    <td>SENSATOS: lógicos y consecuentes con los recursos disponibles</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- Sección de Ejemplos --}}
    <div class="mb-4">
        <h3>EJEMPLOS</h3>
        <ul class="list-unstyled">
            <li>· Alcanzar los niveles de ventas previstos para los nuevos productos</li>
            <li>· Reducir la rotación del personal del almacén</li>
            <li>· Reducir el plazo de cobro de los clientes</li>
            <li>· Reducir la siniestralidad al nivel fijado</li>
            <li>· Alcanzar los objetivos de beneficios previstos</li>
            <li>· Mejorar la claridad de entrega de los productos en el plazo previsto</li>
        </ul>
    </div>

    {{-- Sección sobre Unidades Estratégicas de Negocio --}}
    <div class="mb-4 p-3 bg-light rounded">
        <p>En empresas de gran tamaño, se pueden formular los objetivos estratégicos en función de sus diferentes unidades estratégicas de negocio (UEN). Estas UEN se hacen especialmente necesarias en las empresas diversificadas o con multiactividad donde la heterogeneidad de los distintos negocios hace inviable un tratamiento estratégico conjunto de los mismos.</p>

        <p>Se entiende por unidad estratégica de negocio (UEN) ("strategic business unit" [SBU]) un conjunto homogéneo de actividades o negocios, desde el punto de vista estratégico, es decir, para el cual es posible formular una estrategia común y a su vez diferente de la estrategia adecuada para otras actividades y/o unidades estratégicas. La estrategia de cada unidad es autónoma, pero no independiente de las demás unidades estratégicas, puesto que se integran en la estrategia de la empresa.</p>
    </div>

    {{-- Sección de identificación de UEN --}}
    <div class="mb-4">
        <h4>¿Cómo podemos identificar a las UEN?</h4>
        <p>La identificación de las UEN se puede realizar a partir de las tres siguientes dimensiones:</p>
        <ul>
            <li><strong>Grupos de clientes:</strong> Que atiende al tipo de clientela al cual va destinado el producto o servicio.</li>
            <li><strong>Funciones:</strong> Necesidades cubiertas por el producto o servicio.</li>
            <li><strong>Tecnología:</strong> Forma en la cual la empresa cubre a través del producto o servicio la necesidad de la clientela.</li>
        </ul>
    </div>
    {{-- Sección de reflexión y objetivos --}}
    <div class="mb-4 p-3 border rounded">
        <h4>En su caso, comente en este apartado las distintas UEN que tiene su empresa</h4>
        
        <form action="{{ route('proyectos.updateUnidadesEstrategicas', $proyecto) }}" method="POST" class="mb-4">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <textarea name="unidades_estrategicas" class="form-control" rows="3" placeholder="Describa las Unidades Estratégicas de Negocio de su empresa...">{{ old('unidades_estrategicas', $proyecto->unidades_estrategicas ?? '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Guardar Unidades Estratégicas</button>
        </form>

        {{-- Mostrar mensajes de éxito/error para UEN --}}
        @if (session('success_uen'))
            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                {{ session('success_uen') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Mostrar errores de validación generales (si los hubiera de este formulario) --}}
        @if ($errors->has('unidades_estrategicas'))
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                {{ $errors->first('unidades_estrategicas') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any() && !$errors->has('unidades_estrategicas') && old('unidades_estrategicas') !== null)
            {{-- Esto es para el caso de que haya errores de otro formulario y este se haya intentado enviar.
                 Podría ser más específico si se identifican los formularios.
                 Por ahora, si hay errores y este campo fue enviado, mostramos una alerta genérica.
                 Si solo hay un formulario que pueda dar error en esta página aparte de los objetivos principales,
                 podríamos ser más específicos.
            --}}
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                Hubo un error al procesar la solicitud. Por favor, revisa los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h4>A continuación reflexione sobre la misión, visión y valores definidos y establezca los objetivos estratégicos y específicos de su empresa. Le proponemos que comience con definir 3 objetivos estratégicos y dos específicos para cada uno de ellos</h4>

<div class="container">
    <h2 class="text-center">Gestión de Objetivos Estratégicos</h2>
    <!-- Formulario para añadir un nuevo objetivo principal -->
    <div class="card mb-4">
        <div class="card-header">Añadir Nuevo Objetivo Estratégico</div>
        <div class="card-body">
            <form action="{{ route('objetivos.storePrincipal', $proyecto) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea name="objetivo_principal" class="form-control" rows="2" placeholder="Describa el objetivo estratégico..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar Objetivo Estratégico</button>
            </form>
        </div>
    </div>

    <!-- Lista de objetivos principales y sus objetivos específicos -->
    @if ($proyecto->objetivosPrincipales && $proyecto->objetivosPrincipales->count() > 0)
        @foreach ($proyecto->objetivosPrincipales as $objetivoPrincipal)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form action="{{ route('objetivos.updatePrincipal', $objetivoPrincipal) }}" method="POST" class="d-flex w-100">
                        @csrf
                        @method('PUT')
                        <input type="text" name="objetivo_principal" class="form-control me-2" value="{{ $objetivoPrincipal->objetivo }}" required>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                    <form action="{{ route('objetivos.destroyPrincipal', $objetivoPrincipal) }}" method="POST" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
                <div class="card-body">
                    <!-- Formulario para añadir un objetivo específico -->
                    <form action="{{ route('objetivos.storeEspecifico', $objetivoPrincipal) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="objetivo_especifico" class="form-control" placeholder="Añadir objetivo específico..." required>
                            <button type="submit" class="btn btn-success">Añadir</button>
                        </div>
                    </form>

                    <!-- Lista de objetivos específicos -->
                    @if ($objetivoPrincipal->objetivosEspecificos && $objetivoPrincipal->objetivosEspecificos->count() > 0)
                        <ul class="list-group">
                            @foreach ($objetivoPrincipal->objetivosEspecificos as $objetivoEspecifico)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <form action="{{ route('objetivos.updateEspecifico', $objetivoEspecifico) }}" method="POST" class="d-flex w-100">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="objetivo_especifico" class="form-control me-2" value="{{ $objetivoEspecifico->objetivo }}" required>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                    <form action="{{ route('objetivos.destroyEspecifico', $objetivoEspecifico) }}" method="POST" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay objetivos específicos para este objetivo estratégico.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">Aún no se han añadido objetivos estratégicos para este proyecto.</p>
    @endif
</div>

