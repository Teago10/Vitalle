<x-sistema>

    <div class="max-w-6xl mx-auto">

        <x-page-header title="Avaliação dos Cuidadores" subtitle="Confira e registre avaliações dos cuidadores." />

        {{-- RESUMO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Avaliação média geral</p>

                <div class="flex items-center gap-3 mt-3">
                    <span class="text-4xl font-bold text-[#232935]">
                        {{ number_format($mediaGeral, 1, ',', '.') }}
                    </span>
                    <span class="text-yellow-400 text-2xl">★</span>
                    <span class="text-sm text-gray-400">de 5</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500">Total de avaliações</p>

                <p class="text-4xl font-bold text-[#232935] mt-3">
                    {{ $totalAvaliacoes }}
                </p>
            </div>

        </div>

        {{-- PESQUISA E FILTRO --}}
        <div class="flex flex-col md:flex-row gap-4 mb-7">

            <input type="text" id="pesquisarCuidador" placeholder="Pesquisar cuidador..."
                class="flex-1 rounded-xl border-gray-200 bg-white
                       focus:border-[#518364] focus:ring-[#518364]">

            <select id="filtrarEstrelas"
                class="rounded-xl border-gray-200 bg-white
                       focus:border-[#518364] focus:ring-[#518364]">
                <option value="todas">Todas as avaliações</option>
                <option value="5">5 estrelas</option>
                <option value="4">4 estrelas</option>
                <option value="3">3 estrelas</option>
                <option value="2">2 estrelas</option>
                <option value="1">1 estrela</option>
            </select>

        </div>

        {{-- FORMULÁRIOS DE AVALIAÇÃO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

            @foreach ($cuidadores as $cuidador)
                @php
                    $minhaAvaliacao = $avaliacoes->first(function ($avaliacao) use ($cuidador) {
                        return $avaliacao->id_cuidador == $cuidador->id &&
                            $avaliacao->user_id == Auth::id() &&
                            $avaliacao->user_id !== null;
                    });
                @endphp

                @if (!$minhaAvaliacao)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                        <div class="flex items-center gap-3 mb-5">

                            <img src="https://i.pravatar.cc/100?u={{ $cuidador->id }}"
                                alt="Foto de {{ $cuidador->nome }}" class="w-12 h-12 rounded-full object-cover">

                            <div>
                                <h3 class="font-semibold text-[#232935]">
                                    {{ $cuidador->nome }}
                                </h3>

                                <p class="text-xs text-gray-500">
                                    {{ $cuidador->qualificacao ?? 'Cuidador de idosos' }}
                                </p>
                            </div>

                        </div>

                        <p class="text-sm font-medium text-gray-700 mb-2">
                            Avalie este cuidador
                        </p>

                        <div class="flex gap-1 mb-4" data-formulario-avaliacao data-cuidador="{{ $cuidador->id }}"
                            data-nota="0">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="estrela text-3xl text-gray-300 transition"
                                    data-valor="{{ $i }}">★</button>
                            @endfor
                        </div>

                        <textarea id="comentario-{{ $cuidador->id }}" rows="3" maxlength="1000" placeholder="Escreva sua avaliação..."
                            class="w-full rounded-xl border-gray-200
                                   text-sm resize-none
                                   focus:border-[#518364]
                                   focus:ring-[#518364]"></textarea>

                        <button type="button" onclick="enviarAvaliacao({{ $cuidador->id }}, this)"
                            class="w-full mt-4 bg-[#518364] hover:bg-[#416c51]
                                   text-white text-sm font-medium
                                   px-4 py-2.5 rounded-lg transition">
                            Enviar avaliação
                        </button>

                    </div>
                @endif
            @endforeach

        </div>

        {{-- AVALIAÇÕES PUBLICADAS --}}
        <h2 class="text-lg font-semibold text-[#232935] mb-5">
            Avaliações publicadas
        </h2>

        <div id="listaAvaliacoes" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            @foreach ($avaliacoes as $avaliacao)
                <div class="card-avaliacao bg-white rounded-2xl
                           border border-gray-100 shadow-sm p-6"
                    data-nome="{{ mb_strtolower($avaliacao->cuidador?->nome ?? '') }}"
                    data-nota="{{ $avaliacao->nota }}">

                    <div class="flex items-center gap-3 mb-4">

                        <img src="https://i.pravatar.cc/100?u={{ $avaliacao->id_cuidador }}" alt="Foto do cuidador"
                            class="w-12 h-12 rounded-full object-cover">

                        <div>
                            <h3 class="font-semibold text-[#232935]">
                                {{ $avaliacao->cuidador?->nome ?? 'Cuidador' }}
                            </h3>

                            <p class="text-xs text-gray-500">
                                {{ $avaliacao->cuidador?->qualificacao ?? 'Cuidador de idosos' }}
                            </p>
                        </div>

                    </div>

                    {{-- ESTRELAS SOMENTE LEITURA --}}
                    <div class="flex items-center gap-1 mb-4">

                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $nota = (float) $avaliacao->nota;
                                $cor = $i <= $nota ? '#facc15' : '#d1d5db';

                                $meia = $i - 0.5 == $nota;
                            @endphp

                            <span class="text-2xl"
                                style="
                                    @if ($meia) background: linear-gradient(
                                            90deg,
                                            #facc15 50%,
                                            #d1d5db 50%
                                        );
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                    @else
                                        color: {{ $cor }}; @endif
                                ">★</span>
                        @endfor

                        <span class="text-sm text-gray-500 ml-2">
                            {{ number_format($avaliacao->nota, 1, ',', '.') }}
                        </span>

                    </div>

                    <p class="text-sm text-gray-600 whitespace-pre-line mb-5">
                        {{ $avaliacao->comentario ?: 'Sem comentário.' }}
                    </p>

                    <div class="border-t border-gray-100 pt-4 flex items-center justify-between gap-3">

                        <div>
                            <p class="text-sm font-medium text-[#232935]">
                                {{ $avaliacao->usuario?->name ?? 'Autor não identificado' }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $avaliacao->created_at?->format('d/m/Y') }}
                            </p>
                        </div>

                        @if ($avaliacao->user_id !== null && $avaliacao->user_id === Auth::id())
                            <button type="button" onclick="excluirAvaliacao({{ $avaliacao->id }}, this)"
                                class="text-sm font-medium text-red-500
                                       hover:text-red-700 transition">
                                Excluir
                            </button>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>

        <p id="semResultados" class="hidden text-center text-gray-500 py-10">
            Nenhuma avaliação encontrada.
        </p>

    </div>

    {{-- AVISO --}}
    <div id="aviso-avaliacao"
        class="fixed bottom-6 right-6 bg-[#232935] text-white
               px-5 py-3 rounded-xl shadow-lg text-sm font-medium
               z-50 opacity-0 translate-y-[10px]
               pointer-events-none transition-all duration-300">
    </div>

    <script>
        // SELECIONAR ESTRELAS SEM SALVAR
        document.querySelectorAll('[data-formulario-avaliacao]').forEach(function(avaliacao) {

            const estrelas = avaliacao.querySelectorAll('.estrela');

            estrelas.forEach(function(estrela) {

                estrela.addEventListener('click', function(evento) {

                    const valor = Number(this.dataset.valor);
                    const retangulo = this.getBoundingClientRect();

                    const posicaoX = evento.clientX - retangulo.left;

                    const nota = posicaoX < retangulo.width / 2 ?
                        valor - 0.5 :
                        valor;

                    avaliacao.dataset.nota = nota;

                    atualizarEstrelas(estrelas, nota);
                });

            });

        });

        function atualizarEstrelas(estrelas, nota) {

            estrelas.forEach(function(estrela) {

                const valor = Number(estrela.dataset.valor);

                estrela.classList.remove(
                    'text-yellow-400',
                    'text-gray-300'
                );

                estrela.style.background = '';
                estrela.style.webkitBackgroundClip = '';
                estrela.style.webkitTextFillColor = '';

                if (valor <= nota) {

                    estrela.classList.add('text-yellow-400');

                } else if (valor - 0.5 === nota) {

                    estrela.style.background =
                        'linear-gradient(90deg, #facc15 50%, #d1d5db 50%)';

                    estrela.style.webkitBackgroundClip = 'text';
                    estrela.style.webkitTextFillColor = 'transparent';

                } else {

                    estrela.classList.add('text-gray-300');
                }

            });
        }

        // ENVIAR AVALIAÇÃO
        function enviarAvaliacao(idCuidador, botao) {

            const formulario = document.querySelector(
                '[data-formulario-avaliacao][data-cuidador="' + idCuidador + '"]'
            );

            const nota = Number(formulario.dataset.nota);

            const comentario = document.getElementById(
                'comentario-' + idCuidador
            ).value.trim();

            if (nota < 0.5) {
                mostrarAviso('Selecione as estrelas.');
                return;
            }

            if (!comentario) {
                mostrarAviso('Escreva um comentário.');
                return;
            }

            botao.disabled = true;
            botao.textContent = 'Enviando...';

            fetch('{{ route('avaliacao.salvar') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_cuidador: idCuidador,
                        nota: nota,
                        comentario: comentario
                    })
                })
                .then(async function(resposta) {

                    const dados = await resposta.json();

                    if (!resposta.ok || !dados.sucesso) {
                        throw new Error(dados.mensagem || 'Erro ao enviar avaliação.');
                    }

                    return dados;
                })
                .then(function() {

                    mostrarAviso('Avaliação enviada com sucesso!');

                    window.location.reload();
                })
                .catch(function(erro) {

                    mostrarAviso(erro.message);

                    botao.disabled = false;
                    botao.textContent = 'Enviar avaliação';
                });
        }

        // EXCLUIR AVALIAÇÃO
        function excluirAvaliacao(id, botao) {

            if (!confirm('Deseja realmente excluir esta avaliação?')) {
                return;
            }

            botao.disabled = true;

            const url = '{{ route('avaliacao.excluir', ['id' => '__ID__']) }}'
                .replace('__ID__', id);

            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(async function(resposta) {

                    const dados = await resposta.json();

                    if (!resposta.ok || !dados.sucesso) {
                        throw new Error(dados.mensagem || 'Erro ao excluir avaliação.');
                    }

                    return dados;
                })
                .then(function() {

                    mostrarAviso('Avaliação excluída com sucesso!');

                    window.location.reload();
                })
                .catch(function(erro) {

                    mostrarAviso(erro.message);
                    botao.disabled = false;
                });
        }

        // AVISO
        function mostrarAviso(mensagem) {

            const aviso = document.getElementById('aviso-avaliacao');

            aviso.textContent = mensagem;

            aviso.classList.remove(
                'opacity-0',
                'translate-y-[10px]'
            );

            clearTimeout(window.timerAviso);

            window.timerAviso = setTimeout(function() {

                aviso.classList.add(
                    'opacity-0',
                    'translate-y-[10px]'
                );

            }, 2500);
        }

        // PESQUISA E FILTRO
        const pesquisa = document.getElementById('pesquisarCuidador');
        const filtro = document.getElementById('filtrarEstrelas');

        function filtrarAvaliacoes() {

            const nome = pesquisa.value.toLocaleLowerCase('pt-BR');
            const estrelas = filtro.value;

            let encontrados = 0;

            document.querySelectorAll('.card-avaliacao').forEach(function(card) {

                const nomeCuidador = card.dataset.nome;
                const nota = Number(card.dataset.nota);

                const correspondeNome = nomeCuidador.includes(nome);

                const correspondeNota = estrelas === 'todas' ||
                    Math.ceil(nota) === Number(estrelas);

                const mostrar = correspondeNome && correspondeNota;

                card.classList.toggle('hidden', !mostrar);

                if (mostrar) encontrados++;
            });

            document.getElementById('semResultados')
                .classList.toggle('hidden', encontrados > 0);
        }

        pesquisa.addEventListener('input', filtrarAvaliacoes);
        filtro.addEventListener('change', filtrarAvaliacoes);
    </script>

</x-sistema>
