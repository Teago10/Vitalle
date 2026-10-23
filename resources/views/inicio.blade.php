<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vitalle | Início</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f8f2ee] text-[#232935]">

    <!-- Cabeçalho -->
    <header class="flex items-start justify-between px-4 py-3 md:px-6">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="block shrink-0">
            <img
                src="{{ asset('img/vitalleLogo.png') }}"
                alt="Logo Vitalle"
                class="block h-auto w-[180px] object-contain"
            >
        </a>

        <!-- Botões de acesso -->
        <nav class="flex items-center gap-3">

            <!-- Registrar -->
            <a
                href="{{ route('register') }}"
                class="inline-flex items-center justify-center rounded-xl border border-[#518364] bg-transparent px-6 py-3 text-sm font-semibold text-[#518364] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#518364]/10 active:translate-y-0"
            >
                Registrar
            </a>

            <!-- Entrar -->
            <a
                href="{{ route('login') }}"
                class="inline-flex items-center justify-center rounded-xl border border-[#518364] bg-[#518364] px-6 py-3 text-sm font-semibold text-white shadow-md shadow-[#518364]/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#426e52] hover:shadow-lg active:translate-y-0"
            >
                Entrar
            </a>

        </nav>

    </header>

    <!-- Conteúdo principal -->
    <main class="-translate-y-8 flex min-h-[70vh] flex-col items-center justify-center px-6 text-center">

        <h1 class="max-w-2xl text-4xl font-bold leading-tight md:text-5xl">
            Cuidado que
            <span class="text-[#518364]">transforma.</span>
        </h1>

        <p class="mt-4 max-w-lg text-base leading-7 text-gray-600">
            Conectando famílias a profissionais de cuidado
            com confiança, carinho e segurança.
        </p>

    </main>

    <!-- Rodapé -->
    <footer class="py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} Vitalle — Cuidado que transforma.
    </footer>

</body>
</html>