<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- Icono en la parte superior del menu lateral izquierdo, su tamaño chinga el menu NO TOCAR -->
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <!-- NO TOCAR EL VALOR DEL ATRIBUTO WIDTH -->
        <a href="{{route('dashboard.index')}}"><img src="../assets/images/LogoSistemaOptica/logo.svg" width="100" alt="Logo Sistema"></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="image"><a href="#"><img src="../assets/images/profile_av.jpg" alt="User"></a></div>
                    <div class="detail">
                        <h4>Nombre</h4>
                    </div>
                </div>
            </li>

            <li>
                <div class="user-info">
                    <div class="detail">
                        <span>General</span>
                    </div>
                </div>
            </li> 

            <li class="{{ Request::segment(1) === 'dashboard' ? 'active open' : null }}"><a href="{{route('dashboard.index')}}"><i class="zmdi zmdi-home"></i><span>Inicio</span></a></li>
            <li class="{{ Request::segment(1) === 'my-profile' ? 'active open' : null }}"><a href="{{route('profile.my-profile')}}"><i class="zmdi zmdi-account"></i><span>Mi Perfil</span></a></li>

            <li>
                <div class="user-info">
                    <div class="detail">
                        <span>Administrador</span>
                    </div>
                </div>
            </li>
            
            <!-- Modificar despues este request-->
            <li class="{{ Request::segment(1) === 'app' ? 'active open' : null }}">
                <a href="#" class="menu-toggle"><i class="zmdi zmdi-accounts-list"></i> <span>Admin. Usuarios</span></a>
                <ul class="ml-menu">
                    <!--Poner las rutas asi en el href de cada etiqueta a {{route('app.inbox')}} -->
                    <li class="{{ Request::segment(2) === 'inbox' ? 'active' : null }}"><a href="#">Roles</a></li>
                    <li class="{{ Request::segment(2) === 'chat' ? 'active' : null }}"><a href="#">Usuarios</a></li>
                    <!-- Dejo el enlace a calendar para fijarnos -->
                    <!-- <li class="{{ Request::segment(2) === 'calendar' ? 'active' : null }}"><a href="{{route('app.calendar')}}">Calendar</a></li>  -->
                </ul>
            </li>
            <li class="{{ Request::segment(1) === 'project' ? 'active' : null}}">
                <a href="#">
                    <i class="zmdi zmdi-assignment"></i><span>Servicios</span>
                </a>
            </li>
            <li class="{{Request::segment(1) === '' ? 'active' : null}}">
                <a href="#">
                    <i class="zmdi zmdi"></i><span>Planes de Pago</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) === '' ? 'active open' : null }}">
                <a href="#Project" class="menu-toggle"><i class="zmdi zmdi-assignment"></i> <span>Admin. Lentes</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Marcas</a></li>
                    <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Marcos</a></li>
                    <li class="{{ Request::segment(2) === '' ? 'active' : null }}"><a href="#">Tipos de Lentes</a></li>
                </ul>
            </li>
            <li class="{{ Request::segment(1) === '' ? 'active' : null }}">
                <a href="#">
                    <i class="zmdi zmdi"></i><span>Estadisticas</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) === '' ? 'active' : null}}">
                <a href="#">
                    <i class="zmdi zmdi"></i><span>Reportes</span>
                </a>
            </li>
            
            <!-- Enlaces importantes para ejemplos -->
            <!-- <li class="{{ Request::segment(1) === 'form' ? 'active open' : null }}">
                <a href="#Form" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Forms</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(2) === 'basic' ? 'active' : null }}"><a href="{{route('form.basic')}}">Basic Form</a></li>
                    <li class="{{ Request::segment(2) === 'advanced' ? 'active' : null }}"><a href="{{route('form.advanced')}}">Advanced Form</a></li>
                    <li class="{{ Request::segment(2) === 'examples' ? 'active' : null }}"><a href="{{route('form.examples')}}">Form Examples</a></li>
                    <li class="{{ Request::segment(2) === 'validation' ? 'active' : null }}"><a href="{{route('form.validation')}}">Form Validation</a></li>
                    <li class="{{ Request::segment(2) === 'wizard' ? 'active' : null }}"><a href="{{route('form.wizard')}}">Form Wizard</a></li>
                    <li class="{{ Request::segment(2) === 'editors' ? 'active' : null }}"><a href="{{route('form.editors')}}">Editors</a></li>
                    <li class="{{ Request::segment(2) === 'upload' ? 'active' : null }}"><a href="{{route('form.upload')}}">File Upload</a></li>
                    <li class="{{ Request::segment(2) === 'summernote' ? 'active' : null }}"><a href="{{route('form.summernote')}}">Summernote</a></li>
                </ul>
            </li>

            <li class="{{ Request::segment(1) === 'tables' ? 'active open' : null }}">
                <a href="#Tables" class="menu-toggle"><i class="zmdi zmdi-grid"></i><span>Tables</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(2) === 'normal' ? 'active' : null }}"><a href="{{route('tables.normal')}}">Normal Tables</a></li>
                    <li class="{{ Request::segment(2) === 'datatable' ? 'active' : null }}"><a href="{{route('tables.datatable')}}">Jquery Datatables</a></li>
                    <li class="{{ Request::segment(2) === 'editable' ? 'active' : null }}"><a href="{{route('tables.editable')}}">Editable Tables</a></li>
                    <li class="{{ Request::segment(2) === 'footable' ? 'active' : null }}"><a href="{{route('tables.footable')}}">Foo Tables</a></li>
                    <li class="{{ Request::segment(2) === 'color' ? 'active' : null }}"><a href="{{route('tables.color')}}">Tables Color</a></li>
                </ul>
            </li>

            <li class="{{ Request::segment(1) === 'authentication' ? 'active open' : null }}">
                <a href="#Authentication" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>Authentication</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(2) === 'login' ? 'active' : null }}"><a href="{{route('authentication.login')}}">Sign In</a></li>
                    <li class="{{ Request::segment(2) === 'register' ? 'active' : null }}"><a href="{{route('authentication.register')}}">Sign Up</a></li>
                    <li class="{{ Request::segment(2) === 'lockscreen' ? 'active' : null }}"><a href="{{route('authentication.lockscreen')}}">Locked Screen</a></li>
                    <li class="{{ Request::segment(2) === 'forgot' ? 'active' : null }}"><a href="{{route('authentication.forgot')}}">Forgot Password</a></li>
                    <li class="{{ Request::segment(2) === 'page404' ? 'active' : null }}"><a href="{{route('authentication.page404')}}">Page 404</a></li>
                    <li class="{{ Request::segment(2) === 'page500' ? 'active' : null }}"><a href="{{route('authentication.page500')}}">Page 500</a></li>
                    <li class="{{ Request::segment(2) === 'offline' ? 'active' : null }}"><a href="{{route('authentication.offline')}}">Page Offline</a></li>
                </ul>
            </li>

            <li class="{{ Request::segment(1) === 'pages' ? 'active open open_top' : null }}">
                <a href="#Pages" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>Sample Pages</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(2) === 'blank' ? 'active' : null }}"><a href="{{route('pages.blank')}}">Blank Page</a></li>
                    <li class="{{ Request::segment(2) === 'invoices1' ? 'active' : null }}"><a href="{{route('pages.invoices1')}}">Invoices</a></li>
                    <li class="{{ Request::segment(2) === 'invoices2' ? 'active' : null }}"><a href="{{route('pages.invoices2')}}">Invoices List</a></li>
                    <li class="{{ Request::segment(2) === 'pricing' ? 'active' : null }}"><a href="{{route('pages.pricing')}}">Pricing</a></li>
                    <li class="{{ Request::segment(2) === 'profile' ? 'active' : null }}"><a href="{{route('pages.profile')}}">Profile</a></li>
                </ul>
            </li> -->
            <li>
                <div class="progress-container progress-primary m-t-10" style="">
                    <span class="progress-badge">Copyright © 2019 - All right reserves</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
