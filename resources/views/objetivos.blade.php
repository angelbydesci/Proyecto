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
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 25%">MISIÓN</th>
                        <th style="width: 35%">OBJETIVOS GENERALES O ESTRATÉGICOS</th>
                        <th style="width: 40%">OBJETIVOS ESPECÍFICOS</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Fila 1 --}}
                    <tr>
                        <td rowspan="2">
                            <textarea class="form-control border-0" rows="4" placeholder="Describa su misión"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control border-0" rows="2" placeholder="Objetivo estratégico 1"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control border-0" rows="1" placeholder="Objetivo específico 1.1"></textarea>
                            <textarea class="form-control border-0 mt-2" rows="1" placeholder="Objetivo específico 1.2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control border-0" rows="2" placeholder="Objetivo estratégico 2"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control border-0" rows="1" placeholder="Objetivo específico 2.1"></textarea>
                            <textarea class="form-control border-0 mt-2" rows="1" placeholder="Objetivo específico 2.2"></textarea>
                        </td>
                    </tr>
                    {{-- Fila 2 --}}
                    <tr>
                        <td>
                            <textarea class="form-control border-0" rows="2" placeholder="Objetivo estratégico 3"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control border-0" rows="1" placeholder="Objetivo específico 3.1"></textarea>
                            <textarea class="form-control border-0 mt-2" rows="1" placeholder="Objetivo específico 3.2"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
