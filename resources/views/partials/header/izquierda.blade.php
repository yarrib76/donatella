<div class="navbar-header">
    <button type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar"
            aria-expanded="false"
            aria-controls="navbar">

        <span class="sr-only">Toggle Navigation</span>
    </button>

    @if (substr(Request::url('http://donatella.dyndns.org'),0,27) == 'http://donatella.dyndns.org')
        <a href="/" class="navbar-brand">Donatella</a>
        @else <a href="/" class="navbar-brand">Samira</a>
    @endif

</div>{{-- navbar-header--}}
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    @if (Auth::check())
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Reportes <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/reporteArticulo?anio="> Graficos </a></li>
                    <li><a href="/reporteArticuloProveedor"> Articulos/Proveedor </a></li>
                    <li><a href="/transferenciasarticulos"> Transferencias </a></li>
                    <li><a href="/reportesArticulosWeb"> ArticulosWeb </a></li>
                    <li><a href="/pedidos"> Pedidos </a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Articulos <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/articulos"> ABM</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Caja <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/cierreDiario"> Cierres </a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Clientes <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/clientes"> ABM</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    BI <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/api/biclientes"> Clientes </a></li>
                    <li><a href="/mapa"> Mapa Region </a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Promociones <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/panelpromocion"> Panel </a></li>
                </ul>
            </li>
     <!--       <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Articulos <b class="caret"></b>
                </a>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    <li class="divider"></li>
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">Actividades Asignadas</a>
                        <ul class="dropdown-menu">
                            <li><a href="/actividades_asignadas_miUsuario">Mi Usuario</a></li>
                            <li><a href="/actividades_asignadas">Todos Los Usuarios</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Profesores <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/profesor/agenda"> Agenda </a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle fa fa-btn" data-toggle="dropdown">
                    Administrador<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/administrador/tracklogins"> Logins de Usuarios </a></li>
                </ul>
            </li> -->
        </ul>
    @endif
