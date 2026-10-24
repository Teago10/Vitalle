{{-- Sidebar --}}
@props(['active' => 'dashboard'])

@php
    // Identifica a página atual pelas rotas.
    $paginaAtual = match (true) {
        request()->routeIs('admin.paciente.*'),
        request()->routeIs('admin.cuidador.*'),
        request()->routeIs('admin.cuidadores.*')
            => 'cadastros',

        request()->routeIs('atendimento.*') => 'atendimentos',

        request()->routeIs('avaliacao.*') => 'avaliacoes',

        request()->routeIs('suporte.*') => 'suporte',

        default => $active,
    };

    $classeBase =
        'relative flex items-center gap-4 px-4 py-3.5 rounded-xl text-base font-medium transition-colors duration-200';

    $classeAtivo = 'bg-[#294D39] text-[#BBF0B9] border-l-4 border-[#BBF0B9]';

    $classeInativo = 'text-[#E4EDE6] hover:bg-white/10 hover:text-white';

    // Usuário autenticado.
    $usuario = auth()->user();

    $nomeUsuario = $usuario?->name ?? 'Usuário';

    // Utiliza o tipo de conta caso esse campo já exista.
    $tipoUsuario = $usuario?->tipo_usuario;

    $tipoExibicao = match (strtolower(trim($tipoUsuario ?? ''))) {
        'admin' => 'Administrador',
        'cuidador' => 'Cuidador',
        'responsavel' => 'Responsável',
        default => 'Perfil do usuário',
    };

    // Iniciais usadas enquanto não houver foto cadastrada.
    $iniciais = collect(explode(' ', trim($nomeUsuario)))
        ->filter()
        ->take(2)
        ->map(fn($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))
        ->implode('');

    // Foto opcional, caso já exista um caminho salvo.
    $fotoUsuario = $usuario?->foto;
@endphp

<aside class="fixed left-0 top-0 z-40 flex h-screen w-72
           shrink-0 flex-col bg-[#071A12] text-[#E4EDE6]">

    {{-- CABEÇALHO --}}
    <div class="border-b border-white/10 px-5 pt-6 pb-5">

        <div class="text-2xl font-bold text-white">
            Vitalle
        </div>

        <div class="mt-1 text-sm text-[#BBF0B9]">
            Cuidado que transforma
        </div>

    </div>

    {{-- PERFIL DO USUÁRIO --}}
    <div class="border-b border-white/10 px-4 py-5">

        <a href="{{ route('profile.edit') }}"
            class="group flex items-center gap-3 rounded-xl
                   border border-white/10 bg-white/5 p-3
                   transition-colors hover:bg-white/10">

            {{-- FOTO --}}
            <div
                class="flex h-12 w-12 shrink-0 items-center
                       justify-center overflow-hidden rounded-full
                       border-2 border-[#BBF0B9]/30 bg-[#294D39]">

                @if ($fotoUsuario)
                    <img src="{{ asset('storage/' . $fotoUsuario) }}" alt="Foto de {{ $nomeUsuario }}"
                        class="h-full w-full object-cover">
                @else
                    <span class="text-base font-bold text-[#BBF0B9]">
                        {{ $iniciais ?: 'U' }}
                    </span>
                @endif

            </div>

            {{-- INFORMAÇÕES --}}
            <div class="min-w-0 flex-1">

                <p class="truncate text-sm font-semibold text-white">
                    {{ $nomeUsuario }}
                </p>

                <p class="mt-1 truncate text-xs text-[#BBF0B9]">
                    {{ $tipoExibicao }}
                </p>

            </div>

            {{-- SETA --}}
            <i
                class="ti ti-chevron-right text-lg text-white/50
                       transition-colors group-hover:text-white">
            </i>

        </a>

    </div>

    {{-- NAVEGAÇÃO --}}
    <nav class="flex flex-1 flex-col gap-2 overflow-y-auto px-3 py-4">

        {{-- CADASTROS --}}
        <a href="{{ route('admin.paciente.index') }}" @if ($paginaAtual === 'cadastros') aria-current="page" @endif
            class="{{ $classeBase }}
                   {{ $paginaAtual === 'cadastros' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-user-plus text-2xl"></i>

            <span>Cadastros</span>

        </a>

        {{-- ATENDIMENTOS --}}
        <a href="{{ route('atendimento.index') }}" @if ($paginaAtual === 'atendimentos') aria-current="page" @endif
            class="{{ $classeBase }}
                   {{ $paginaAtual === 'atendimentos' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-calendar-event text-2xl"></i>

            <span>Atendimentos</span>

        </a>

        {{-- AVALIAÇÕES --}}
        <a href="{{ route('avaliacao.index') }}" @if ($paginaAtual === 'avaliacoes') aria-current="page" @endif
            class="{{ $classeBase }}
                   {{ $paginaAtual === 'avaliacoes' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-star text-2xl"></i>

            <span>Avaliações</span>

        </a>

        {{-- DIVISÓRIA --}}
        <div class="my-3 h-px bg-white/10"></div>

        {{-- SUPORTE --}}
        <a href="{{ route('suporte.index') }}" @if ($paginaAtual === 'suporte') aria-current="page" @endif
            class="{{ $classeBase }}
                   {{ $paginaAtual === 'suporte' ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-headset text-2xl"></i>

            <span>Suporte</span>

        </a>

    </nav>

    {{-- RODAPÉ --}}
    <div class="flex flex-col gap-2 border-t border-white/10 p-3">

        {{-- CONFIGURAÇÕES --}}
        <a href="{{ route('profile.edit') }}" @if (request()->routeIs('profile.edit')) aria-current="page" @endif
            class="{{ $classeBase }}
                   {{ request()->routeIs('profile.edit') ? $classeAtivo : $classeInativo }}">

            <i class="ti ti-settings text-2xl"></i>

            <span>Configurações</span>

        </a>

        {{-- SAIR --}}
        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit" class="w-full text-left {{ $classeBase }} {{ $classeInativo }}">

                <i class="ti ti-logout text-2xl"></i>

                <span>Sair</span>

            </button>

        </form>

    </div>

</aside>
