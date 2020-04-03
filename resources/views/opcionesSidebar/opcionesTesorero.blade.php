<li>
    <div class="user-info">
        <div class="detail">
            <span>Tesorero</span>
        </div>
    </div>
</li>

<li class="{{Request::segment(1) == 'gestion-cobro' ? 'active' : null}}">
    <a href=""><i class="zmdi zmdi-money-box"></i><span>Gestión de Cobro</span></a>
</li>
<li class="{{Request::segment(1) == 'admin-ganancias' ? 'active' : null}}">
    <a href=""><i class="zmdi zmdi-trending-up"></i><span>Admin. Ganancias</span></a>
</li>
<li class="{{Request::segment(1) == 'orden-lentes' ? 'active' : null}}">
    <a href=""><i class="zmdi zmdi-shopping-cart"></i><span>Orden Lentes</span></a>
</li>