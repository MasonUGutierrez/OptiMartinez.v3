<li>
    <div class="user-info">
        <div class="detail">
            <span>Administrador</span>
        </div>
    </div>
</li>

<!-- Modificar despues este request-->
<li class="{{ Request::segment(1) === '' ? 'active open' : null }}">
    <a href="#" class="menu-toggle"><i class="zmdi zmdi-accounts-list"></i> <span>Admin. Usuarios</span></a>
    <ul class="ml-menu">
        <!--Poner las rutas asi en el href de cada etiqueta a {{--route('app.inbox')--}} -->
        <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="/roles">Roles</a></li>
        <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="/usuarios">Usuarios</a></li>
            <!-- Dejo el enlace a calendar para fijarnos -->
            <!-- <li class="{{ Request::segment(2) === 'calendar' ? 'active' : null }}"><a href="{{route('app.calendar')}}">Calendar</a></li>  -->
    </ul>
</li>
<li class="{{ Request::segment(1) === '' ? 'active' : null}}">
    <a href="#"><i class="zmdi zmdi-assignment"></i><span>Servicios</span></a>
</li>
<li class="{{Request::segment(1) === '' ? 'active' : null}}">
    <a href="#"><i class="zmdi zmdi"></i><span>Planes de Pago</span></a>
</li>
<li class="{{ Request::segment(1) === '' ? 'active open' : null }}">
    <a href="#" class="menu-toggle"><i class="zmdi zmdi-assignment"></i> <span>Admin. Lentes</span></a>
    <ul class="ml-menu">
        <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Marcas</a></li>
        <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Marcos</a></li>
        <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Tipos de Lentes</a></li>
    </ul>
</li>
<li class="{{ Request::segment(1) === '' ? 'active' : null }}">
    <a href="#"><i class="zmdi zmdi"></i><span>Estadisticas</span></a>
</li>
<li class="{{ Request::segment(1) === '' ? 'active' : null}}">
    <a href="#"><i class="zmdi zmdi"></i><span>Reportes</span></a>
</li>