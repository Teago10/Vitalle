
{{-- Sidebar --}}
@props(['active' => 'dashboard'])

@php
    // Identifica a página atual pelas rotas.
    // O valor de $active continua funcionando como alternativa.
    $paginaAtual = match (true) {
        request()->routeIs('admin.paciente.*'),
        request()->routeIs('admin.cuidador.*'),
        request()->routeIs('admin.cuidadores.*')
            => 'cadastros',

        request()->routeIs('atendimento.*')
            => 'atendimentos',

        request()->routeIs('avaliacao.*')
            => 'avaliacoes',

        request()->routeIs('suporte.*')
            => 'suporte',

        default => $active,
    };

    $classeBase = 'relative flex items-center gap-4 px-4 py-3.5 rounded-xl text-base font-medium transition-colors duration-200';

    $classeAtivo = 'bg-[#294D39] text-[#BBF0B9] border-l-4 border-[#BBF0B9]';

    $classeInativo = 'text-[#E4EDE6] hover:bg-white/10 hover:text-white';
@endphp

<aside class="fixed left-0 top-0 w-64 h-screen bg-[#071A12] text-[#E4EDE6] flex flex-col shrink-0">

    {{-- Cabeçalho --}}
    <div class="px-5 py-6 border-b border-white/10">

        <div class="text-white text-2xl font-bold">
            Vitalle
        </div>

        <div class="text-[#BBF0B9] text-sm mt-1">
            Cuidado que transforma
        </div>

    </div>

    {{-- Navegação --}}
    <nav class="flex-1 px-3 py-4 flex flex-col gap-2 overflow-y-auto">

        {{-- Cadastros --}}
        <a href="{{ route('admin.paciente.index') }}"
           @if($paginaAtual === 'cadastros') aria-current="page" @endif
           class="{{ $classeBase }} {{ $paginaAtual === 'cadastros' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-user-plus text-2xl"></i>

            <span>Cadastros</span>
        </a>

        {{-- Atendimentos --}}
        <a href="{{ route('atendimento.index') }}"
           @if($paginaAtual === 'atendimentos') aria-current="page" @endif
           class="{{ $classeBase }} {{ $paginaAtual === 'atendimentos' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-calendar-event text-2xl"></i>

            <span>Atendimentos</span>
        </a>

        {{-- Avaliações --}}
        <a href="{{ route('avaliacao.index') }}"
           @if($paginaAtual === 'avaliacoes') aria-current="page" @endif
           class="{{ $classeBase }} {{ $paginaAtual === 'avaliacoes' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-star text-2xl"></i>

            <span>Avaliações</span>
        </a>

        {{-- Divisória --}}
        <div class="h-px bg-white/10 my-3"></div>

        {{-- Suporte --}}
        <a href="{{ route('suporte.index') }}"
           @if($paginaAtual === 'suporte') aria-current="page" @endif
           class="{{ $classeBase }} {{ $paginaAtual === 'suporte' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-headset text-2xl"></i>

            <span>Suporte</span>
        </a>

    </nav>

    {{-- Rodapé --}}
    <div class="p-3 border-t border-white/10 flex flex-col gap-2">

       
{{-- Configurações / Perfil --}}
<a href="{{ route('profile.edit') }}"
   @if(request()->routeIs('profile.edit'))
       aria-current="page"
   @endif
   class="{{ $classeBase }}
   {{ request()->routeIs('profile.edit')
       ? $classeAtivo
       : $classeInativo }}">

    <i class="ti ti-settings text-2xl"></i>

    <span>Configurações</span>
</a>


       
{{-- Sair do sistema --}}
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button
        type="submit"
        class="w-full text-left {{ $classeBase }} {{ $classeInativo }}">

        <i class="ti ti-logout text-2xl"></i>

        <span>Sair</span>

    </button>
</form>


    </div>

</aside>
