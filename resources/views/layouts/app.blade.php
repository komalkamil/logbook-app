<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Warehouse Management') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/css/tabler.min.css" />
    <style>
        .nav-item .nav-link.active,
        .nav-link:hover {
            color: red !important;
        }

        .icon-xl {
            font-size: 48px;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transform: scale(1.03);
            border-color: var(--tblr-danger);
        }
    </style>

</head>

<body>
    <div class="">
        <header class="navbar navbar-expand-md navbar-light bg-white d-print-none sticky-top">
            <div class="container">
                <!-- Logo -->
                <a href="/" class="navbar-brand mt-1">
                    <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo" style="height: 30px">
                </a>

                <!-- Toggler (muncul di HP) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-menu"
                    aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu desktop -->
                <div class="collapse navbar-collapse d-none d-md-flex">
                    <ul class="navbar-nav ms-3">

                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ti ti-home me-1"></i> Beranda
                            </a>
                        </li>

                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                            <a class="nav-link" href="{{route('options.index')}}">
                                <i class="ti ti-book me-1"></i> Opsi
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </div>

                <!-- Dropdown user -->
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            <i class="ti ti-user me-1"></i>{{auth()->user()->name}}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ti ti-logout me-1"></i>Logout
                                    </button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar untuk HP -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobile-menu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href=""><i class="ti ti-home me-1"></i>Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="">
            <div class="page-body">
                <div class="container">
                    <!-- Page Content -->
                    @yield('content')


                </div>
            </div>
        </div>
        <!-- Main content -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/js/tabler.min.js"></script>
    @stack('scripts')
</body>

</html>
