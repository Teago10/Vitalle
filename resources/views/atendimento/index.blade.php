<x-sistema>

    <div class="max-w-6xl mx-auto mt-0">
        <x-page-header title="Atendimentos" subtitle="Visualize e gerencie os atendimentos solicitados.">

            <a href="{{ route('atendimento.cadastro') }}"
                class="bg-[#5FA83D] hover:bg-[#4b8b2f] text-white px-5 py-3 rounded-lg flex items-center gap-2">

                <i class="ti ti-plus"></i>
                Novo Atendimento

            </a>

        </x-page-header>


        {{-- Mensagem de sucesso --}}
        @if (session('sucesso'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-xl">
                {{ session('sucesso') }}
            </div>
        @endif


        <div class="bg-white rounded-3xl shadow-lg p-8">

            @if ($atendimentos->isEmpty())

                <div class="text-center py-12">

                    <i class="ti ti-calendar-off text-5xl text-gray-300"></i>

                    <h3 class="mt-4 text-lg font-semibold text-gray-700">
                        Nenhum atendimento encontrado
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Ainda não existem atendimentos cadastrados.
                    </p>

                    <a href="{{ route('atendimento.cadastro') }}"
                        class="inline-flex items-center gap-2 mt-6 bg-[#5FA83D] hover:bg-[#4b8b2f] text-white px-5 py-3 rounded-lg">

                        <i class="ti ti-plus"></i>
                        Solicitar Atendimento

                    </a>

                </div>
            @else
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-gray-200">

                                <th class="text-left py-4 px-3">
                                    Paciente
                                </th>

                                <th class="text-left py-4 px-3">
                                    Data
                                </th>

                                <th class="text-left py-4 px-3">
                                    Horário
                                </th>

                                <th class="text-left py-4 px-3">
                                    Jornada
                                </th>

                                <th class="text-left py-4 px-3">
                                    Cuidador
                                </th>

                                <th class="text-left py-4 px-3">
                                    Valor
                                </th>

                                <th class="text-left py-4 px-3">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($atendimentos as $atendimento)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">

                                    <td class="py-4 px-3 font-medium text-gray-800">

                                        <div>
                                            {{ $atendimento->paciente->nome }}
                                        </div>

                                        <button type="button"
                                            onclick="mostrarMaisPaciente({{ $atendimento->id }}, this)"
                                            class="mt-1 text-sm text-[#5FA83D] hover:text-[#4b8b2f] font-medium">
                                            Ver mais
                                        </button>

                                    </td>

                                    <td class="py-4 px-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($atendimento->data_atendimento)->format('d/m/Y') }}
                                    </td>

                                    <td class="py-4 px-3 text-gray-600">
                                        {{ substr($atendimento->horario_inicio, 0, 5) }}
                                        -
                                        {{ substr($atendimento->horario_fim, 0, 5) }}
                                    </td>

                                    <td class="py-4 px-3 text-gray-600">
                                        {{ $atendimento->tipo_jornada }}
                                    </td>

                                    <td class="py-4 px-3 text-gray-600">

                                        @if ($atendimento->cuidador)
                                            {{ $atendimento->cuidador->nome }}
                                        @else
                                            <span class="text-gray-400">
                                                Aguardando cuidador
                                            </span>
                                        @endif

                                    </td>

                                    <td class="py-4 px-3 text-gray-600">
                                        R$ {{ number_format($atendimento->valor, 2, ',', '.') }}
                                    </td>

                                    <td class="py-4 px-3">

                                        @if ($atendimento->status === 'ABERTO')
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                                                Aberto
                                            </span>
                                        @elseif ($atendimento->status === 'ACEITO')
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                                Aceito
                                            </span>
                                        @elseif ($atendimento->status === 'EM_ANDAMENTO')
                                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                                                Em andamento
                                            </span>
                                        @elseif ($atendimento->status === 'CONCLUIDO')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                                Concluído
                                            </span>
                                        @elseif ($atendimento->status === 'CANCELADO')
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                                Cancelado
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                                {{ $atendimento->status }}
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                                <tr id="maisPaciente-{{ $atendimento->id }}" class="hidden">

                                    <td colspan="7" class="px-6 py-5 bg-gray-50">

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Data de nascimento
                                                </p>

                                                <p class="font-medium text-gray-800">
                                                    {{ $atendimento->paciente->data_nascimento
                                                        ? \Carbon\Carbon::parse($atendimento->paciente->data_nascimento)->format('d/m/Y')
                                                        : 'Não informado' }}
                                                </p>
                                            </div>


                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Comorbidade
                                                </p>

                                                <p class="font-medium text-gray-800">
                                                    {{ $atendimento->paciente->comorbidade ?: 'Não informado' }}
                                                </p>
                                            </div>


                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Condição física
                                                </p>

                                                <p class="font-medium text-gray-800">
                                                    {{ $atendimento->paciente->condicao_fisica ?: 'Não informado' }}
                                                </p>
                                            </div>


                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Usa fraldas?
                                                </p>

                                                <p class="font-medium text-gray-800">

                                                    @if ($atendimento->paciente->usa_fraldas == 1)
                                                        Sim
                                                    @elseif ($atendimento->paciente->usa_fraldas == 0)
                                                        Não
                                                    @else
                                                        Não informado
                                                    @endif

                                                </p>
                                            </div>


                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Medicação
                                                </p>

                                                <p class="font-medium text-gray-800">
                                                    {{ $atendimento->paciente->medicacao ?: 'Não informado' }}
                                                </p>
                                            </div>


                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Horário da medicação
                                                </p>

                                                <p class="font-medium text-gray-800">
                                                    {{ $atendimento->paciente->horario_medicacao ?: 'Não informado' }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

    <script>
        function mostrarMaisPaciente(id, botao) {
            const informacoes =
                document.getElementById('maisPaciente-' + id);

            if (informacoes.classList.contains('hidden')) {
                informacoes.classList.remove('hidden');
                botao.innerHTML = 'Ver menos';
            } else {
                informacoes.classList.add('hidden');
                botao.innerHTML = 'Ver mais';
            }
        }
    </script>

</x-sistema>
