
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vitalle</title>

    {{-- CSS e JavaScript do Laravel --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Biblioteca de ícones Tabler --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"
    >
</head>

<body>

    <div>

        {{-- Sidebar --}}
        <x-sidebar />

        <div class="ml-64">



            {{-- Conteúdo principal --}}
            <main class="bg-white min-h-screen p-8">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>
