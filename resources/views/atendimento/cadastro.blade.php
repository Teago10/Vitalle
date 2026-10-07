<x-sistema>


    <div class="max-w-6xl mx-auto">

        <x-page-header title="Solicitar Atendimento" subtitle="Preencha os dados para solicitar um novo atendimento.">

            <a href="{{ route('atendimento.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-3 rounded-lg flex items-center gap-2">

                <i class="ti ti-arrow-left"></i>
                Voltar

            </a>

        </x-page-header>


        {{-- MENSAGEM DE SUCESSO --}}
        @if (session('sucesso'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-lg">

                {{ session('sucesso') }}

            </div>
        @endif


        {{-- FORMULÁRIO --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <form action="{{ route('atendimento.armazenar') }}" method="POST">

                @csrf


                {{-- ==================== PACIENTE ==================== --}}

                <div class="mb-8">

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Paciente
                    </h2>


                    <label for="paciente" class="block text-sm font-medium text-gray-700 mb-2">

                        Selecione o paciente

                    </label>


                    <select id="paciente" name="id_paciente"
                        class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                        onchange="mostrarPaciente()" required>

                        <option value="">
                            Selecione um paciente
                        </option>


                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" data-nome="{{ $paciente->nome }}"
                                data-nascimento="{{ $paciente->data_nascimento }}"
                                data-comorbidade="{{ $paciente->comorbidade }}"
                                data-condicao="{{ $paciente->condicao_fisica }}"
                                data-fraldas="{{ $paciente->usa_fraldas }}" data-medicacao="{{ $paciente->medicacao }}"
                                data-horario="{{ $paciente->horario_medicacao }}">

                                {{ $paciente->nome }}

                            </option>
                        @endforeach

                    </select>


                    {{-- DADOS DO PACIENTE --}}

                    <div id="dadosPaciente" class="hidden mt-6 border rounded-lg p-5 bg-gray-50">

                        <h3 class="text-md font-semibold mb-4">
                            Informações do paciente
                        </h3>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                            <div>

                                <p class="text-sm text-gray-500">
                                    Nome
                                </p>

                                <p id="nomePaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Data de nascimento
                                </p>

                                <p id="nascimentoPaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Comorbidade
                                </p>

                                <p id="comorbidadePaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Condição física
                                </p>

                                <p id="condicaoPaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Usa fraldas?
                                </p>

                                <p id="fraldasPaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Medicação
                                </p>

                                <p id="medicacaoPaciente" class="font-medium">
                                </p>

                            </div>


                            <div>

                                <p class="text-sm text-gray-500">
                                    Horário da medicação
                                </p>

                                <p id="horarioPaciente" class="font-medium">
                                </p>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- ==================== DADOS DO ATENDIMENTO ==================== --}}

                <div class="mb-8">

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Dados do atendimento
                    </h2>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- DATA --}}

                        <div>

                            <label for="data_atendimento" class="block text-sm font-medium text-gray-700 mb-2">

                                Data

                            </label>


                            <input type="date" id="data_atendimento" name="data_atendimento"
                                class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                                required>

                        </div>


                        {{-- JORNADA --}}

                        <div>

                            <label for="tipo_jornada" class="block text-sm font-medium text-gray-700 mb-2">

                                Tipo de jornada

                            </label>


                            <select id="tipo_jornada" name="tipo_jornada"
                                class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                                onchange="atualizarValor()" required>

                                <option value="">
                                    Selecione
                                </option>

                                <option value="12h_dia">
                                    12h Dia
                                </option>

                                <option value="12h_noite">
                                    12h Noite
                                </option>

                                <option value="6h">
                                    6h
                                </option>

                                <option value="cuidado_avulso">
                                    Cuidado Avulso
                                </option>

                            </select>

                        </div>


                        {{-- HORÁRIO INÍCIO --}}

                        <div>

                            <label for="horario_inicio" class="block text-sm font-medium text-gray-700 mb-2">

                                Horário de início

                            </label>


                            <input type="time" id="horario_inicio" name="horario_inicio"
                                class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                                required>

                        </div>


                        {{-- HORÁRIO FIM --}}

                        <div>

                            <label for="horario_fim" class="block text-sm font-medium text-gray-700 mb-2">

                                Horário de término

                            </label>


                            <input type="time" id="horario_fim" name="horario_fim"
                                class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                                required>

                        </div>

                    </div>


                    {{-- VALOR --}}

                    <div class="mt-6">

                        <label for="valor" class="block text-sm font-medium text-gray-700 mb-2">

                            Valor do atendimento

                        </label>


                        <input type="text" id="valor" name="valor"
                            class="w-full rounded-lg border-gray-300 bg-gray-100" readonly>

                    </div>

                </div>


                {{-- ==================== CUIDADOR ==================== --}}

                <div class="mb-8">

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Cuidador
                    </h2>


                    <label for="cuidador" class="block text-sm font-medium text-gray-700 mb-2">

                        Selecione o cuidador

                    </label>


                    <select id="cuidador" name="id_cuidador"
                        class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        <option value="">
                            Selecione um cuidador
                        </option>


                        @foreach ($cuidadores as $cuidador)
                            <option value="{{ $cuidador->id }}">
                                {{ $cuidador->nome }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- BOTÕES --}}

                <div class="flex justify-end gap-4 mt-10">

                    <a href="{{ route('atendimento.index') }}"
                        class="px-6 py-3 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800">

                        Cancelar

                    </a>


                    <button type="submit" class="px-6 py-3 rounded-lg bg-[#5FA83D] hover:bg-[#4b8b2f] text-white">

                        Solicitar Atendimento

                    </button>

                </div>


            </form>

        </div>

    </div>


    {{-- ==================== JAVASCRIPT ==================== --}}

    <script>
        function mostrarPaciente() {
            const select = document.getElementById('paciente');

            const opcao = select.options[select.selectedIndex];

            const dadosPaciente =
                document.getElementById('dadosPaciente');


            if (select.value === '') {
                dadosPaciente.classList.add('hidden');

                return;
            }


            document.getElementById('nomePaciente').textContent =
                opcao.dataset.nome;


            document.getElementById('nascimentoPaciente').textContent =
                opcao.dataset.nascimento;


            document.getElementById('comorbidadePaciente').textContent =
                opcao.dataset.comorbidade || 'Não informado';


            document.getElementById('condicaoPaciente').textContent =
                opcao.dataset.condicao || 'Não informado';


            let usaFraldas = opcao.dataset.fraldas;


            if (usaFraldas == '1') {
                usaFraldas = 'Sim';
            } else if (usaFraldas == '0') {
                usaFraldas = 'Não';
            } else {
                usaFraldas = 'Não informado';
            }


            document.getElementById('fraldasPaciente').textContent =
                usaFraldas;


            document.getElementById('medicacaoPaciente').textContent =
                opcao.dataset.medicacao || 'Não informado';


            document.getElementById('horarioPaciente').textContent =
                opcao.dataset.horario || 'Não informado';


            dadosPaciente.classList.remove('hidden');
        }


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



        function atualizarValor() {
            const jornada =
                document.getElementById('tipo_jornada').value;

            const valor =
                document.getElementById('valor');


            if (jornada === '12h_dia') {
                valor.value = 'R$ 180,00';
            } else if (jornada === '12h_noite') {
                valor.value = 'R$ 200,00';
            } else if (jornada === '6h') {
                valor.value = 'R$ 100,00';
            } else if (jornada === 'cuidado_avulso') {
                valor.value = 'R$ 80,00';
            } else {
                valor.value = '';
            }
        }
    </script>


</x-sistema>
