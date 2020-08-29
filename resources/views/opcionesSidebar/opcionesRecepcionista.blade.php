<li>
    <div class="user-info">
        <div class="detail">
            <span>Recepcionista</span>
        </div>
    </div>
</li>

<li class="{{Request::segment(1) == 'jornadas'}}">
    <a href="{{url('calendarRecepcionista')}}"><i class="zmdi zmdi-calendar"></i><span>Jornadas</span></a>
    <a href="{{url('listaPacientes')}}"><i class="zmdi zmdi-accounts-alt"></i><span>Pacientes</span></a>
</li>
