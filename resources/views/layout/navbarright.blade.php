<div class="navbar-right">
    <ul class="navbar-nav">
    	<!-- Se Limpio el menu lateral derecho, como funciona para mostrar el menu de configuracion NO SE, creo que tiene que ver mucho esa clase js-right-sidebar -->
        <li>
            <a href="/miperfil" title="Mi Perfil" data-toggle="tooltip" data-placement="left"><i class="zmdi zmdi-account"></i>
            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
        </li>
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Configuración" data-toggle="tooltip" data-placement="left"><i class="zmdi zmdi-settings"></i></a></li>
        <li><a href="{{route('authentication.login')}}" class="mega-menu" title="Cerrar Sesión" data-toggle="tooltip" data-placement="left"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
</div>
