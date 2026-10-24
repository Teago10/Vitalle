
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

        {{-- Área ao lado da sidebar --}}
        <div class="ml-72">

            {{-- Conteúdo principal --}}
            <main class="min-h-screen bg-white p-8">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>
