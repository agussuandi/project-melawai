<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Covid 19 Melawai</title>
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">C19 Melawai</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('karyawan.index') }}">Karyawan</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('karyawan-vaksin.index') }}">Karyawan Vaksin</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('karyawan-keluarga-vaksin.index') }}">Karyawan Keluarga Vaksin</a>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-5">
        @include('layouts.message-flash')
        @yield('content')
    </main>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    @yield('javascript')
</body>
</html>