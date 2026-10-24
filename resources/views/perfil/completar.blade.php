<x-guest-layout>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    @php
        $ehCuidador = $usuario->tipo_usuario === 'cuidador';
    @endphp

    {{-- Cabeçalho --}}
    <div class="mb-8 text-center">

        <div
            class="mx-auto mb-4 flex h-16 w-16
                    items-center justify-center
                    rounded-2xl bg-[#07311C]">

            <i class="ti ti-user-check text-4xl text-[#BBF0B9]"></i>

        </div>

        <h1 class="text-3xl font-bold text-[#07311C]">
            Complete seu perfil
        </h1>

        <p class="mt-2 text-sm text-[#52745C]">
            Precisamos de algumas informações para finalizar
            seu cadastro no Vitalle.
        </p>

        <div
            class="mt-4 inline-flex items-center gap-2
                    rounded-full bg-[#EAF2EB] px-4 py-2
                    text-sm font-semibold text-[#07311C]">

            <i class="ti {{ $ehCuidador ? 'ti-stethoscope' : 'ti-user-heart' }}"></i>

            {{ $ehCuidador ? 'Cadastro de Cuidador' : 'Cadastro de Responsável' }}

        </div>

    </div>

    {{-- Formulário --}}
    <form method="POST" action="{{ route('perfil.salvar') }}" class="space-y-5">

        @csrf

        {{-- Informações da conta --}}
        <div class="rounded-xl border border-[#D9E2DA]
                    bg-[#EAF2EB] p-4">

            <p class="mb-2 text-sm font-semibold text-[#07311C]">
                Informações da sua conta
            </p>

            <p class="text-sm text-[#52745C]">
                <strong>Nome:</strong> {{ $usuario->name }}
            </p>

            <p class="mt-1 text-sm text-[#52745C]">
                <strong>E-mail:</strong> {{ $usuario->email }}
            </p>

        </div>

        {{-- Telefone --}}
        <div>
            <label for="telefone" class="mb-2 block text-sm font-semibold text-[#07311C]">
                Telefone
            </label>

            <input id="telefone" type="tel" name="telefone" value="{{ old('telefone') }}" maxlength="20" required
                placeholder="(14) 99999-9999"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                       focus:border-[#52745C] focus:ring-[#52745C]">

            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        {{-- CPF --}}
        <div>
            <label for="cpf" class="mb-2 block text-sm font-semibold text-[#07311C]">
                CPF
            </label>

            <input id="cpf" type="text" name="cpf" value="{{ old('cpf') }}" maxlength="14" required
                placeholder="000.000.000-00"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                       focus:border-[#52745C] focus:ring-[#52745C]">

            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        {{-- Qualificação: apenas cuidador --}}
        @if ($ehCuidador)
            <div>
                <label for="qualificacao" class="mb-2 block text-sm font-semibold text-[#07311C]">
                    Qualificação profissional
                    <span class="font-normal text-[#52745C]">(opcional)</span>
                </label>

                <input id="qualificacao" type="text" name="qualificacao" value="{{ old('qualificacao') }}"
                    maxlength="150" placeholder="Ex.: Técnico em Enfermagem"
                    class="block w-full rounded-xl border border-[#D9E2DA]
                           bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                           focus:border-[#52745C] focus:ring-[#52745C]">

                <x-input-error :messages="$errors->get('qualificacao')" class="mt-2" />
            </div>
        @endif

        {{-- Endereço --}}
        <div class="border-t border-[#D9E2DA] pt-5">

            <h2 class="mb-1 text-lg font-bold text-[#07311C]">
                Endereço
            </h2>

            <p class="mb-5 text-sm text-[#52745C]">
                {{ $ehCuidador ? 'Preencha seu endereço, se desejar.' : 'Informe seu endereço para completar o cadastro.' }}
            </p>

            <div class="space-y-5">

                {{-- CEP --}}
                <div>
                    <label for="cep" class="mb-2 block text-sm font-semibold text-[#07311C]">
                        CEP
                    </label>

                    <input id="cep" type="text" name="cep" value="{{ old('cep') }}" maxlength="10"
                        placeholder="00000-000" {{ $ehCuidador ? '' : 'required' }}
                        class="block w-full rounded-xl border border-[#D9E2DA]
                               bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                               focus:border-[#52745C] focus:ring-[#52745C]">

                    <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                </div>

                {{-- Rua --}}
                <div>
                    <label for="rua" class="mb-2 block text-sm font-semibold text-[#07311C]">
                        Rua
                    </label>

                    <input id="rua" type="text" name="rua" value="{{ old('rua') }}" maxlength="200"
                        placeholder="Nome da rua" {{ $ehCuidador ? '' : 'required' }}
                        class="block w-full rounded-xl border border-[#D9E2DA]
                               bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                               focus:border-[#52745C] focus:ring-[#52745C]">

                    <x-input-error :messages="$errors->get('rua')" class="mt-2" />
                </div>

                {{-- Número e complemento --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <label for="numero" class="mb-2 block text-sm font-semibold text-[#07311C]">
                            Número
                        </label>

                        <input id="numero" type="text" name="numero" value="{{ old('numero') }}" maxlength="20"
                            placeholder="123" {{ $ehCuidador ? '' : 'required' }}
                            class="block w-full rounded-xl border border-[#D9E2DA]
                                   bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                                   focus:border-[#52745C] focus:ring-[#52745C]">

                        <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                    </div>

                    <div>
                        <label for="complemento" class="mb-2 block text-sm font-semibold text-[#07311C]">
                            Complemento
                            <span class="font-normal text-[#52745C]">(opcional)</span>
                        </label>

                        <input id="complemento" type="text" name="complemento" value="{{ old('complemento') }}"
                            maxlength="{{ $ehCuidador ? 50 : 100 }}" placeholder="Apto, bloco..."
                            class="block w-full rounded-xl border border-[#D9E2DA]
                                   bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                                   focus:border-[#52745C] focus:ring-[#52745C]">

                        <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
                    </div>

                </div>

                {{-- Bairro --}}
                <div>
                    <label for="bairro" class="mb-2 block text-sm font-semibold text-[#07311C]">
                        Bairro
                    </label>

                    <input id="bairro" type="text" name="bairro" value="{{ old('bairro') }}" maxlength="100"
                        placeholder="Nome do bairro" {{ $ehCuidador ? '' : 'required' }}
                        class="block w-full rounded-xl border border-[#D9E2DA]
                               bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                               focus:border-[#52745C] focus:ring-[#52745C]">

                    <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                </div>

                {{-- Cidade e estado --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <label for="cidade" class="mb-2 block text-sm font-semibold text-[#07311C]">
                            Cidade
                        </label>

                        <input id="cidade" type="text" name="cidade" value="{{ old('cidade') }}"
                            maxlength="100" placeholder="Sua cidade" {{ $ehCuidador ? '' : 'required' }}
                            class="block w-full rounded-xl border border-[#D9E2DA]
                                   bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                                   focus:border-[#52745C] focus:ring-[#52745C]">

                        <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                    </div>

                    <div>
                        <label for="estado" class="mb-2 block text-sm font-semibold text-[#07311C]">
                            Estado
                        </label>

                        <input id="estado" type="text" name="estado" value="{{ old('estado') }}"
                            maxlength="50" placeholder="Ex.: SP" {{ $ehCuidador ? '' : 'required' }}
                            class="block w-full rounded-xl border border-[#D9E2DA]
                                   bg-[#F8F2EE] px-4 py-3 text-sm text-[#07311C]
                                   focus:border-[#52745C] focus:ring-[#52745C]">

                        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                    </div>

                </div>

            </div>

        </div>

        {{-- Finalizar --}}
        <div class="pt-3">

            <button type="submit"
                class="flex w-full items-center justify-center gap-2
                       rounded-xl bg-[#07311C] px-6 py-3.5
                       text-sm font-semibold text-white
                       transition-colors hover:bg-[#52745C]">

                Finalizar meu cadastro

                <i class="ti ti-arrow-right text-lg"></i>

            </button>

        </div>

    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const campoCep = document.getElementById('cep');
            const campoRua = document.getElementById('rua');
            const campoBairro = document.getElementById('bairro');
            const campoCidade = document.getElementById('cidade');
            const campoEstado = document.getElementById('estado');

            let ultimaConsulta = 0;

            campoCep.addEventListener('input', async function() {

                // Remove caracteres que não são números.
                const cep = campoCep.value.replace(/\D/g, '');

                // Aplica a máscara 00000-000.
                campoCep.value = cep.length > 5 ?
                    cep.slice(0, 5) + '-' + cep.slice(5, 8) :
                    cep;

                // Identifica a consulta mais recente.
                const consultaAtual = ++ultimaConsulta;

                // Só consulta quando o CEP tiver 8 dígitos.
                if (cep.length !== 8) {
                    return;
                }

                try {

                    const resposta = await fetch(
                        `https://viacep.com.br/ws/${cep}/json/`
                    );

                    if (!resposta.ok) {
                        throw new Error('Erro na consulta do CEP.');
                    }

                    const endereco = await resposta.json();

                    // Evita preencher dados de uma consulta antiga.
                    if (consultaAtual !== ultimaConsulta) {
                        return;
                    }

                    if (endereco.erro) {
                        alert('CEP não encontrado. Verifique e tente novamente.');
                        return;
                    }

                    // Preenche os campos automaticamente.
                    campoRua.value = endereco.logradouro || '';
                    campoBairro.value = endereco.bairro || '';
                    campoCidade.value = endereco.localidade || '';
                    campoEstado.value = endereco.uf || '';

                } catch (erro) {

                    if (consultaAtual !== ultimaConsulta) {
                        return;
                    }

                    console.error('Erro ao consultar CEP:', erro);

                    alert(
                        'Não foi possível consultar o CEP. ' +
                        'Preencha o endereço manualmente.'
                    );
                }

            });

        });
    </script>


</x-guest-layout>
