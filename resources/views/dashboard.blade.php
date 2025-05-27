<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard de Ciudadanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Ciudades</h1>

    <ul class="list-group">
        @foreach ($cities as $city)
            <li class="list-group-item">
                <a href="{{ route('city.show', $city->id) }}" class="text-decoration-none">
                    {{ $city->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
