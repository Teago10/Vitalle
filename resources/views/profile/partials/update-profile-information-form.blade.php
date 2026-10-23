
<section>

    {{-- Formulário de verificação de e-mail --}}
    <form id="send-verification"
          method="post"
          action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Atualizar informações pessoais --}}
    <form method="post"
          action="{{ route('profile.update') }}"
          class="space-y-6">

        @csrf
        @method('patch')

        {{-- Nome --}}
        <div>
            <label for="name"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Nome completo
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                       placeholder:text-gray-400
                       focus:border-[#52745C] focus:ring-[#52745C]"
                placeholder="Digite seu nome completo"
            >

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- E-mail --}}
        <div>
            <label for="email"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Endereço de e-mail
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                       placeholder:text-gray-400
                       focus:border-[#52745C] focus:ring-[#52745C]"
                placeholder="Digite seu e-mail"
            >

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- Verificação de e-mail --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-xl bg-amber-50 p-4">

                    <p class="text-sm text-amber-800">
                        Seu endereço de e-mail ainda não foi verificado.
                    </p>

                    <button
                        type="submit"
                        form="send-verification"
                        class="mt-2 text-sm font-semibold text-[#52745C]
                               underline hover:text-[#07311C]">
                        Reenviar e-mail de verificação
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-700">
                            Um novo link de verificação foi enviado.
                        </p>
                    @endif

                </div>

            @endif
        </div>

        {{-- Botão salvar --}}
        <div class="flex flex-wrap items-center gap-4 pt-2">

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-[#07311C] px-6 py-3
                       text-sm font-semibold text-white
                       transition-colors hover:bg-[#52745C]
                       focus:outline-none focus:ring-2
                       focus:ring-[#52745C] focus:ring-offset-2">

                <i class="ti ti-device-floppy text-lg"></i>

                Salvar alterações
            </button>

            {{-- Confirmação --}}
            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-[#52745C]">

                    <i class="ti ti-check"></i>
                    Informações atualizadas com sucesso!

                </p>

            @endif

        </div>

    </form>

</section>
