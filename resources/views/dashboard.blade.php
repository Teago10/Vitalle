<x-app-layout>
{{--
    Componente: Sidebar do Vitale Concierge
    Uso: <x-sidebar :active="'dashboard'" />

    Salve em: resources/views/components/sidebar.blade.php
--}}

@props(['active' => 'dashboard'])

<aside class="w-64 h-screen bg-[#232935] flex flex-col shrink-0">

    {{-- Cabeçalho --}}
    <div class="px-5 py-5 border-b border-white/10">
        <div class="text-white text-lg font-semibold">Vitalle</div>
        <div class="text-white/50 text-xs mt-0.5">Cuidado que transforma</div>
    </div>  

    {{-- Navegação --}}
    <nav class="flex-1 px-3 py-2 flex flex-col gap-1 overflow-y-auto">

        <a href="{{route('admin.paciente.index')}}"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
                    {{ $active === 'cadastros'
                        ? 'bg-[#5FA83D] text-white'
                        : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <i class="ti ti-user-plus text-lg w-[18px] text-center"></i>
            Cadastros
        </a>

        <a 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
            {{ $active === 'atendimentos'
                        ? 'bg-[#5FA83D] text-white'
                        : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <i class="ti ti-calendar-event text-lg w-[18px] text-center"></i>
            Atendimentos
        </a>

        <a 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
            {{ $active === 'avaliacoes'
                        ? 'bg-[#5FA83D] text-white'
                        : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <i class="ti ti-star text-lg w-[18px] text-center"></i>
            Avaliações
        </a>

        <div class="h-px bg-white/10 my-2.5 mx-1.5"></div>

        <a 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
            {{ $active === 'disponibilidade'
                        ? 'bg-[#5FA83D] text-white'
                        : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <i class="ti ti-clock text-lg w-[18px] text-center"></i>
            Suporte
        </a>

        <a 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm transition-colors
            {{ $active === 'relatorios'
                        ? 'bg-[#5FA83D] text-white'
                        : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <i class="ti ti-chart-bar text-lg w-[18px] text-center"></i>
            Relatórios
    </a>

    </nav>

    {{-- Rodapé fixo --}}
    <div class="p-3 border-t border-white/10 flex flex-col gap-1">
        <a 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white transition-colors">
            <i class="ti ti-settings text-lg w-[18px] text-center"></i>
            Configurações
        </a>

        <form method="POST" action="">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-white/75 hover:bg-white/10 hover:text-white transition-colors">
                <i class="ti ti-logout text-lg w-[18px] text-center"></i>
                Sair
            </button>
        </form>
    </div>

</aside>

<div class="bg-[#f8f2ee]"></div>

</x-app-layout>
