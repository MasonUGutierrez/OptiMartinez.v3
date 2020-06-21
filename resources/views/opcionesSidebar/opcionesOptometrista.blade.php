<li>
    <div class="user-info">
        <div class="detail">
            <span>Optometrista</span>
        </div>
    </div>
</li>

<li class="{{Request::segment(2) == 'jornadas' ? 'active' : null}}">
    <!-- Especificar la ruta para esta opcion como "ver/jornadas" o "optometrista/jornadas" -->
    <a href="/jornadas"><i class="zmdi zmdi-calendar-alt"></i><span>Ver Jornadas</span></a>
</li>
<li class="{{Request::segment(1) == 'historias-clinicas' ? 'active' : null}}">
    <a href="{{url('historias-clinicas')}}"><i class="zmdi zmdi-collection-text"></i><span>Historias Clinicas</span></a>
</li>
