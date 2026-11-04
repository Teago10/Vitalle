
<x-sistema>
    <x-page-header
        title="Central de Suporte"
        subtitle="Estamos aqui para ajudar você."
    />

    <div class="min-h-screen bg-[#FCF7F4] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-8">

            {{-- Apresentação --}}
            <section class="relative overflow-hidden rounded-3xl bg-[#07311C] p-6 text-white shadow-sm sm:p-9">
                <div class="absolute -right-10 -top-16 h-56 w-56 rounded-full bg-[#52745C]/40"></div>
                <div class="absolute -bottom-20 right-32 h-40 w-40 rounded-full bg-[#52745C]/30"></div>

                <div class="relative flex flex-col justify-between gap-6 md:flex-row md:items-center">
                    <div class="max-w-2xl">
                        <span class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold tracking-wide text-[#BBF0B9]">
                            <span class="h-2 w-2 rounded-full bg-[#BBF0B9]"></span>
                            CENTRAL DE ATENDIMENTO
                        </span>

                        <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">
                            Como podemos ajudar?
                        </h2>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-white/75 sm:text-base">
                            Estamos aqui para ajudar você a aproveitar melhor o Vitalle.
                            Envie sua dúvida ou conte para nós se encontrou algum problema.
                        </p>
                    </div>

                    <div class="hidden h-24 w-24 shrink-0 items-center justify-center rounded-3xl border border-white/15 bg-white/10 md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#BBF0B9]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5m-8 6 3.5-3H17a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v11a3 3 0 0 0 1 2.3Z"/>
                        </svg>
                    </div>
                </div>
            </section>

            {{-- Mensagem de sucesso --}}
            @if (session('sucesso'))
                <div class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                    </svg>
                    <p class="text-sm font-medium">{{ session('sucesso') }}</p>
                </div>
            @endif

            {{-- Formulário e orientações --}}
            <section class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">

                {{-- Formulário --}}
                <div class="rounded-3xl border border-[#E8DED8] bg-white p-5 shadow-sm sm:p-7 lg:col-span-2">
                    <div class="mb-7 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#EAF1EB] text-[#52745C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-[#07311C] sm:text-xl">
                                Envie sua solicitação
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Preencha os campos abaixo para entrar em contato com nossa equipe.
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('suporte.armazenar') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="nome" class="mb-2 block text-sm font-semibold text-gray-700">
                                Nome completo
                            </label>

                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                value="{{ old('nome') }}"
                                required
                                maxlength="150"
                                autocomplete="name"
                                placeholder="Digite seu nome completo"
                                class="w-full rounded-xl border border-[#E8DED8] bg-[#FCF7F4]/50 px-4 py-3 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#52745C] focus:bg-white focus:ring-4 focus:ring-[#52745C]/10 @error('nome') border-red-400 @enderror"
                            >

                            @error('nome')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="assunto" class="mb-2 block text-sm font-semibold text-gray-700">
                                Assunto
                            </label>

                            <input
                                type="text"
                                name="assunto"
                                id="assunto"
                                value="{{ old('assunto') }}"
                                required
                                maxlength="200"
                                placeholder="Ex.: Problema no cadastro"
                                class="w-full rounded-xl border border-[#E8DED8] bg-[#FCF7F4]/50 px-4 py-3 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#52745C] focus:bg-white focus:ring-4 focus:ring-[#52745C]/10 @error('assunto') border-red-400 @enderror"
                            >

                            @error('assunto')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mensagem" class="mb-2 block text-sm font-semibold text-gray-700">
                                Descrição da solicitação
                            </label>

                            <textarea
                                name="mensagem"
                                id="mensagem"
                                rows="5"
                                required
                                placeholder="Conte o que aconteceu, em qual parte do Vitalle e quais dificuldades encontrou..."
                                class="w-full resize-y rounded-xl border border-[#E8DED8] bg-[#FCF7F4]/50 px-4 py-3 text-sm leading-6 text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#52745C] focus:bg-white focus:ring-4 focus:ring-[#52745C]/10 @error('mensagem') border-red-400 @enderror"
                            >{{ old('mensagem') }}</textarea>

                            @error('mensagem')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs leading-5 text-gray-400">
                                Quanto mais detalhes você fornecer, mais fácil será compreender sua solicitação.
                            </p>
                        </div>

                        <div class="flex flex-col gap-3 border-t border-[#E8DED8] pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs text-gray-500">
                                Confira os dados antes de enviar.
                            </p>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#52745C] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3F624A] focus:outline-none focus:ring-4 focus:ring-[#52745C]/20"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m22 2-7 20-4-9-9-4Z M22 2 11 13"/>
                                </svg>
                                Enviar solicitação
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Orientações laterais --}}
                <aside class="space-y-4">
                    <div class="rounded-3xl border border-[#E8DED8] bg-white p-6 shadow-sm">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#EAF1EB] text-[#52745C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01"/>
                            </svg>
                        </div>

                        <h3 class="font-bold text-[#07311C]">Como podemos ajudar?</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Use este espaço para relatar dificuldades, esclarecer dúvidas ou informar problemas encontrados durante o uso do Vitalle.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-[#E8DED8] bg-white p-6 shadow-sm">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#F8F2EE] text-[#52745C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </div>

                        <h3 class="font-bold text-[#07311C]">Descreva com clareza</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Informe em qual tela ocorreu o problema e quais passos você realizou antes de encontrá-lo.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-[#DCE7DD] bg-[#EAF1EB]/70 p-5">
                        <p class="text-sm font-semibold text-[#07311C]">
                            Dica para sua solicitação
                        </p>
                        <p class="mt-2 text-sm leading-6 text-[#52745C]">
                            Se o problema impedir uma tarefa importante, explique isso na descrição para ajudar a equipe a entender a situação.
                        </p>
                    </div>
                </aside>
            </section>

            {{-- Perguntas frequentes --}}
            <section class="rounded-3xl border border-[#E8DED8] bg-white p-5 shadow-sm sm:p-7">
                <div class="mb-6 flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#EAF1EB] text-[#52745C]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 9a2.5 2.5 0 1 1 4.2 1.8c-1.1 1-1.7 1.2-1.7 2.7m0 3h.01"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-[#07311C] sm:text-xl">
                            Perguntas frequentes
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Encontre orientações para as dúvidas mais comuns.
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-[#E8DED8]">
                    <details class="group py-4">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-gray-700 transition hover:text-[#52745C] [&::-webkit-details-marker]:hidden">
                            <span>Como posso entrar em contato com o suporte?</span>
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#F8F2EE] text-[#52745C] transition group-open:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </summary>
                        <p class="mt-3 max-w-3xl text-sm leading-6 text-gray-500">
                            Envie uma solicitação pelo formulário acima, informando seu nome, o assunto e uma descrição detalhada da sua dúvida ou problema.
                        </p>
                    </details>

                    <details class="group py-4">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-gray-700 transition hover:text-[#52745C] [&::-webkit-details-marker]:hidden">
                            <span>Como faço para acompanhar minha solicitação?</span>
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#F8F2EE] text-[#52745C] transition group-open:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </summary>
                        <p class="mt-3 max-w-3xl text-sm leading-6 text-gray-500">
                            Consulte a seção “Minhas solicitações” nesta página para visualizar os registros disponíveis e conferir seus detalhes.
                        </p>
                    </details>

                    <details class="group py-4">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-gray-700 transition hover:text-[#52745C] [&::-webkit-details-marker]:hidden">
                            <span>Quanto tempo demora para receber uma resposta?</span>
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#F8F2EE] text-[#52745C] transition group-open:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </summary>
                        <p class="mt-3 max-w-3xl text-sm leading-6 text-gray-500">
                            O prazo depende da organização da equipe de suporte. Se sua solicitação for urgente, explique a situação na descrição.
                        </p>
                    </details>

                    <details class="group py-4">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-gray-700 transition hover:text-[#52745C] [&::-webkit-details-marker]:hidden">
                            <span>Quais informações devo colocar na descrição?</span>
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#F8F2EE] text-[#52745C] transition group-open:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                                </svg>
                            </span>
                        </summary>
                        <p class="mt-3 max-w-3xl text-sm leading-6 text-gray-500">
                            Explique o que aconteceu, em qual parte do Vitalle ocorreu o problema e quais passos você realizou antes de encontrar a dificuldade.
                        </p>
                    </details>
                </div>
            </section>

            {{-- Minhas solicitações --}}
            <section class="overflow-hidden rounded-3xl border border-[#E8DED8] bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-[#E8DED8] p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#EAF1EB] text-[#52745C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-[#07311C] sm:text-xl">
                                Minhas solicitações
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Consulte os registros enviados pela Central de Suporte.
                            </p>
                        </div>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full bg-[#EAF1EB] px-3 py-1.5 text-xs font-semibold text-[#3F624A]">
                        {{ $solicitacoes->count() }} {{ $solicitacoes->count() === 1 ? 'solicitação' : 'solicitações' }}
                    </span>
                </div>

                @if ($solicitacoes->isEmpty())
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F8F2EE] text-[#52745C]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>
                        <h4 class="mt-4 font-semibold text-[#07311C]">
                            Nenhuma solicitação por aqui
                        </h4>
                        <p class="mt-2 text-sm text-gray-500">
                            Quando você enviar uma solicitação, ela aparecerá nesta seção.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[650px] text-left text-sm">
                            <thead class="bg-[#FCF7F4] text-xs uppercase tracking-wide text-gray-500">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">Assunto</th>
                                    <th class="px-6 py-4 font-semibold">Data de envio</th>
                                    <th class="px-6 py-4 font-semibold">Status</th>
                                    <th class="px-6 py-4 text-right font-semibold">Detalhes</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#E8DED8]">
                                @foreach ($solicitacoes as $solicitacao)
                                    @php
                                        $statusSuporte = mb_strtolower(trim((string) $solicitacao->status));

                                        $classeStatus = match ($statusSuporte) {
                                            'concluído', 'concluido', 'resolvido', 'resolvida' => 'bg-green-50 text-green-700 ring-green-600/20',
                                            'em andamento', 'em_andamento', 'em análise', 'em analise' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                                            'cancelado', 'cancelada' => 'bg-red-50 text-red-700 ring-red-600/20',
                                            default => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                        };
                                    @endphp

                                    <tr class="transition hover:bg-[#FCF7F4]/70">
                                        <td class="px-6 py-5">
                                            <div class="font-semibold text-gray-800">
                                                {{ $solicitacao->assunto }}
                                            </div>
                                            <div class="mt-1 text-xs text-gray-400">
                                                Protocolo #{{ $solicitacao->id }}
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-5 text-gray-600">
                                            {{ $solicitacao->created_at->format('d/m/Y') }}
                                            <span class="mt-1 block text-xs text-gray-400">
                                                {{ $solicitacao->created_at->format('H:i') }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset {{ $classeStatus }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                                {{ $solicitacao->status }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5 text-right">
                                            <button
                                                type="button"
                                                id="botao-detalhes-suporte-{{ $solicitacao->id }}"
                                                aria-expanded="false"
                                                aria-controls="detalhes-suporte-{{ $solicitacao->id }}"
                                                onclick="mostrarDetalhesSuporte({{ $solicitacao->id }})"
                                                class="inline-flex items-center gap-2 rounded-lg px-3 py-2 font-semibold text-[#52745C] transition hover:bg-[#EAF1EB] focus:outline-none focus:ring-2 focus:ring-[#52745C]/30"
                                            >
                                                Ver detalhes
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" id="icone-detalhes-suporte-{{ $solicitacao->id }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr id="detalhes-suporte-{{ $solicitacao->id }}" class="hidden bg-[#FCF7F4]/70">
                                        <td colspan="4" class="px-6 py-6">
                                            <div class="grid grid-cols-1 gap-5 rounded-2xl border border-[#E8DED8] bg-white p-5 sm:grid-cols-2">
                                                <div>
                                                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                        Nome completo
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ $solicitacao->nome }}
                                                    </p>
                                                </div>

                                                <div>
                                                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                        Enviada em
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ $solicitacao->created_at->format('d/m/Y \à\s H:i') }}
                                                    </p>
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                        Descrição da solicitação
                                                    </p>
                                                    <p class="whitespace-pre-line break-words text-sm leading-6 text-gray-600">{{ $solicitacao->mensagem }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <p class="pb-2 text-center text-xs text-gray-400">
                Vitalle · Cuidado que transforma
            </p>
        </div>
    </div>

    <script>
        function mostrarDetalhesSuporte(id) {
            const detalhes = document.getElementById('detalhes-suporte-' + id);
            const botao = document.getElementById('botao-detalhes-suporte-' + id);
            const icone = document.getElementById('icone-detalhes-suporte-' + id);

            if (!detalhes || !botao) {
                return;
            }

            const vaiAbrir = detalhes.classList.contains('hidden');

            detalhes.classList.toggle('hidden', !vaiAbrir);
            botao.setAttribute('aria-expanded', vaiAbrir ? 'true' : 'false');

            const textoBotao = botao.childNodes[0];

            if (textoBotao) {
                textoBotao.textContent = vaiAbrir ? 'Ocultar detalhes ' : 'Ver detalhes ';
            }

            if (icone) {
                icone.classList.toggle('rotate-180', vaiAbrir);
            }
        }
    </script>
</x-sistema>
