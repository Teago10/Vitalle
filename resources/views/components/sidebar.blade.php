{{-- Sidebar --}}
@props(['active' => 'dashboard'])
        <aside class="fixed left-0 top-0 w-64 h-screen bg-[#232935] flex flex-col shrink-0">

            {{-- Cabeçalho --}}
            <div class="px-5 py-5 border-b border-white/10">
                <div class="text-white text-lg font-semibold">Vitalle</div>
                <div class="text-white/50 text-xs mt-0.5">
                    Cuidado que transforma
                </div>
            </div>

            {{-- Navegação --}}
            <nav class="flex-1 px-3 py-2 flex flex-col gap-1 overflow-y-auto">

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
                    {{ $active === 'cadastros' ? 'bg-[#5FA83D] text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="ti ti-user-plus text-lg"></i>
                    Cadastros
                </a>

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
                    {{ $active === 'atendimentos' ? 'bg-[#5FA83D] text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="ti ti-calendar-event text-lg"></i>
                    Atendimentos
                </a>

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
                    {{ $active === 'avaliacoes' ? 'bg-[#5FA83D] text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="ti ti-star text-lg"></i>
                    Avaliações
                </a>

                <div class="h-px bg-white/10 my-3"></div>

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white">
                    <i class="ti ti-headset text-lg"></i>
                    Suporte
                </a>

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white">
                    <i class="ti ti-chart-bar text-lg"></i>
                    Relatórios
                </a>

            </nav>

            {{-- Rodapé --}}
            <div class="p-3 border-t border-white/10">

                <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white">
                    <i class="ti ti-settings text-lg"></i>
                    Configurações
                </a>

                <button
                    class="w-full mt-2 flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white">
                    <i class="ti ti-logout text-lg"></i>
                    Sair
                </button>

            </div>

        </aside>