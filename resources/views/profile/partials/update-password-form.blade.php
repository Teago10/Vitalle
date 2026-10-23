
<section>

    <form method="post"
          action="{{ route('password.update') }}"
          class="space-y-6">

        @csrf
        @method('put')

        {{-- Senha atual --}}
        <div>
            <label for="update_password_current_password"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Senha atual
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                       focus:border-[#52745C] focus:ring-[#52745C]"
                placeholder="Digite sua senha atual"
            >

            <x-input-error
                class="mt-2"
                :messages="$errors->updatePassword->get('current_password')"
            />
        </div>

        {{-- Nova senha --}}
        <div>
            <label for="update_password_password"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Nova senha
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                       focus:border-[#52745C] focus:ring-[#52745C]"
                placeholder="Digite sua nova senha"
            >

            <x-input-error
                class="mt-2"
                :messages="$errors->updatePassword->get('password')"
            />
        </div>

        {{-- Confirmar senha --}}
        <div>
            <label for="update_password_password_confirmation"
                   class="mb-2 block text-sm font-semibold text-[#07311C]">
                Confirmar nova senha
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="block w-full rounded-xl border border-[#D9E2DA]
                       bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                       focus:border-[#52745C] focus:ring-[#52745C]"
                placeholder="Digite novamente sua nova senha"
            >

            <x-input-error
                class="mt-2"
                :messages="$errors->updatePassword->get('password_confirmation')"
            />
        </div>

        {{-- Salvar senha --}}
        <div class="flex flex-wrap items-center gap-4 pt-2">

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-[#07311C] px-6 py-3
                       text-sm font-semibold text-white
                       transition-colors hover:bg-[#52745C]
                       focus:outline-none focus:ring-2
                       focus:ring-[#52745C] focus:ring-offset-2">

                <i class="ti ti-lock-check text-lg"></i>

                Atualizar senha
            </button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-[#52745C]">

                    <i class="ti ti-check"></i>
                    Senha atualizada com sucesso!

                </p>

            @endif

        </div>

    </form>

</section>
