<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ciudad {{ $city->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ciudad ') }}{{ $city->name }}
            </h2>
        </div>
    </header>

    <div class="container mt-4 d-flex">
        <nav class="me-4" style="min-width: 220px;">
            <h3 class="text-xl font-semibold mb-3">{{ __('Ciudades') }}</h3>
            <ul class="list-group">
                @foreach($cities as $c)
                    <li class="list-group-item d-flex align-items-center {{ $c->id == $city->id ? 'active bg-primary text-white' : '' }}">
                        <i class="bi bi-building me-2"></i>
                        <a href="{{ route('city.show', $c->id) }}" class="{{ $c->id == $city->id ? 'text-white text-decoration-none' : 'text-decoration-none' }}">
                            {{ $c->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">{{ __('Inicio') }}</a>
        </nav>

        <div class="flex-grow-1">
            <h2 class="mb-4">{{ __('Ciudadanos en ') }}{{ $city->name }}</h2>

            <div class="mb-4 text-end">
                <a href="{{ route('citizens.create', $city->id) }}" class="btn btn-success">{{ __('Add New Citizen') }}</a>
            </div>

            <form action="{{ route('city.show', $city->id) }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('Buscar ciudadano...') }}" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">{{ __('Buscar') }}</button>
                    @if(request('search'))
                        <a href="{{ route('city.show', $city->id) }}" class="btn btn-outline-danger">{{ __('Limpiar') }}</a>
                    @endif
                </div>
            </form>

            <ul class="list-group">
                @forelse($citizens as $citizen)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $citizen->name }}
                        <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this citizen?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </li>
                @empty
                    <li class="list-group-item">{{ __('No hay ciudadanos en esta ciudad.') }}</li>
                @endforelse
            </ul>

            <div class="mt-3">
                {{ $citizens->links() }}
            </div>

            <form action="{{ route('report.send') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="city_id" value="{{ $city->id }}">
                <button type="submit" class="btn btn-primary">{{ __('Enviar Reporte por Correo') }}</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>