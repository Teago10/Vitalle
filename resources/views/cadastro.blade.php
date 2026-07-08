<x-sistema>

    <div class="max-w-6xl mx-auto">

        <x-page-header title="Cadastrar Paciente" subtitle="Preencha os dados para cadastrar um novo paciente.">

            <a href="{{ route('admin.paciente.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-3 rounded-lg flex items-center gap-2">
                <i class="ti ti-arrow-left"></i>
                Voltar
            </a>

        </x-page-header>

        <div class="bg-white rounded-3xl shadow-lg p-8">

            <form action="{{route('profile.paciente.armazenar')}}" method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nome --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nome
                        </label>

                        <input type="text" name="nome" value="{{ old('nome') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('nome')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Responsável --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Responsável
                        </label>

                        <select name="id_responsavel"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                            <option value="">Selecione um responsável</option>

                            

                            @foreach ($responsaveis as $id => $nome)
                                <option value="{{ $id }}" {{old('id_responsavel', $paciente->id_responsavel) == $id ? 'selected' : ''}}>

                                    {{ $nome }}

                                </option>
                            @endforeach



                        </select>

                        @error('id_responsavel')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Data de nascimento --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Data de nascimento
                        </label>

                        <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('data_nascimento')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Email --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Comorbidade --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Comorbidade
                        </label>

                        <input type="text" name="comorbidade" value="{{ old('comorbidade') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        @error('comorbidade')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Condição Física --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Condição Física
                        </label>

                        <input type="text" name="condicao_fisica" value="{{ old('condicao_fisica') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        @error('condicao_fisica')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Medicação --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Medicação
                        </label>

                        <input type="text" name="medicacao" value="{{ old('medicacao') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        @error('medicacao')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Horário da Medicação --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Horário da Medicação
                        </label>

                        <input type="text" name="horario_medicacao" value="{{ old('horario_medicacao') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        @error('horario_medicacao')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- CEP --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            CEP
                        </label>

                        <input type="text" id="cep" name="cep" value="{{ old('cep') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('cep')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Rua --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Rua
                        </label>

                        <input type="text" id="rua" name="rua" value="{{ old('rua') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('rua')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Número --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Número
                        </label>

                        <input type="text" name="numero" value="{{ old('numero') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('numero')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Complemento --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Complemento
                        </label>

                        <input type="text" name="complemento" value="{{ old('complemento') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]">

                        @error('complemento')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Bairro --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bairro
                        </label>

                        <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('bairro')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Cidade --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Cidade
                        </label>

                        <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('cidade')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Estado --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Estado
                        </label>

                        <input type="text" id="estado" name="estado" value="{{ old('estado') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                            required>

                        @error('estado')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Usa Fraldas --}}
                    <div class="flex items-center gap-3 mt-8">

                        <input type="checkbox" id="usa_fraldas" name="usa_fraldas" value="1"
                            {{ old('usa_fraldas') ? 'checked' : '' }}
                            class="rounded border-gray-300 text-[#5FA83D] focus:ring-[#5FA83D]">

                        <label for="usa_fraldas">
                            Usa fraldas
                        </label>

                    </div>

                </div>

                <div class="flex justify-end gap-4 mt-10">

                    <a href="#" class="px-6 py-3 rounded-lg bg-gray-200 hover:bg-gray-300">
                        Cancelar
                    </a>

                    <button type="submit" class="px-6 py-3 rounded-lg bg-[#5FA83D] hover:bg-[#4b8b2f] text-white">

                        Salvar Paciente

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-sistema>
