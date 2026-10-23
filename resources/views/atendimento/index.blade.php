
<x-sistema>

    <div
        x-data="{ filtroStatus: 'TODOS' }"
        class="mx-auto max-w-6xl">

        {{-- CABEÇALHO --}}
        <x-page-header
            title="Atendimentos"
            subtitle="Visualize e gerencie os atendimentos solicitados.">

            <a href="{{ route('atendimento.cadastro') }}"
               class="inline-flex items-center gap-2 rounded-xl
                      bg-[#07311C] px-5 py-3 text-sm font-semibold
                      text-white transition-colors hover:bg-[#52745C]">

                <i class="ti ti-plus text-lg"></i>
                Solicitar Atendimento

            </a>

        </x-page-header>

        {{-- MENSAGEM DE SUCESSO --}}
        @if (session('sucesso'))

            <div class="mb-6 flex items-center gap-3 rounded-xl
                        border border-green-200 bg-green-50
                        px-5 py-4 text-sm text-green-800">

                <i class="ti ti-circle-check text-xl"></i>
                {{ session('sucesso') }}

            </div>

        @endif

        {{-- CARD PRINCIPAL --}}
        <div class="overflow-hidden rounded-2xl border
                    border-[#52745C]/10 bg-white shadow-sm">

            {{-- CABEÇALHO DA LISTAGEM --}}
            <div class="flex flex-wrap items-center justify-between
                        gap-4 border-b border-gray-100 px-6 py-5">

                <div>
                    <h2 class="text-lg font-semibold text-[#07311C]">
                        Atendimentos cadastrados
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $atendimentos->count() }}
                        {{ $atendimentos->count() === 1
                            ? 'atendimento encontrado'
                            : 'atendimentos encontrados' }}
                    </p>
                </div>

                {{-- FILTRO POR STATUS --}}
                <div class="flex items-center gap-3">

                    <i class="ti ti-filter text-xl text-[#52745C]"></i>

                    <select
                        x-model="filtroStatus"
                        aria-label="Filtrar atendimentos por status"
                        class="min-w-[190px] rounded-xl border border-[#D9E2DA]
       bg-[#F8F2EE] pl-4 pr-10 py-2.5
       text-sm font-medium text-[#07311C]
       focus:border-[#52745C]
       focus:ring-[#52745C]">

                        <option value="TODOS">
                            Todos os status
                        </option>

                        <option value="ABERTO">
                            Abertos
                        </option>

                        <option value="ACEITO">
                            Aceitos
                        </option>

                        <option value="EM_ANDAMENTO">
                            Em andamento
                        </option>

                        <option value="CONCLUIDO">
                            Concluídos
                        </option>

                        <option value="CANCELADO">
                            Cancelados
                        </option>

                    </select>

                </div>

            </div>

            {{-- LISTAGEM --}}
            <div class="divide-y divide-gray-100">

                @forelse ($atendimentos as $atendimento)

                    @php
                        $status = $atendimento->status;

                        $statusConfig = match ($status) {
                            'ABERTO' => [
                                'texto' => 'Aberto',
                                'classe' => 'bg-amber-50 text-amber-700 border-amber-200',
                            ],
                            'ACEITO' => [
                                'texto' => 'Aceito',
                                'classe' => 'bg-blue-50 text-blue-700 border-blue-200',
                            ],
                            'EM_ANDAMENTO' => [
                                'texto' => 'Em andamento',
                                'classe' => 'bg-[#E2EDE4] text-[#07311C] border-[#C8DDCC]',
                            ],
                            'CONCLUIDO' => [
                                'texto' => 'Concluído',
                                'classe' => 'bg-green-50 text-green-700 border-green-200',
                            ],
                            'CANCELADO' => [
                                'texto' => 'Cancelado',
                                'classe' => 'bg-red-50 text-red-700 border-red-200',
                            ],
                            default => [
                                'texto' => $status,
                                'classe' => 'bg-gray-100 text-gray-700 border-gray-200',
                            ],
                        };

                        $jornada = match ($atendimento->tipo_jornada) {
                            '12h_dia' => '12 horas — Dia',
                            '12h_noite' => '12 horas — Noite',
                            '6h' => '6 horas',
                            'cuidado_avulso' => 'Cuidado avulso',
                            default => $atendimento->tipo_jornada,
                        };
                    @endphp

                    {{-- ATENDIMENTO --}}
                    <div
                        x-data="{ aberto: false }"
                        x-show="filtroStatus === 'TODOS' || filtroStatus === @js($status)"
                        class="transition-colors hover:bg-[#F8F2EE]/40">

                        {{-- LINHA RESUMIDA --}}
                        <div class="flex flex-wrap items-center
                                    justify-between gap-4 px-6 py-5">

                            {{-- PACIENTE E DATA --}}
                            <div class="flex min-w-0 flex-1 items-center gap-4">

                                <div class="flex h-12 w-12 shrink-0
                                            items-center justify-center
                                            rounded-xl bg-[#52745C]/10">

                                    <i class="ti ti-calendar-heart
                                              text-2xl text-[#52745C]"></i>

                                </div>

                                <div class="min-w-0">

                                    <h3 class="truncate text-sm font-semibold
                                               text-[#07311C]">

                                        {{ $atendimento->paciente->nome ?? 'Paciente não encontrado' }}

                                    </h3>

                                    <div class="mt-1 flex flex-wrap
                                                items-center gap-x-3 gap-y-1
                                                text-xs text-gray-500">

                                        <span class="inline-flex items-center gap-1">

                                            <i class="ti ti-calendar"></i>

                                            {{ \Carbon\Carbon::parse(
                                                $atendimento->data_atendimento
                                            )->format('d/m/Y') }}

                                        </span>

                                        <span class="inline-flex items-center gap-1">

                                            <i class="ti ti-clock"></i>

                                            {{ substr($atendimento->horario_inicio, 0, 5) }}
                                            -
                                            {{ substr($atendimento->horario_fim, 0, 5) }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                            {{-- STATUS E DETALHES --}}
                            <div class="flex flex-wrap items-center gap-3">

                                <span class="inline-flex items-center
                                             rounded-full border px-3 py-1.5
                                             text-xs font-semibold
                                             {{ $statusConfig['classe'] }}">

                                    {{ $statusConfig['texto'] }}

                                </span>

                                <button
                                    type="button"
                                    @click="aberto = !aberto"
                                    :aria-expanded="aberto.toString()"
                                    class="inline-flex items-center gap-2
                                           rounded-lg px-3 py-2 text-sm
                                           font-medium text-[#52745C]
                                           transition-colors hover:bg-[#52745C]/10">

                                    <span x-text="aberto ? 'Ocultar detalhes' : 'Ver detalhes'">
                                        Ver detalhes
                                    </span>

                                    <i class="ti ti-chevron-down text-lg
                                              transition-transform duration-200"
                                       :class="{ 'rotate-180': aberto }"></i>

                                </button>

                            </div>

                        </div>

                        {{-- PAINEL EXPANSÍVEL --}}
                        <div
                            x-show="aberto"
                            x-cloak
                            x-transition
                            class="border-t border-[#52745C]/10
                                   bg-[#F8F2EE] px-6 py-6">

                            {{-- DADOS DO ATENDIMENTO --}}
                            <div class="mb-5">

                                <div class="mb-4 flex items-center gap-2">

                                    <i class="ti ti-clipboard-list
                                              text-xl text-[#52745C]"></i>

                                    <h4 class="text-sm font-semibold text-[#07311C]">
                                        Informações do atendimento
                                    </h4>

                                </div>

                                <div class="grid grid-cols-1 gap-5
                                            sm:grid-cols-2 lg:grid-cols-3">

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Paciente
                                        </p>

                                        <p class="break-words text-sm font-semibold
                                                  text-[#07311C]">
                                            {{ $atendimento->paciente->nome ?? 'Não informado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Cuidador
                                        </p>

                                        <p class="break-words text-sm font-semibold
                                                  text-[#07311C]">
                                            {{ $atendimento->cuidador->nome ?? 'Aguardando cuidador' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Tipo de jornada
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            {{ $jornada }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Data
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            {{ \Carbon\Carbon::parse(
                                                $atendimento->data_atendimento
                                            )->format('d/m/Y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Horário
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            {{ substr($atendimento->horario_inicio, 0, 5) }}
                                            -
                                            {{ substr($atendimento->horario_fim, 0, 5) }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Valor
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            R$ {{ number_format(
                                                (float) $atendimento->valor,
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                            {{-- DADOS DO PACIENTE --}}
                            <div class="border-t border-[#52745C]/10 pt-5">

                                <div class="mb-4 flex items-center gap-2">

                                    <i class="ti ti-heartbeat
                                              text-xl text-[#52745C]"></i>

                                    <h4 class="text-sm font-semibold text-[#07311C]">
                                        Informações de saúde do paciente
                                    </h4>

                                </div>

                                <div class="grid grid-cols-1 gap-5
                                            sm:grid-cols-2 lg:grid-cols-3">

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Data de nascimento
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            {{ $atendimento->paciente?->data_nascimento
                                                ? \Carbon\Carbon::parse(
                                                    $atendimento->paciente->data_nascimento
                                                )->format('d/m/Y')
                                                : 'Não informado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Comorbidades
                                        </p>

                                        <p class="break-words text-sm font-semibold
                                                  text-[#07311C]">
                                            {{ $atendimento->paciente?->comorbidade ?: 'Não informado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Condição física
                                        </p>

                                        <p class="break-words text-sm font-semibold
                                                  text-[#07311C]">
                                            {{ $atendimento->paciente?->condicao_fisica ?: 'Não informado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Uso de fraldas
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            @if (is_null($atendimento->paciente?->usa_fraldas))
                                                Não informado
                                            @else
                                                {{ $atendimento->paciente->usa_fraldas ? 'Sim' : 'Não' }}
                                            @endif
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Medicação
                                        </p>

                                        <p class="break-words text-sm font-semibold
                                                  text-[#07311C]">
                                            {{ $atendimento->paciente?->medicacao ?: 'Não informado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-1 text-xs text-gray-500">
                                            Horário da medicação
                                        </p>

                                        <p class="text-sm font-semibold text-[#07311C]">
                                            {{ $atendimento->paciente?->horario_medicacao ?: 'Não informado' }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                            {{-- AÇÕES DO ATENDIMENTO --}}
                            @if (in_array($status, ['ABERTO', 'EM_ANDAMENTO']))

                                <div class="mt-6 border-t
                                            border-[#52745C]/10 pt-5">

                                    <div class="mb-4 flex items-center gap-2">

                                        <i class="ti ti-settings
                                                  text-xl text-[#52745C]"></i>

                                        <h4 class="text-sm font-semibold text-[#07311C]">
                                            Ações disponíveis
                                        </h4>

                                    </div>

                                    <div class="flex flex-wrap items-center gap-3">

                                        {{-- INICIAR --}}
                                        @if ($status === 'ABERTO')

                                            <form
                                                action="{{ route('atendimento.iniciar', $atendimento->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deseja iniciar este atendimento?')">

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl bg-[#07311C]
                                                           px-4 py-2.5 text-sm
                                                           font-semibold text-white
                                                           transition-colors
                                                           hover:bg-[#52745C]">

                                                    <i class="ti ti-player-play text-lg"></i>
                                                    Iniciar atendimento

                                                </button>

                                            </form>

                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('atendimento.editar', $atendimento->id) }}"
                                                class="inline-flex items-center gap-2
                                                       rounded-xl border
                                                       border-[#D9E2DA] bg-white
                                                       px-4 py-2.5 text-sm
                                                       font-semibold text-[#07311C]
                                                       transition-colors
                                                       hover:bg-[#E2EDE4]">

                                                <i class="ti ti-edit text-lg"></i>
                                                Editar

                                            </a>

                                            {{-- CANCELAR --}}
                                            <form
                                                action="{{ route('atendimento.cancelar', $atendimento->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Tem certeza de que deseja cancelar este atendimento?')">

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl border
                                                           border-red-200 bg-white
                                                           px-4 py-2.5 text-sm
                                                           font-semibold text-red-600
                                                           transition-colors
                                                           hover:bg-red-50">

                                                    <i class="ti ti-x text-lg"></i>
                                                    Cancelar atendimento

                                                </button>

                                            </form>

                                        @endif

                                        {{-- CONCLUIR --}}
                                        @if ($status === 'EM_ANDAMENTO')

                                            <form
                                                action="{{ route('atendimento.concluir', $atendimento->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Confirma que este atendimento foi concluído?')">

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl bg-[#07311C]
                                                           px-4 py-2.5 text-sm
                                                           font-semibold text-white
                                                           transition-colors
                                                           hover:bg-[#52745C]">

                                                    <i class="ti ti-check text-lg"></i>
                                                    Concluir atendimento

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                @empty

                    {{-- LISTAGEM VAZIA --}}
                    <div class="flex flex-col items-center
                                justify-center px-6 py-16 text-center">

                        <div class="mb-4 flex h-16 w-16 items-center
                                    justify-center rounded-2xl bg-[#F0EEE7]">

                            <i class="ti ti-calendar-off
                                      text-3xl text-[#52745C]"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-[#07311C]">
                            Nenhum atendimento encontrado
                        </h3>

                        <p class="mt-2 max-w-sm text-sm text-gray-500">
                            Ainda não existem atendimentos cadastrados.
                        </p>

                        <a
                            href="{{ route('atendimento.cadastro') }}"
                            class="mt-5 inline-flex items-center gap-2
                                   rounded-xl bg-[#07311C] px-5 py-3
                                   text-sm font-semibold text-white
                                   transition-colors hover:bg-[#52745C]">

                            <i class="ti ti-plus text-lg"></i>
                            Solicitar atendimento

                        </a>

                    </div>

                @endforelse

                {{-- MENSAGEM QUANDO O FILTRO NÃO TEM RESULTADOS --}}
                @if ($atendimentos->isNotEmpty())

                    <div
                        x-show="filtroStatus !== 'TODOS' && !@js($atendimentos->pluck('status')->values()->all()).includes(filtroStatus)"
                        x-cloak
                        class="px-6 py-14 text-center">

                        <div class="mx-auto mb-4 flex h-14 w-14
                                    items-center justify-center
                                    rounded-xl bg-[#F0EEE7]">

                            <i class="ti ti-filter-off
                                      text-2xl text-[#52745C]"></i>

                        </div>

                        <h3 class="text-sm font-semibold text-[#07311C]">
                            Nenhum atendimento neste status
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Selecione outro status para visualizar os atendimentos.
                        </p>

                        <button
                            type="button"
                            @click="filtroStatus = 'TODOS'"
                            class="mt-4 text-sm font-semibold
                                   text-[#52745C] hover:underline">

                            Mostrar todos os atendimentos

                        </button>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-sistema>
