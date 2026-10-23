
<x-sistema>

    @php
        $campo = 'w-full rounded-xl border border-[#D9E2DA] bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C] focus:border-[#52745C] focus:ring-[#52745C]';
        $rotulo = 'mb-2 block text-sm font-semibold text-[#07311C]';
    @endphp

    <div class="mx-auto max-w-6xl">

        <x-page-header
            title="Editar Paciente"
            subtitle="Atualize os dados e informações do paciente.">

            <a href="{{ route('admin.paciente.index') }}"
               class="inline-flex items-center gap-2 rounded-xl border
                      border-[#D9E2DA] bg-white px-5 py-3
                      text-sm font-semibold text-[#07311C]
                      transition-colors hover:bg-[#F0EEE7]">

                <i class="ti ti-arrow-left text-lg"></i>
                Voltar

            </a>

        </x-page-header>

        {{-- Erros de validação --}}
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
            action="{{ route('profile.paciente.atualizar', $paciente->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- INFORMAÇÕES PESSOAIS --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-user text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Informações pessoais
                        </h2>

                        <p class="text-sm text-gray-500">
                            Dados de identificação do paciente.
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Nome --}}
                    <div>
                        <label for="nome" class="{{ $rotulo }}">
                            Nome completo
                        </label>

                        <input
                            id="nome"
                            type="text"
                            name="nome"
                            value="{{ old('nome', $paciente->nome) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('nome')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Responsável --}}
                    <div>
                        <label for="id_responsavel" class="{{ $rotulo }}">
                            Responsável
                        </label>

                        <select
                            id="id_responsavel"
                            name="id_responsavel"
                            class="{{ $campo }}"
                            required>

                            <option value="">
                                Selecione um responsável
                            </option>

                            @foreach ($responsaveis as $id => $nome)

                                <option
                                    value="{{ $id }}"
                                    @selected(old('id_responsavel', $paciente->id_responsavel) == $id)>

                                    {{ $nome }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_responsavel')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Data de nascimento --}}
                    <div>
                        <label for="data_nascimento" class="{{ $rotulo }}">
                            Data de nascimento
                        </label>

                        <input
                            id="data_nascimento"
                            type="date"
                            name="data_nascimento"
                            value="{{ old('data_nascimento', $paciente->data_nascimento) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('data_nascimento')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- E-mail --}}
                    <div>
                        <label for="email" class="{{ $rotulo }}">
                            E-mail
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $paciente->email) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </section>

            {{-- INFORMAÇÕES DE SAÚDE --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-heartbeat text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Informações de saúde
                        </h2>

                        <p class="text-sm text-gray-500">
                            Condições e necessidades de cuidado.
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Comorbidade --}}
                    <div>
                        <label for="comorbidade" class="{{ $rotulo }}">
                            Comorbidades
                        </label>

                        <input
                            id="comorbidade"
                            type="text"
                            name="comorbidade"
                            value="{{ old('comorbidade', $paciente->comorbidade) }}"
                            class="{{ $campo }}"
                            placeholder="Ex.: Hipertensão, diabetes"
                        >

                        @error('comorbidade')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Condição física --}}
                    <div>
                        <label for="condicao_fisica" class="{{ $rotulo }}">
                            Condição física
                        </label>

                        <input
                            id="condicao_fisica"
                            type="text"
                            name="condicao_fisica"
                            value="{{ old('condicao_fisica', $paciente->condicao_fisica) }}"
                            class="{{ $campo }}"
                            placeholder="Descreva a condição física"
                        >

                        @error('condicao_fisica')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Medicação --}}
                    <div>
                        <label for="medicacao" class="{{ $rotulo }}">
                            Medicação
                        </label>

                        <input
                            id="medicacao"
                            type="text"
                            name="medicacao"
                            value="{{ old('medicacao', $paciente->medicacao) }}"
                            class="{{ $campo }}"
                            placeholder="Informe a medicação"
                        >

                        @error('medicacao')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Horário da medicação --}}
                    <div>
                        <label for="horario_medicacao" class="{{ $rotulo }}">
                            Horário da medicação
                        </label>

                        <input
                            id="horario_medicacao"
                            type="text"
                            name="horario_medicacao"
                            value="{{ old('horario_medicacao', $paciente->horario_medicacao) }}"
                            class="{{ $campo }}"
                            placeholder="Ex.: 08:00 e 20:00"
                        >

                        @error('horario_medicacao')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Usa fraldas --}}
                    <div class="flex items-center md:col-span-2">

                        <label class="flex cursor-pointer items-center gap-3
                                      rounded-xl border border-[#D9E2DA]
                                      bg-[#F8F2EE] px-5 py-4">

                            <input type="hidden" name="usa_fraldas" value="0">

                            <input
                                type="checkbox"
                                name="usa_fraldas"
                                value="1"
                                @checked(old('usa_fraldas', $paciente->usa_fraldas))
                                class="rounded border-[#D9E2DA]
                                       text-[#52745C] focus:ring-[#52745C]"
                            >

                            <span class="text-sm font-medium text-[#07311C]">
                                O paciente utiliza fraldas
                            </span>

                        </label>

                    </div>

                </div>

            </section>

            {{-- ENDEREÇO --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-map-pin text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Endereço
                        </h2>

                        <p class="text-sm text-gray-500">
                            Localização e dados residenciais.
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- CEP --}}
                    <div>
                        <label for="cep" class="{{ $rotulo }}">
                            CEP
                        </label>

                        <input
                            id="cep"
                            type="text"
                            name="cep"
                            value="{{ old('cep', $paciente->cep) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('cep')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Rua --}}
                    <div>
                        <label for="rua" class="{{ $rotulo }}">
                            Rua
                        </label>

                        <input
                            id="rua"
                            type="text"
                            name="rua"
                            value="{{ old('rua', $paciente->rua) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('rua')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Número --}}
                    <div>
                        <label for="numero" class="{{ $rotulo }}">
                            Número
                        </label>

                        <input
                            id="numero"
                            type="text"
                            name="numero"
                            value="{{ old('numero', $paciente->numero) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('numero')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Complemento --}}
                    <div>
                        <label for="complemento" class="{{ $rotulo }}">
                            Complemento
                        </label>

                        <input
                            id="complemento"
                            type="text"
                            name="complemento"
                            value="{{ old('complemento', $paciente->complemento) }}"
                            class="{{ $campo }}"
                            placeholder="Apartamento, bloco, referência..."
                        >

                        @error('complemento')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Bairro --}}
                    <div>
                        <label for="bairro" class="{{ $rotulo }}">
                            Bairro
                        </label>

                        <input
                            id="bairro"
                            type="text"
                            name="bairro"
                            value="{{ old('bairro', $paciente->bairro) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('bairro')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Cidade --}}
                    <div>
                        <label for="cidade" class="{{ $rotulo }}">
                            Cidade
                        </label>

                        <input
                            id="cidade"
                            type="text"
                            name="cidade"
                            value="{{ old('cidade', $paciente->cidade) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('cidade')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label for="estado" class="{{ $rotulo }}">
                            Estado
                        </label>

                        <input
                            id="estado"
                            type="text"
                            name="estado"
                            value="{{ old('estado', $paciente->estado) }}"
                            class="{{ $campo }}"
                            required
                        >

                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </section>

            {{-- BOTÕES --}}
            <div class="flex flex-wrap items-center justify-end gap-3 pb-6">

                <a href="{{ route('admin.paciente.index') }}"
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

</x-sistema>
