
<x-guest-layout>

    
{{-- Biblioteca de ícones Tabler --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    {{-- Cabeçalho --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-4 flex h-16 w-16
                    items-center justify-center
                    rounded-2xl bg-[#07311C] shadow-sm">

            <i class="ti ti-heart-handshake text-4xl text-[#BBF0B9]"></i>

        </div>

        <h1 class="text-3xl font-bold tracking-tight text-[#07311C]">
            Bem-vindo de volta!
        </h1>

        <p class="mt-2 text-sm text-[#52745C]">
            Entre na sua conta para continuar no Vitalle.
        </p>

    </div>

    {{-- Mensagens de sessão --}}
    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />

    {{-- Formulário --}}
    <form method="POST"
          action="{{ route('login') }}"
          class="space-y-5">

        @csrf

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
                    autofocus
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
                    autocomplete="current-password"
                    placeholder="Digite sua senha"
                    class="block w-full rounded-xl
                           border border-[#D9E2DA]
                           bg-[#F8F2EE] py-3 pl-12 pr-12
                           text-sm text-[#07311C]
                           placeholder:text-gray-400
                           focus:border-[#52745C]
                           focus:ring-[#52745C]"
                >

                {{-- Mostrar/ocultar senha --}}
                <button
                    type="button"
                    onclick="alternarSenha()"
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

        {{-- Lembrar e recuperar senha --}}
        <div class="flex flex-wrap items-center
                    justify-between gap-3">

            <label for="remember_me"
                   class="inline-flex cursor-pointer items-center gap-2">

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-[#D9E2DA]
                           text-[#52745C]
                           focus:ring-[#52745C]"
                >

                <span class="text-sm text-gray-600">
                    Lembrar de mim
                </span>

            </label>

            @if (Route::has('password.request'))

                <a href="{{ route('password.request') }}"
                   class="text-sm font-semibold text-[#52745C]
                          hover:text-[#07311C] hover:underline">

                    Esqueceu a senha?

                </a>

            @endif

        </div>

        {{-- Botão entrar --}}
        <button
            type="submit"
            class="flex w-full items-center justify-center gap-2
                   rounded-xl bg-[#07311C] px-6 py-3.5
                   text-sm font-semibold text-white
                   shadow-sm transition-all
                   hover:bg-[#52745C]
                   focus:outline-none focus:ring-2
                   focus:ring-[#52745C] focus:ring-offset-2">

            Entrar na minha conta

            <i class="ti ti-arrow-right text-lg"></i>

        </button>

        {{-- Link para registro --}}
        <div class="pt-4 text-center">

            <p class="text-sm text-gray-600">

                Ainda não possui uma conta?

                <a href="{{ route('register') }}"
                   class="font-semibold text-[#52745C]
                          hover:text-[#07311C] hover:underline">

                    Cadastre-se

                </a>

            </p>

        </div>

    </form>

    {{-- Script para visualizar senha --}}
    <script>
        function alternarSenha() {

            const campo = document.getElementById('password');
            const icone = document.getElementById('iconeSenha');

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
