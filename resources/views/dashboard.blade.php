<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard de Ciudadanos</title>
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
                    {{ __('Dashboard de Ciudadanos') }}
                </h2>
            </div>
        </header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Total de Ciudades') }}</h3>
                        <p class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mt-2">{{ $totalCities }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Total de Ciudadanos') }}</h3>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalCitizens }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Ciudadanos por Ciudad') }}</h3>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                            @forelse ($citiesWithCitizenCount as $city)
                                <li>{{ $city->name }}: {{ $city->citizens_count }}</li>
                            @empty
                                <li>No hay ciudades registradas.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Explorar Ciudades') }}</h2>
                        <ul class="list-group">
                            @foreach ($citiesWithCitizenCount as $city)
                                <li class="list-group-item">
                                    <a href="{{ route('city.show', $city->id) }}" class="text-decoration-none text-indigo-600 hover:text-indigo-900">
                                        {{ $city->name }} ({{ $city->citizens_count }} Ciudadanos)
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>