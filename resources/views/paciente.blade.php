<x-sistema>

    <div class="max-w-6xl mx-auto">



        <x-page-header title="Pacientes" subtitle="Gerencie todos os pacientes cadastrados.">

            <a href="{{ route('profile.paciente.cadastrar') }}"
                class="bg-[#5FA83D] hover:bg-[#4b8b2f] text-white px-5 py-3 rounded-lg flex items-center gap-2">

                <i class="ti ti-plus"></i>

                Novo Paciente

            </a>

        </x-page-header>

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">Nome</th>
                        <th class="p-4 text-left">Data Nascimento</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Responsável</th>
                        <th class="p-4 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($paciente as $p)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-4">{{ $p->nome }}</td>

                            <td class="p-4">
                                {{ \Carbon\Carbon::parse($p->data_nascimento)->format('d/m/Y') }}
                            </td>

                            <td class="p-4">
                                {{ $p->email }}
                            </td>

                            <td class="p-4">
                                {{ $p->responsavel->nome ?? '-' }}
                            </td>

                            <td class="p-4 text-center">

                                <button class="text-blue-700 hover:text-blue-800">
                                    <i class="ti ti-edit"></i> Editar
                                </button>

                                <button class="text-red-700 hover:text-red-800 ml-4">
                                    <i class="ti ti-trash"></i> Excluir
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-slate-400 px-5 py-3.5">
                                <p>Nenhum paciente cadastrado</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-sistema>
