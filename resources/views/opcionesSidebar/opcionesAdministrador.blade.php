<li>
    <div class="user-info">
        <div class="detail">
            <span>Administrador</span>
        </div>
    </div>
</li>

<!-- Modificar despues este request-->
<li class="{{ Request::segment(1) === 'roles' || Request::segment(1) === 'usuarios' ? 'active open' : null }}">
    <a href="#" class="menu-toggle"><i class="zmdi zmdi-accounts-list"></i> <span>Admin. Usuarios</span></a>
    <ul class="ml-menu">
        <!--Poner las rutas asi en el href de cada etiqueta a {{--route('app.inbox')--}} -->
        <li class="{{ Request::segment(1) === 'roles' ? 'active' : null }}"><a href="{{url('roles')}}">Roles</a></li>
        <li class="{{ Request::segment(1) === 'usuarios' ? 'active' : null }}"><a href="{{url('usuarios')}}">Usuarios</a></li>
            <!-- Dejo el enlace a calendar para fijarnos -->
            <!-- <li class="{{ Request::segment(2) === 'calendar' ? 'active' : null }}"><a href="{{route('app.calendar')}}">Calendar</a></li>  -->
    </ul>
</li>

<li class="{{ Request::segment(1) === 'admin-lentes' ? 'active open' : null }}">
    <a href="#" class="menu-toggle"><i class="zmdi zmdi-flickr"></i> <span>Admin. Marcos</span></a>
    <ul class="ml-menu">
        <li class="{{ Request::segment(2) === 'marcas' ? 'active' : null }}"><a href="{{url('admin-lentes/marcas')}}">Marcas</a></li>
        <li class="{{ Request::segment(2) === 'marcos' ? 'active' : null }}"><a href="{{url('admin-lentes/marcos')}}">Marcos</a></li>
        <li class="{{ Request::segment(2) === 'tipos-marcos' ? 'active' : null }}"><a href="{{url('admin-lentes/tipos-marcos')}}">Estilos de Marcos</a></li>
    </ul>
</li>

<li class="{{ Request::segment(1) === 'admin-materiales' ? 'active open' : null }}">
    <a href="#" class="menu-toggle">
        <i class="zmdi zmdi-shopping-basket"></i>
        <span>Admin. Materiales</span>
    </a>
    <ul class="ml-menu">
        <li class="{{ Request::segment(2) === 'tipos-lentes' ? 'active' : null }}"><a href="{{url('admin-materiales/tipos-lentes')}}">Tipos de Lentes</a></li>
        <li class="{{ Request::segment(2) === 'marcas-materiales' ? 'active' : null }}"><a href="{{url('admin-materiales/marcas-materiales')}}">Marcas de Materiales</a></li>
        <li class="{{ Request::segment(2) === 'materiales' ? 'active' : null }}"><a href="{{url('admin-materiales/materiales')}}">Materiales Micas</a></li>
        <li class="{{ Request::segment(2) === 'filtros' ? 'active' : null }}"><a href="{{url('admin-materiales/filtros')}}">Filtros</a></li>
    </ul>
</li>

<li class="{{Request::segment(1) === 'planpago' ? 'active' : null}}">
    <a href="{{url('planpago')}}"><i class="zmdi zmdi-card"></i><span>Planes de Pago</span></a>
</li>
<li class="{{ Request::segment(1) === 'servicios' ? 'active' : null}}">
    <a href="{{url('servicios')}}"><i class="zmdi zmdi-assignment"></i><span>Servicios</span></a>
</li>

<li class="{{ Request::segment(1) === '' ? 'active' : null }}">
    <a href="#"><i class="zmdi zmdi-chart"></i><span>Estadisticas</span></a>
</li>
<li class="{{ Request::segment(1) === '' ? 'active' : null}}">
    <a href="#"><i class="zmdi zmdi-print"></i><span>Reportes</span></a>
</li>
