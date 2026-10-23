
<section class="space-y-5">

    <div class="rounded-xl border border-red-100 bg-red-50 p-4">

        <div class="flex items-start gap-3">

            <i class="ti ti-alert-triangle text-xl text-red-600"></i>

            <p class="text-sm leading-relaxed text-red-800">
                Atenção: ao excluir sua conta, seus dados serão
                removidos permanentemente. Essa ação não poderá
                ser desfeita.
            </p>

        </div>

    </div>

    {{-- Botão de exclusão --}}
    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 rounded-xl
               bg-red-600 px-6 py-3 text-sm font-semibold
               text-white transition-colors hover:bg-red-700">

        <i class="ti ti-trash text-lg"></i>

        Excluir minha conta
    </button>

    {{-- Modal de confirmação do Breeze --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-6 sm:p-8">

            @csrf
            @method('delete')

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-red-50">

                    <i class="ti ti-alert-circle text-2xl text-red-600"></i>

                </div>

                <h2 class="text-xl font-bold text-[#07311C]">
                    Confirmar exclusão
                </h2>

            </div>

            <p class="text-sm leading-relaxed text-gray-600">
                Tem certeza de que deseja excluir sua conta?
                Essa ação é permanente. Digite sua senha
                para confirmar a exclusão.
            </p>

            {{-- Confirmação da senha --}}
            <div class="mt-6">

                <label for="password"
                       class="mb-2 block text-sm font-semibold text-[#07311C]">
                    Senha atual
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full rounded-xl border border-[#D9E2DA]
                           bg-[#F8F2EE] px-4 py-3 text-[#07311C]
                           focus:border-[#52745C] focus:ring-[#52745C]"
                    placeholder="Digite sua senha para confirmar"
                >

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            {{-- Botões --}}
            <div class="mt-7 flex flex-wrap justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-xl border border-gray-200
                           bg-white px-5 py-3 text-sm font-semibold
                           text-gray-700 transition-colors hover:bg-gray-100">

                    Cancelar
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           rounded-xl bg-red-600 px-5 py-3
                           text-sm font-semibold text-white
                           transition-colors hover:bg-red-700">

                    <i class="ti ti-trash text-lg"></i>

                    Excluir conta
                </button>

            </div>

        </form>

    </x-modal>

</section>
