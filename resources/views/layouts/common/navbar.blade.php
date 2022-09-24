<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">
            <a class="nav-link" href="{{route('reportes')}}"
                <span>Reportes</span>
            </a>
            <a class="nav-link" href="{{route('user')}}"
                <span>Usuarios</span>
            </a>
            <a class="nav-link" href="{{route('gastos')}}"
                <span>Gastos</span>
            </a>
            <a class="nav-link" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-log-out"> <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Cerrar Sesión</span>
            </a>
        </div>

    </div>
    </div>
</nav>
@include('layouts.common.cerrarsesion')
