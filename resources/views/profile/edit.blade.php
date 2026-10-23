
<x-sistema>

    <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6">

        {{-- Cabeçalho da página --}}
        <div class="mb-8">

            <div class="flex items-center gap-4">

                {{-- Ícone --}}
                <div class="flex h-14 w-14 items-center justify-center
                            rounded-2xl bg-[#52745C]/10">

                    <i class="ti ti-user-cog text-3xl text-[#52745C]"></i>

                </div>

                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-[#07311C]">
                        Meu Perfil
                    </h1>

                    <p class="mt-1 text-sm text-[#52745C]">
                        Gerencie suas informações pessoais e a segurança da sua conta.
                    </p>
                </div>

            </div>

        </div>

        {{-- Conteúdo --}}
        <div class="space-y-6">

            {{-- Informações pessoais --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-user-edit text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Informações pessoais
                        </h2>

                        <p class="text-sm text-gray-500">
                            Atualize seu nome e endereço de e-mail.
                        </p>
                    </div>

                </div>

                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </section>

            {{-- Segurança --}}
            <section class="rounded-2xl border border-[#52745C]/10
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-gray-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-[#F0EEE7]">

                        <i class="ti ti-lock text-2xl text-[#52745C]"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Segurança da conta
                        </h2>

                        <p class="text-sm text-gray-500">
                            Altere sua senha para manter sua conta protegida.
                        </p>
                    </div>

                </div>

                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>

            </section>

            {{-- Exclusão da conta --}}
            <section class="rounded-2xl border border-red-200
                            bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex items-center gap-3
                            border-b border-red-100 pb-5">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-red-50">

                        <i class="ti ti-trash text-2xl text-red-600"></i>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-[#07311C]">
                            Excluir conta
                        </h2>

                        <p class="text-sm text-gray-500">
                            Gerencie a exclusão permanente da sua conta.
                        </p>
                    </div>

                </div>

                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>

        </div>

    </div>

</x-sistema>
