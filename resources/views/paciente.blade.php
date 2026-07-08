<x-sistema>

    <div class="max-w-6xl mx-auto">

        

    <x-page-header
    title="Pacientes"
    subtitle="Gerencie todos os pacientes cadastrados."
>

    <a href="#"
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
                    <th class="p-4 text-left">CPF</th>
                    <th class="p-4 text-left">Telefone</th>
                    <th class="p-4 text-left">Responsável</th>
                    <th class="p-4 text-center">Ações</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t hover:bg-gray-50">

                    <td class="p-4">João da Silva</td>
                    <td class="p-4">123.456.789-00</td>
                    <td class="p-4">(14) 99999-9999</td>
                    <td class="p-4">Maria da Silva</td>

                    <td class="p-4 text-center">

                        <button class="text-blue-700 hover:text-blue-800">
                            <i class="ti ti-edit"></i> Editar
                        </button>

                        <button class="text-red-700 hover:text-red-800 ml-4">
                            <i class="ti ti-trash"></i> Excluir
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</x-sistema>