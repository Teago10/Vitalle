@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-10 p-10 rounded-2xl" style="background-color: #f0ede8;">

        <div class="w-full max-w-sm bg-white rounded-2xl shadow-md px-8 py-8">

            {{-- Header --}}
            <h1 class="text-xl font-bold text-center text-gray-800">
                Crie sua Conta
            </h1>
            <p class="text-center text-gray-400 text-sm mt-1">
                Preencha os dados abaixo para iniciar.
            </p>

            {{-- Toggle tipo de conta --}}
            <div class="grid grid-cols-2 gap-3 mt-6">

                {{-- Cuidador (ativo por padrão) --}}
                <button id="btnCuidador" type="button"
                    class="flex flex-col items-center justify-center gap-1.5 py-4 rounded-xl border-2 border-emerald-500 bg-emerald-50 text-emerald-700 font-semibold text-sm transition-all">
                    {{-- ícone médico/cuidador --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="7" r="3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.5 21a6.5 6.5 0 0 1 13 0" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v2m0 0v2m0-2h2m-2 0h-2" />
                    </svg>
                    Sou Cuidador
                </button>

                {{-- Responsável --}}
                <button id="btnResponsavel" type="button"
                    class="flex flex-col items-center justify-center gap-1.5 py-4 rounded-xl border-2 border-gray-200 bg-white text-gray-500 font-semibold text-sm transition-all">
                    {{-- ícone família --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <circle cx="9" cy="7" r="2.5" />
                        <circle cx="16" cy="6" r="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 21a5.5 5.5 0 0 1 11 0" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 10c2.5 0 4.5 1.8 4.5 4.5" />
                    </svg>
                    Sou Responsável
                </button>

            </div>

            <div id="avisoCuidador"
                class="mt-4 rounded-lg border border-yellow-300 bg-yellow-50 px-4 py-3 text-xs text-yellow-800">

                <strong>Atenção:</strong> Após o cadastro será necessário enviar a documentação comprobatória para atuar
                como cuidador.

            </div>

            {{-- Formulário --}}
            <form id="formCadastro" action="{{ route('cuidador.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf

                {{-- Nome --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nome Completo</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="8" r="3.5" />
                                <path stroke-linecap="round" d="M4 20a8 8 0 0 1 16 0" />
                            </svg>
                        </span>
                        <input type="text" name="nome" placeholder="Ex: João da Silva"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent placeholder-gray-300">
                    </div>
                </div>

                {{-- E-mail --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">E-mail</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" d="m3 7 9 6 9-6" />
                            </svg>
                        </span>
                        <input type="email" name="email" placeholder="seu.email@exemplo.com"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent placeholder-gray-300">
                    </div>
                </div>

                {{-- CPF e Telefone --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">CPF</label>

                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">
                                    <rect x="5" y="3" width="14" height="18" rx="2" />
                                    <path stroke-linecap="round" d="M9 8h6M9 12h6M9 16h4" />
                                </svg>
                            </span>
                            <input id="cpf" name="cpf" type="text" maxlength="14" placeholder="000.000.000-00"
                                class="w-full pl-9 pr-2 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent placeholder-gray-300">
                        </div>
                        <x-input-error :messages="$errors->get('cpf')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Telefone</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.6 10.8c1 2 2.6 3.6 4.6 4.6l1.5-1.5a1 1 0 0 1 1-.2c1.1.4 2.3.6 3.5.6a1 1 0 0 1 1 1V18a1 1 0 0 1-1 1C9.6 19 5 14.4 5 8.8a1 1 0 0 1 1-1h2.8a1 1 0 0 1 1 1c0 1.2.2 2.4.6 3.5a1 1 0 0 1-.2 1L6.6 10.8z" />
                                </svg>
                            </span>
                            <input id="telefone" name="telefone" type="text" maxlength="15"
                                placeholder="(00) 00000-0000"
                                class="w-full pl-9 pr-2 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent placeholder-gray-300">
                        </div>
                        <x-input-error :messages="$errors->get('telefone')" class="mt-1" />
                    </div>
                </div>

                {{-- Senha --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Senha</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="5" y="11" width="14" height="10" rx="2" />
                                <path stroke-linecap="round" d="M8 11V7a4 4 0 0 1 8 0v4" />
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent placeholder-gray-300">

                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">

                            <span id="eyeOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639
                C3.423 7.51 7.36 4.5 12 4.5
                c4.638 0 8.573 3.007 9.963 7.178
                .07.207.07.431 0 .639
                C20.577 16.49 16.64 19.5 12 19.5
                c-4.638 0-8.573-3.007-9.964-7.178Z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0
                3 3 0 016 0Z" />

                                </svg>
                            </span>
                                <span id="eyeClosed" class="hidden">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.477 10.489A3 3 0 0013.5 13.5" />

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A9.953 9.953 0 0112 4.5

    c4.638 0 8.573 3.007 9.963 7.178

    .07.207.07.431 0 .639

    a10.017 10.017 0 01-4.132 5.411" />

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.228 6.228A9.956 9.956 0 002.036 11.68

    c1.39 4.171 5.326 7.178 9.964 7.178

    a9.953 9.953 0 005.772-1.772" />

                                    </svg>

                                </span>

                        </button>
                    </div>
                </div>

                {{-- Checkbox termos --}}
                <div class="flex items-start gap-2 pt-1">
                    <input type="checkbox" name="termos" id="termos"
                        class="mt-0.5 w-4 h-4 rounded border-gray-300 text-emerald-500 focus:ring-emerald-400 cursor-pointer">
                    <label for="termos" class="text-xs text-gray-500 leading-snug cursor-pointer">
                        Eu concordo com os
                        <a href="#" class="text-emerald-600 font-semibold hover:underline">Termos de Uso</a>
                        e
                        <a href="#" class="text-emerald-600 font-semibold hover:underline">Política de
                            Privacidade</a>.
                    </label>
                </div>

                {{-- Botão --}}
                <button type="submit"
                    class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors mt-1">
                    Criar Conta
                </button>

            </form>

            {{-- Link login --}}
            <p class="text-center text-xs text-gray-500 mt-5">
                Já tem uma conta?
                <a href="#" class="text-emerald-700 font-bold hover:underline">Entre aqui</a>
            </p>

        </div>
    </div>

    <script>
        const btnCuidador = document.getElementById("btnCuidador");
        const btnResponsavel = document.getElementById("btnResponsavel");
        const form = document.getElementById("formCadastro");

        function setAtivo(ativo, inativo) {
            ativo.classList.add("border-emerald-500", "bg-emerald-50", "text-emerald-700");
            ativo.classList.remove("border-gray-200", "bg-white", "text-gray-500");
            inativo.classList.add("border-gray-200", "bg-white", "text-gray-500");
            inativo.classList.remove("border-emerald-500", "bg-emerald-50", "text-emerald-700");
        }

        btnCuidador.onclick = function() {
            form.action = "{{ route('cuidador.store') }}";
            setAtivo(btnCuidador, btnResponsavel);
        };

        btnResponsavel.onclick = function() {
            form.action = "{{ route('responsavel.store') }}";
            setAtivo(btnResponsavel, btnCuidador);
        };
    </script>
@endsection
