<x-sistema>
    <x-page-header title="Central de Suporte" subtitle="Estamos aqui para ajudar você." />

    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                Como podemos ajudar?
            </h2>

            <p class="text-gray-500 mb-6">
                Envie sua dúvida ou relate um problema para nossa equipe.
            </p>

            @if (session('sucesso'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('suporte.armazenar') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">
                        Nome completo
                    </label>

                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
                        maxlength="150"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                        placeholder="Digite seu nome completo">

                    @error('nome')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="assunto" class="block text-sm font-medium text-gray-700 mb-1">
                        Assunto
                    </label>

                    <input type="text" name="assunto" id="assunto" value="{{ old('assunto') }}" required
                        maxlength="200"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                        placeholder="Ex.: Problema no cadastro">

                    @error('assunto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mensagem" class="block text-sm font-medium text-gray-700 mb-1">
                        Descrição
                    </label>

                    <textarea name="mensagem" id="mensagem" rows="5" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#5FA83D] focus:ring-[#5FA83D]"
                        placeholder="Descreva sua dúvida ou problema...">{{ old('mensagem') }}</textarea>

                    @error('mensagem')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="rounded-lg bg-[#5FA83D] px-6 py-3 font-medium text-white transition hover:bg-[#4b8b2f]">
                    Enviar solicitação
                </button>
            </form>
        </div>
    </div>


    <div class="px-6 pb-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-2 text-xl font-semibold text-gray-800">
                Perguntas frequentes
            </h2>

            <p class="mb-6 text-gray-500">
                Confira algumas respostas para as dúvidas mais comuns.
            </p>

            <div class="divide-y divide-gray-200">

                <details class="py-4">
                    <summary class="cursor-pointer font-medium text-gray-700 hover:text-[#5FA83D]">
                        Como posso entrar em contato com o suporte?
                    </summary>

                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Você pode enviar uma solicitação pelo formulário acima,
                        informando seu nome, o assunto e uma descrição detalhada
                        da sua dúvida ou problema.
                    </p>
                </details>

                <details class="py-4">
                    <summary class="cursor-pointer font-medium text-gray-700 hover:text-[#5FA83D]">
                        Como faço para acompanhar minha solicitação?
                    </summary>

                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        As solicitações são registradas no sistema. A consulta
                        de histórico e o acompanhamento de status poderão ser
                        disponibilizados em uma próxima etapa.
                    </p>
                </details>

                <details class="py-4">
                    <summary class="cursor-pointer font-medium text-gray-700 hover:text-[#5FA83D]">
                        Quanto tempo demora para receber uma resposta?
                    </summary>

                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        O prazo de resposta dependerá da organização da equipe
                        de suporte. Se necessário, informe a urgência no campo
                        de descrição da solicitação.
                    </p>
                </details>

                <details class="py-4">
                    <summary class="cursor-pointer font-medium text-gray-700 hover:text-[#5FA83D]">
                        Quais informações devo colocar na descrição?
                    </summary>

                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Explique o que aconteceu, em qual parte do Vitalle
                        ocorreu o problema e quais passos você realizou antes
                        de encontrar a dificuldade.
                    </p>
                </details>

            </div>
        </div>
    </div>


    <div class="px-6 pt-6 pb-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-2 text-xl font-semibold text-gray-800">
                Minhas solicitações
            </h2>

            <p class="mb-6 text-gray-500">
                Confira as solicitações registradas na Central de Suporte.
            </p>

            @if ($solicitacoes->isEmpty())
                <p class="py-6 text-center text-gray-500">
                    Nenhuma solicitação registrada até o momento.
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-500">
                                <th class="px-4 py-3 font-medium">Assunto</th>
                                <th class="px-4 py-3 font-medium">Data</th>
                                <th class="px-4 py-3 font-medium">Status</th>
                                <th class="px-4 py-3 font-medium">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($solicitacoes as $solicitacao)
                                <tr>
                                    <td class="px-4 py-4 font-medium text-gray-800">
                                        {{ $solicitacao->assunto }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-600">
                                        {{ $solicitacao->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">
                                            {{ $solicitacao->status }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <button type="button" id="botao-detalhes-suporte-{{ $solicitacao->id }}"
                                            onclick="mostrarDetalhesSuporte({{ $solicitacao->id }})"
                                            class="font-medium text-[#5FA83D] hover:text-[#4b8b2f]">
                                            Ver detalhes
                                        </button>
                                    </td>

                                </tr>

                                <tr id="detalhes-suporte-{{ $solicitacao->id }}" class="hidden bg-gray-50">
                                    <td colspan="4" class="px-6 py-5">
                                        <div class="space-y-3">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-700">Nome completo</p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $solicitacao->nome }}
                                                </p>
                                            </div>

                                            <div>
                                                <p class="text-sm font-semibold text-gray-700">Descrição</p>
                                                <p class="whitespace-pre-line text-sm text-gray-600">
                                                    {{ $solicitacao->mensagem }}
                                                </p>
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                Enviada em:
                                                {{ $solicitacao->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @endif

        </div>
    </div>


    <script>
    function mostrarDetalhesSuporte(id) {
        const detalhes = document.getElementById('detalhes-suporte-' + id);
        const botao = document.getElementById('botao-detalhes-suporte-' + id);

        if (detalhes && botao) {
            detalhes.classList.toggle('hidden');

            if (detalhes.classList.contains('hidden')) {
                botao.textContent = 'Ver detalhes';
            } else {
                botao.textContent = 'Ocultar detalhes';
            }
        }
    }
</script>

</x-sistema>
