
<x-sistema>

    <div class="mx-auto max-w-6xl">

        {{-- Cabeçalho --}}
        <x-page-header
            title="Pacientes"
            subtitle="Gerencie os pacientes cadastrados no Vitalle.">

            <a href="{{ route('profile.paciente.cadastrar') }}"
               class="inline-flex items-center gap-2 rounded-xl
                      bg-[#07311C] px-5 py-3 text-sm font-semibold
                      text-white transition-colors hover:bg-[#52745C]">

                <i class="ti ti-plus text-lg"></i>

                Novo Paciente

            </a>

        </x-page-header>

        {{-- Mensagem de sucesso --}}
        @if (session('success'))

            <div class="mb-6 flex items-center gap-3
                        rounded-xl border border-green-200
                        bg-green-50 px-5 py-4 text-sm text-green-800">

                <i class="ti ti-circle-check text-xl"></i>

                {{ session('success') }}

            </div>

        @endif

        {{-- Card principal --}}
        <div class="overflow-hidden rounded-2xl
                    border border-[#52745C]/10 bg-white shadow-sm">

            {{-- Cabeçalho da listagem --}}
            <div class="flex flex-wrap items-center justify-between
                        gap-3 border-b border-gray-100 px-6 py-5">

                <div>
                    <h2 class="text-lg font-semibold text-[#07311C]">
                        Pacientes cadastrados
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $paciente->count() }}
                        {{ $paciente->count() === 1 ? 'paciente cadastrado' : 'pacientes cadastrados' }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-[#F0EEE7]">

                    <i class="ti ti-users text-2xl text-[#52745C]"></i>

                </div>

            </div>

            {{-- Listagem --}}
            <div class="divide-y divide-gray-100">

                @forelse ($paciente as $p)

                    <div x-data="{ aberto: false }"
                         class="transition-colors hover:bg-[#F8F2EE]/50">

                        {{-- Linha principal --}}
                        <div class="flex flex-wrap items-center
                                    justify-between gap-4 px-6 py-5">

                            {{-- Identificação --}}
                            <div class="flex min-w-0 flex-1 items-center gap-4">

                                <div class="flex h-12 w-12 shrink-0
                                            items-center justify-center
                                            rounded-xl bg-[#52745C]/10">

                                    <i class="ti ti-user text-2xl text-[#52745C]"></i>

                                </div>

                                <div class="min-w-0">

                                    <h3 class="truncate text-sm font-semibold
                                               text-[#07311C]">
                                        {{ $p->nome }}
                                    </h3>

                                    <p class="mt-1 truncate text-xs text-gray-500">
                                        Responsável:
                                        {{ $p->responsavel->nome ?? 'Não informado' }}
                                    </p>

                                </div>

                            </div>

                            {{-- Ações --}}
                            <div class="flex flex-wrap items-center gap-3">

                                {{-- Expandir detalhes --}}
                                <button
                                    type="button"
                                    @click="aberto = !aberto"
                                    :aria-expanded="aberto.toString()"
                                    class="inline-flex items-center gap-2
                                           rounded-lg px-3 py-2 text-sm
                                           font-medium text-[#52745C]
                                           transition-colors hover:bg-[#52745C]/10">

                                    <span x-text="aberto ? 'Ocultar detalhes' : 'Ver detalhes'">
                                        Ver detalhes
                                    </span>

                                    <i class="ti ti-chevron-down text-lg
                                              transition-transform duration-200"
                                       :class="{ 'rotate-180': aberto }"></i>

                                </button>

                                {{-- Editar --}}
                                <a href="{{ route('profile.paciente.editar', $p->id) }}"
                                   title="Editar paciente"
                                   aria-label="Editar paciente"
                                   class="flex h-10 w-10 items-center
                                          justify-center rounded-lg
                                          bg-[#52745C]/10 text-[#52745C]
                                          transition-colors hover:bg-[#52745C]/20">

                                    <i class="ti ti-edit text-xl"></i>

                                </a>

                                {{-- Excluir --}}
                                <form
                                    action="{{ route('profile.paciente.excluir', $p->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir este paciente?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Excluir paciente"
                                        aria-label="Excluir paciente"
                                        class="flex h-10 w-10 items-center
                                               justify-center rounded-lg
                                               bg-red-50 text-red-600
                                               transition-colors hover:bg-red-100">

                                        <i class="ti ti-trash text-xl"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                        {{-- Detalhes expansíveis --}}
                        <div x-show="aberto"
                             x-cloak
                             x-transition
                             class="border-t border-[#52745C]/10
                                    bg-[#F8F2EE] px-6 py-5">

                            <div class="grid grid-cols-1 gap-5
                                        sm:grid-cols-2 lg:grid-cols-3">

                                {{-- Nome --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Nome completo
                                    </p>

                                    <p class="break-words text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->nome }}
                                    </p>
                                </div>

                                {{-- Data de nascimento --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Data de nascimento
                                    </p>

                                    <p class="text-sm font-semibold text-[#07311C]">
                                        {{ $p->data_nascimento
                                            ? \Carbon\Carbon::parse($p->data_nascimento)->format('d/m/Y')
                                            : 'Não informada' }}
                                    </p>
                                </div>

                                {{-- E-mail --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        E-mail
                                    </p>

                                    <p class="break-all text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->email ?: 'Não informado' }}
                                    </p>
                                </div>

                                {{-- Responsável --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Responsável
                                    </p>

                                    <p class="break-words text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->responsavel->nome ?? 'Não informado' }}
                                    </p>
                                </div>

                                {{-- Comorbidade --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Comorbidades
                                    </p>

                                    <p class="break-words text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->comorbidade ?: 'Não informadas' }}
                                    </p>
                                </div>

                                {{-- Condição física --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Condição física
                                    </p>

                                    <p class="break-words text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->condicao_fisica ?: 'Não informada' }}
                                    </p>
                                </div>

                                {{-- Uso de fraldas --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Uso de fraldas
                                    </p>

                                    <p class="text-sm font-semibold text-[#07311C]">
                                        {{ $p->usa_fraldas ? 'Sim' : 'Não' }}
                                    </p>
                                </div>

                                {{-- Medicação --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Medicação
                                    </p>

                                    <p class="break-words text-sm font-semibold
                                              text-[#07311C]">
                                        {{ $p->medicacao ?: 'Não informada' }}
                                    </p>
                                </div>

                                {{-- Horário da medicação --}}
                                <div>
                                    <p class="mb-1 text-xs font-medium
                                              text-gray-500">
                                        Horário da medicação
                                    </p>

                                    <p class="text-sm font-semibold text-[#07311C]">
                                        {{ $p->horario_medicacao
                                            ? substr($p->horario_medicacao, 0, 5)
                                            : 'Não informado' }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- Nenhum paciente --}}
                    <div class="flex flex-col items-center
                                justify-center px-6 py-16 text-center">

                        <div class="mb-4 flex h-16 w-16 items-center
                                    justify-center rounded-2xl bg-[#F0EEE7]">

                            <i class="ti ti-users text-3xl text-[#52745C]"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-[#07311C]">
                            Nenhum paciente cadastrado
                        </h3>

                        <p class="mt-2 max-w-sm text-sm text-gray-500">
                            Cadastre seu primeiro paciente para começar
                            a organizar os atendimentos no Vitalle.
                        </p>

                        <a href="{{ route('profile.paciente.cadastrar') }}"
                           class="mt-5 inline-flex items-center gap-2
                                  rounded-xl bg-[#07311C] px-5 py-3
                                  text-sm font-semibold text-white
                                  transition-colors hover:bg-[#52745C]">

                            <i class="ti ti-plus text-lg"></i>

                            Cadastrar paciente

                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-sistema>
