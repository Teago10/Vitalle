<x-sistema>

    <div class="max-w-6xl mx-auto">

        <x-page-header title="Avaliação dos Cuidadores" subtitle="Avalie o atendimento realizado pelo cuidador." />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($cuidadores as $cuidador)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                    {{-- FOTO --}}
                    <div class="h-56 bg-gray-200">

                        <img src="https://i.pravatar.cc/500?u={{ $cuidador->id }}" alt="Foto de {{ $cuidador->nome }}"
                            class="w-full h-full object-cover">

                    </div>


                    {{-- INFORMAÇÕES --}}
                    <div class="p-6">

                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $cuidador->nome }}
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $cuidador->qualificacao ?? 'Cuidador de idosos' }}
                        </p>

                        <p class="text-sm text-gray-600 mt-4">
                            Avalie o atendimento realizado por este cuidador.
                        </p>


                        {{-- ESTRELAS --}}
                        <div class="mt-6" data-avaliacao data-cuidador="{{ $cuidador->id }}"
                            data-nota="{{ $avaliacoes->get($cuidador->id)->nota ?? 0 }}">

                            <p class="text-sm font-medium text-gray-700 mb-2">
                                Avalie este cuidador
                            </p>

                            <div class="flex gap-1">

                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" class="estrela text-3xl text-gray-300 transition"
                                        data-valor="{{ $i }}">
                                        ★
                                    </button>
                                @endfor

                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>


    {{-- AVISO FLUTUANTE --}}
    <div id="aviso-avaliacao"
        class="fixed bottom-6 right-6 bg-[#232935] text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium z-50 opacity-0 translate-y-[10px] pointer-events-none transition-all duration-300">
        Avaliação selecionada
    </div>


    {{-- JAVASCRIPT --}}
    <script>
        document.querySelectorAll('[data-avaliacao]').forEach(function(avaliacao) {

            const estrelas = avaliacao.querySelectorAll('.estrela');

            const idCuidador = avaliacao.dataset.cuidador;
            const notaSalva = Number(avaliacao.dataset.nota);

            if (notaSalva > 0) {
                atualizarEstrelas(estrelas, notaSalva);
            }


            estrelas.forEach(function(estrela) {

                estrela.addEventListener('click', function(evento) {

                    const valor = Number(this.dataset.valor);

                    const largura = this.offsetWidth;

                    const posicaoX = evento.offsetX;

                    let nota;


                    // Clique na metade esquerda
                    if (posicaoX < largura / 2) {

                        nota = valor - 0.5;

                    }

                    // Clique na metade direita
                    else {

                        nota = valor;

                    }


                    // Atualiza visualmente as estrelas
                    atualizarEstrelas(estrelas, nota);


                    // Salva a avaliação
                    salvarAvaliacao(idCuidador, nota);

                });

            });

        });


        function atualizarEstrelas(estrelas, nota) {

            estrelas.forEach(function(estrela) {

                const valorEstrela =
                    Number(estrela.dataset.valor);


                // Limpa tudo
                estrela.classList.remove(
                    'text-yellow-400',
                    'text-gray-300'
                );

                estrela.style.background = '';

                estrela.style.webkitBackgroundClip = '';

                estrela.style.webkitTextFillColor = '';


                // Estrela cheia
                if (valorEstrela <= nota) {

                    estrela.classList.add(
                        'text-yellow-400'
                    );

                }


                // Meia estrela
                else if (valorEstrela - 0.5 === nota) {

                    estrela.style.background =
                        'linear-gradient(90deg, #facc15 50%, #d1d5db 50%)';

                    estrela.style.webkitBackgroundClip =
                        'text';

                    estrela.style.webkitTextFillColor =
                        'transparent';

                }


                // Estrela vazia
                else {

                    estrela.classList.add(
                        'text-gray-300'
                    );

                }

            });

        }


        function salvarAvaliacao(idCuidador, nota) {

            fetch('{{ route('avaliacao.salvar') }}', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'

                    },

                    body: JSON.stringify({

                        id_cuidador: idCuidador,

                        nota: nota

                    })

                })

                .then(function(resposta) {

                    if (!resposta.ok) {

                        throw new Error(
                            'Erro HTTP: ' + resposta.status
                        );

                    }

                    return resposta.json();

                })

                .then(function(dados) {

                    if (dados.sucesso) {

                        mostrarAviso(
                            'Avaliação salva: ' +
                            nota.toFixed(1).replace('.', ',') +
                            ' estrelas'
                        );

                    }

                })

                .catch(function(erro) {

                    console.error(
                        'Erro ao salvar avaliação:',
                        erro
                    );

                    mostrarAviso(
                        'Não foi possível salvar a avaliação.'
                    );

                });

        }


        function mostrarAviso(mensagem) {

            const aviso =
                document.getElementById('aviso-avaliacao');


            aviso.textContent = mensagem;


            // Mostra o aviso
            aviso.classList.remove(
                'opacity-0',
                'translate-y-[10px]'
            );


            // Cancela o timer anterior
            clearTimeout(window.timerAviso);


            // Esconde depois de 2 segundos
            window.timerAviso = setTimeout(function() {

                aviso.classList.add(
                    'opacity-0',
                    'translate-y-[10px]'
                );

            }, 2000);

        }
    </script>

</x-sistema>
