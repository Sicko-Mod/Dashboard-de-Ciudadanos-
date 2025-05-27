<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ciudad {{ $city->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>
<body>
<div class="container mt-4 d-flex">
    <nav class="me-4" style="min-width: 220px;">
        <h3>Ciudades</h3>
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
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Inicio</a>
    </nav>

    <div class="flex-grow-1">
        <h2>Ciudadanos en {{ $city->name }}</h2>

        <ul class="list-group">
            @forelse($citizens as $citizen)
                <li class="list-group-item">{{ $citizen->name }}</li>
            @empty
                <li class="list-group-item">No hay ciudadanos en esta ciudad.</li>
            @endforelse
        </ul>

        <div class="mt-3">
            {{ $citizens->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
