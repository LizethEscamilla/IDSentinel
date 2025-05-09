<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #sidebar {
            transition: all 0.3s;
        }
        .collapsed-sidebar {
            margin-left: -250px;
        }
        #toggleSidebar {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 999;
        }
    </style>
</head>
<body>
    <div id="app">
        @auth
            <!-- Botón de 3 líneas siempre visible -->
            <button id="toggleSidebar" class="btn" style="background-color: #9D2449; color: white;">
                &#9776;
            </button>
        @endauth

        <div class="d-flex">
            <!-- Barra lateral -->
            @auth
                <div id="sidebar" class="bg-light p-3" style="width: 250px; height: 100vh;">
                    <div class="mb-4">
                        <h4 class="m-0 text-center">Menú</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/teachers') }}">Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/create') }}">Registrar Docente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/access') }}">Accesos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/statistics') }}">Estadísticas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Contenido principal -->
            <div class="flex-grow-1 p-3">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Script para ocultar/mostrar sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');

            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed-sidebar');
            });
        });
    </script>
</body>
</html>





