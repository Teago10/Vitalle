
<x-guest-layout>

    {{-- Biblioteca de ícones Tabler --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    {{-- Cabeçalho --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-4 flex h-16 w-16
                    items-center justify-center
                    rounded-2xl bg-[#07311C] shadow-sm">

            <i class="ti ti-heart-handshake text-4xl text-[#BBF0B9]"></i>

        </div>

        <h1 class="text-3xl font-bold tracking-tight text-[#07311C]">
            Crie sua conta
        </h1>

        <p class="mt-2 text-sm text-[#52745C]">
            Faça parte do Vitalle e comece sua jornada de cuidado.
        </p>

    </div>

    {{-- Formulário --}}
    <form method="POST"
          action="{{ route('register') }}"
          class="space-y-5">

        @csrf

        {{-- Nome --}}
        <div>

            <label for="name"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Nome completo
            </label>

            <div class="relative">

                <i class="ti ti-user absolute left-4 top-1/2
                          -translate-y-1/2 text-xl text-[#52745C]"></i>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Digite seu nome completo"
                    class="block w-full rounded-xl
                           border border-[#D9E2DA]
                           bg-[#F8F2EE] py-3 pl-12 pr-4
                           text-sm text-[#07311C]
                           placeholder:text-gray-400
                           focus:border-[#52745C]
                           focus:ring-[#52745C]"
                >

            </div>

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />

        </div>

        {{-- E-mail --}}
        <div>

            <label for="email"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                E-mail
            </label>

            <div class="relative">

                <i class="ti ti-mail absolute left-4 top-1/2
                          -translate-y-1/2 text-xl text-[#52745C]"></i>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="Digite seu e-mail"
                    class="block w-full rounded-xl
                           border border-[#D9E2DA]
                           bg-[#F8F2EE] py-3 pl-12 pr-4
                           text-sm text-[#07311C]
                           placeholder:text-gray-400
                           focus:border-[#52745C]
                           focus:ring-[#52745C]"
                >

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        {{-- Senha --}}
        <div>

            <label for="password"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Senha
            </label>

            <div class="relative">

                <i class="ti ti-lock absolute left-4 top-1/2
                          -translate-y-1/2 text-xl text-[#52745C]"></i>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Crie uma senha"
                    class="block w-full rounded-xl
                           border border-[#D9E2DA]
                           bg-[#F8F2EE] py-3 pl-12 pr-12
                           text-sm text-[#07311C]
                           placeholder:text-gray-400
                           focus:border-[#52745C]
                           focus:ring-[#52745C]"
                >

                <button
                    type="button"
                    onclick="alternarSenha('password', 'iconeSenha')"
                    aria-label="Mostrar ou ocultar senha"
                    class="absolute right-4 top-1/2
                           -translate-y-1/2 text-[#52745C]
                           hover:text-[#07311C]">

                    <i id="iconeSenha" class="ti ti-eye text-xl"></i>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        {{-- Confirmar senha --}}
        <div>

            <label for="password_confirmation"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Confirmar senha
            </label>

            <div class="relative">

                <i class="ti ti-shield-lock absolute left-4 top-1/2
                          -translate-y-1/2 text-xl text-[#52745C]"></i>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Digite sua senha novamente"
                    class="block w-full rounded-xl
                           border border-[#D9E2DA]
                           bg-[#F8F2EE] py-3 pl-12 pr-12
                           text-sm text-[#07311C]
                           placeholder:text-gray-400
                           focus:border-[#52745C]
                           focus:ring-[#52745C]"
                >

                <button
                    type="button"
                    onclick="alternarSenha('password_confirmation', 'iconeConfirmarSenha')"
                    aria-label="Mostrar ou ocultar confirmação de senha"
                    class="absolute right-4 top-1/2
                           -translate-y-1/2 text-[#52745C]
                           hover:text-[#07311C]">

                    <i id="iconeConfirmarSenha" class="ti ti-eye text-xl"></i>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        {{-- Botão cadastrar --}}
        <div class="pt-2">

            <button
                type="submit"
                class="flex w-full items-center justify-center gap-2
                       rounded-xl bg-[#07311C] px-6 py-3.5
                       text-sm font-semibold text-white
                       shadow-sm transition-all
                       hover:bg-[#52745C]
                       focus:outline-none focus:ring-2
                       focus:ring-[#52745C] focus:ring-offset-2">

                Criar minha conta

                <i class="ti ti-arrow-right text-lg"></i>

            </button>

        </div>

        {{-- Link para login --}}
        <div class="pt-4 text-center">

            <p class="text-sm text-gray-600">

                Já possui uma conta?

                <a href="{{ route('login') }}"
                   class="font-semibold text-[#52745C]
                          hover:text-[#07311C] hover:underline">

                    Faça login

                </a>

            </p>

        </div>

    </form>

    {{-- Mostrar e ocultar senhas --}}
    <script>
        function alternarSenha(campoId, iconeId) {

            const campo = document.getElementById(campoId);
            const icone = document.getElementById(iconeId);

            if (campo.type === 'password') {

                campo.type = 'text';

                icone.classList.remove('ti-eye');
                icone.classList.add('ti-eye-off');

            } else {

                campo.type = 'password';

                icone.classList.remove('ti-eye-off');
                icone.classList.add('ti-eye');

            }

        }
    </script>

</x-guest-layout>
