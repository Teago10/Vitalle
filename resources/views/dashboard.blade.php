<x-sistema>

    <div class="mx-auto flex h-[calc(100vh-2rem)] max-w-6xl flex-col overflow-hidden px-6">

        {{-- Conteúdo principal --}}
        <main class="flex flex-1 items-center justify-center overflow-hidden">

            <div class="flex w-full -translate-y-4 flex-col items-center text-center">

                {{-- Ícone --}}
                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#518364]/10">
                    <i class="ti ti-heart-handshake text-2xl text-[#518364]"></i>
                </div>

                {{-- Título --}}
                <h1 class="text-2xl font-semibold tracking-tight text-[#232935] md:text-3xl">
                    Bem-vindo ao
                    <span class="text-[#518364]">Vitalle.</span>
                </h1>

                {{-- Descrição --}}
                <p class="mt-3 max-w-md text-sm leading-6 text-gray-500">
                    Cuidado, organização e confiança em um só lugar.
                </p>

                {{-- Detalhe visual --}}
                <div class="mt-5 h-1 w-10 rounded-full bg-[#518364]"></div>

            </div>

        </main>

        {{-- Rodapé --}}
        <footer class="shrink-0 py-3 text-center text-xs text-gray-400">
            © {{ date('Y') }} Vitalle
        </footer>

    </div>

</x-sistema>