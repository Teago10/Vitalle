<!DOCTYPE html>
<html lang="pt-BR">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div>

    <x-sidebar />

    <div class="ml-64">

        {{-- Barra superior do Breeze --}}
        @include('layouts.navigation')


        <main class="bg-white min-h-screen p-8">

            {{ $slot }}

        </main>

    </div>

</div>

</body>

</html>