
<x-sistema>

    @php
        $campo = 'w-full rounded-xl border border-[#D9E2DA] bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C] focus:border-[#52745C] focus:ring-[#52745C]';
        $rotulo = 'mb-2 block text-sm font-semibold text-[#07311C]';

        $statusConfig = match ($atendimento->status) {
            'ABERTO' => ['texto' => 'Aberto', 'classe' => 'bg-amber-50 text-amber-700 border-amber-200'],
            'ACEITO' => ['texto' => 'Aceito', 'classe' => 'bg-blue-50 text-blue-700 border-blue-200'],
            'EM_ANDAMENTO' => ['texto' => 'Em andamento', 'classe' => 'bg-[#E2EDE4] text-[#07311C] border-[#C8DDCC]'],
            'CONCLUIDO' => ['texto' => 'Concluído', 'classe' => 'bg-green-50 text-green-700 border-green-200'],
            'CANCELADO' => ['texto' => 'Cancelado', 'classe' => 'bg-red-50 text-red-700 border-red-200'],
            default => ['texto' => $atendimento->status, 'classe' => 'bg-gray-100 text-gray-700 border-gray-200'],
        };
    @endphp

    <div class="mx-auto max-w-6xl">

        {{-- CABEÇALHO --}}
        <x-page-header
            title="Editar Atendimento"
            subtitle="Atualize os dados do atendimento selecionado.">

            <a href="{{ route('atendimento.index') }}"
               class="inline-flex items-center gap-2 rounded-xl
                      border border-[#D9E2DA] bg-white px-5 py-3
                      text-sm font-semibold text-[#07311C]
                      transition-colors hover:bg-[#F0EEE7]">

                <i class="ti ti-arrow-left text-lg"></i>
                Voltar

            </a>

        </x-page-header>

        {{-- ERROS --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200
                        bg-red-50 p-5 text-red-700">

                <p class="mb-2 font-semibold">
                    Verifique os erros abaixo:
                </p>

                <ul class="list-inside list-disc text-sm">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <form
            action="{{ route('atendimento.atualizar', $atendimento->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- CARD: PACIENTE --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-user-heart text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Paciente
                        </h2>

                        <p class="text-sm text-gray-500">
                            Selecione o paciente deste atendimento.
                        </p>
                    </div>

                </div>

                <div>
                    <label for="paciente" class="{{ $rotulo }}">
                        Paciente selecionado
                    </label>

                    <select
                        id="paciente"
                        name="id_paciente"
                        class="{{ $campo }}"
                        onchange="mostrarPaciente()"
                        required>

                        <option value="">
                            Selecione um paciente
                        </option>

                        @foreach ($pacientes as $paciente)

                            <option
                                value="{{ $paciente->id }}"
                                data-nome="{{ $paciente->nome }}"
                                data-nascimento="{{ $paciente->data_nascimento }}"
                                data-comorbidade="{{ $paciente->comorbidade }}"
                                data-condicao="{{ $paciente->condicao_fisica }}"
                                data-fraldas="{{ $paciente->usa_fraldas }}"
                                data-medicacao="{{ $paciente->medicacao }}"
                                data-horario="{{ $paciente->horario_medicacao }}"
                                @selected(old('id_paciente', $atendimento->id_paciente) == $paciente->id)>

                                {{ $paciente->nome }}

                            </option>

                        @endforeach

                    </select>

                    @error('id_paciente')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- DETALHES DO PACIENTE --}}
                <div id="dadosPaciente"
                     class="mt-5 hidden overflow-hidden rounded-xl
                            border border-[#D9E2DA]">

                    <button
                        type="button"
                        id="botaoDetalhesPaciente"
                        onclick="alternarDetalhesPaciente()"
                        aria-expanded="false"
                        class="flex w-full items-center justify-between
                               gap-3 bg-[#F8F2EE] px-5 py-4 text-left
                               transition-colors hover:bg-[#F0EEE7]">

                        <span class="flex items-center gap-2
                                     text-sm font-semibold text-[#07311C]">

                            <i class="ti ti-heartbeat text-lg text-[#52745C]"></i>

                            Informações de saúde do paciente

                        </span>

                        <span class="flex items-center gap-2 text-sm
                                     font-medium text-[#52745C]">

                            <span id="textoDetalhesPaciente">Ver detalhes</span>

                            <i id="iconeDetalhesPaciente"
                               class="ti ti-chevron-down text-lg
                                      transition-transform"></i>

                        </span>

                    </button>

                    <div id="conteudoDetalhesPaciente"
                         class="hidden bg-white px-5 py-5">

                        <div class="grid grid-cols-1 gap-5
                                    sm:grid-cols-2 lg:grid-cols-3">

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Nome
                                </p>
                                <p id="nomePaciente"
                                   class="text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Data de nascimento
                                </p>
                                <p id="nascimentoPaciente"
                                   class="text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Comorbidades
                                </p>
                                <p id="comorbidadePaciente"
                                   class="break-words text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Condição física
                                </p>
                                <p id="condicaoPaciente"
                                   class="break-words text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Uso de fraldas
                                </p>
                                <p id="fraldasPaciente"
                                   class="text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Medicação
                                </p>
                                <p id="medicacaoPaciente"
                                   class="break-words text-sm font-semibold text-[#07311C]"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-xs text-gray-500">
                                    Horário da medicação
                                </p>
                                <p id="horarioPaciente"
                                   class="text-sm font-semibold text-[#07311C]"></p>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

            {{-- CARD: DADOS DO ATENDIMENTO --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-calendar-event text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Dados do atendimento
                        </h2>

                        <p class="text-sm text-gray-500">
                            Defina a data, jornada e horários.
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- DATA --}}
                    <div>
                        <label for="data_atendimento" class="{{ $rotulo }}">
                            Data do atendimento
                        </label>

                        <input
                            id="data_atendimento"
                            type="date"
                            name="data_atendimento"
                            value="{{ old('data_atendimento', $atendimento->data_atendimento ? \Carbon\Carbon::parse($atendimento->data_atendimento)->format('Y-m-d') : '') }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('data_atendimento')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- JORNADA --}}
                    <div>
                        <label for="tipo_jornada" class="{{ $rotulo }}">
                            Tipo de jornada
                        </label>

                        <select
                            id="tipo_jornada"
                            name="tipo_jornada"
                            class="{{ $campo }}"
                            onchange="atualizarValor()"
                            required>

                            <option value="">Selecione uma jornada</option>

                            <option value="12h_dia"
                                @selected(old('tipo_jornada', $atendimento->tipo_jornada) == '12h_dia')>
                                12 horas — Dia
                            </option>

                            <option value="12h_noite"
                                @selected(old('tipo_jornada', $atendimento->tipo_jornada) == '12h_noite')>
                                12 horas — Noite
                            </option>

                            <option value="6h"
                                @selected(old('tipo_jornada', $atendimento->tipo_jornada) == '6h')>
                                6 horas
                            </option>

                            <option value="cuidado_avulso"
                                @selected(old('tipo_jornada', $atendimento->tipo_jornada) == 'cuidado_avulso')>
                                Cuidado avulso
                            </option>

                        </select>

                        @error('tipo_jornada')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- HORÁRIO INÍCIO --}}
                    <div>
                        <label for="horario_inicio" class="{{ $rotulo }}">
                            Horário de início
                        </label>

                        <input
                            id="horario_inicio"
                            type="time"
                            name="horario_inicio"
                            value="{{ old('horario_inicio', substr($atendimento->horario_inicio, 0, 5)) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('horario_inicio')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- HORÁRIO FIM --}}
                    <div>
                        <label for="horario_fim" class="{{ $rotulo }}">
                            Horário de término
                        </label>

                        <input
                            id="horario_fim"
                            type="time"
                            name="horario_fim"
                            value="{{ old('horario_fim', substr($atendimento->horario_fim, 0, 5)) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('horario_fim')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- VALOR --}}
                <div class="mt-6 rounded-xl border border-[#D9E2DA]
                            bg-[#F8F2EE] p-5">

                    <div class="flex flex-wrap items-center
                                justify-between gap-4">

                        <div>
                            <p class="text-sm font-medium text-[#52745C]">
                                Valor do atendimento
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Calculado automaticamente pela jornada.
                            </p>
                        </div>

                        <p id="valorExibido"
                           class="text-2xl font-bold text-[#07311C]">

                            R$ {{ number_format(
                                (float) $atendimento->valor,
                                2,
                                ',',
                                '.'
                            ) }}

                        </p>

                    </div>

                    {{-- Valor numérico enviado ao Laravel --}}
                    <input
                        type="hidden"
                        id="valor"
                        name="valor"
                        value="{{ old('valor', $atendimento->valor) }}"
                    >

                    @error('valor')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </section>

            {{-- CARD: CUIDADOR E SITUAÇÃO --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-user-shield text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Cuidador e situação
                        </h2>

                        <p class="text-sm text-gray-500">
                            Profissional responsável e status do atendimento.
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- CUIDADOR --}}
                    <div>
                        <label for="cuidador" class="{{ $rotulo }}">
                            Cuidador
                        </label>

                        <select
                            id="cuidador"
                            name="id_cuidador"
                            class="{{ $campo }}">

                            <option value="">
                                Selecione um cuidador
                            </option>

                            @foreach ($cuidadores as $cuidador)

                                <option
                                    value="{{ $cuidador->id }}"
                                    @selected(old('id_cuidador', $atendimento->id_cuidador) == $cuidador->id)>

                                    {{ $cuidador->nome }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_cuidador')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <label class="{{ $rotulo }}">
                            Situação atual
                        </label>

                        <div class="flex min-h-[48px] items-center
                                    rounded-xl border border-[#D9E2DA]
                                    bg-[#F8F2EE] px-4">

                            <span class="inline-flex items-center
                                         rounded-full border px-3 py-1
                                         text-xs font-semibold
                                         {{ $statusConfig['classe'] }}">

                                {{ $statusConfig['texto'] }}

                            </span>

                        </div>
                    </div>

                </div>

                <p class="mt-4 flex items-start gap-2 text-xs text-gray-500">

                    <i class="ti ti-info-circle mt-0.5 text-base"></i>

                    A edição dos dados não altera o status do atendimento.

                </p>

            </section>

            {{-- BOTÕES --}}
            <div class="flex flex-wrap items-center justify-end
                        gap-3 pb-6">

                <a href="{{ route('atendimento.index') }}"
                   class="rounded-xl border border-[#D9E2DA]
                          bg-white px-6 py-3 text-sm font-semibold
                          text-[#07311C] transition-colors
                          hover:bg-[#F0EEE7]">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#07311C] px-6 py-3 text-sm
                           font-semibold text-white transition-colors
                           hover:bg-[#52745C]">

                    <i class="ti ti-device-floppy text-lg"></i>
                    Salvar alterações

                </button>

            </div>

        </form>

    </div>

    <script>
        function mostrarPaciente() {
            const select = document.getElementById('paciente');
            const opcao = select.options[select.selectedIndex];
            const dados = document.getElementById('dadosPaciente');

            if (!select.value) {
                dados.classList.add('hidden');
                document.getElementById('conteudoDetalhesPaciente').classList.add('hidden');
                document.getElementById('textoDetalhesPaciente').textContent = 'Ver detalhes';
                document.getElementById('iconeDetalhesPaciente').classList.remove('rotate-180');
                document.getElementById('botaoDetalhesPaciente').setAttribute('aria-expanded', 'false');
                return;
            }

            const preencher = (id, valor) => {
                document.getElementById(id).textContent = valor || 'Não informado';
            };

            preencher('nomePaciente', opcao.dataset.nome);

            const nascimento = opcao.dataset.nascimento;

            if (nascimento) {
                const partes = nascimento.substring(0, 10).split('-');

                preencher(
                    'nascimentoPaciente',
                    partes.length === 3
                        ? `${partes[2]}/${partes[1]}/${partes[0]}`
                        : nascimento
                );
            } else {
                preencher('nascimentoPaciente', '');
            }

            preencher('comorbidadePaciente', opcao.dataset.comorbidade);
            preencher('condicaoPaciente', opcao.dataset.condicao);
            preencher('medicacaoPaciente', opcao.dataset.medicacao);
            preencher('horarioPaciente', opcao.dataset.horario);

            const fraldas = opcao.dataset.fraldas;

            preencher(
                'fraldasPaciente',
                fraldas === '1' ? 'Sim' :
                fraldas === '0' ? 'Não' : 'Não informado'
            );

            dados.classList.remove('hidden');
        }

        function alternarDetalhesPaciente() {
            const conteudo = document.getElementById('conteudoDetalhesPaciente');
            const texto = document.getElementById('textoDetalhesPaciente');
            const icone = document.getElementById('iconeDetalhesPaciente');
            const botao = document.getElementById('botaoDetalhesPaciente');

            const estavaFechado = conteudo.classList.contains('hidden');

            conteudo.classList.toggle('hidden');

            texto.textContent = estavaFechado
                ? 'Ocultar detalhes'
                : 'Ver detalhes';

            icone.classList.toggle('rotate-180', estavaFechado);
            botao.setAttribute('aria-expanded', String(estavaFechado));
        }

        function atualizarValor() {
            const jornada = document.getElementById('tipo_jornada').value;
            const valor = document.getElementById('valor');
            const exibido = document.getElementById('valorExibido');

            const precos = {
                '12h_dia': 180,
                '12h_noite': 200,
                '6h': 100,
                'cuidado_avulso': 80
            };

            const preco = precos[jornada] ?? 0;

            valor.value = preco.toFixed(2);

            exibido.textContent = preco.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            mostrarPaciente();
        });
    </script>

</x-sistema>
