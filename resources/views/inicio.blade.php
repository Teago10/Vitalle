<x-app-layout>

    <div class="min-h-screen flex">

        <!-- Lado esquerdo -->
        <div class="hidden lg:block lg:w-1/2">
            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200"
                class="w-full h-full object-cover" alt="">
        </div>

        <!-- Conteúdo -->
        <div class="w-full lg:w-1/2 bg-gray-50">

            <!-- Topo -->
            <div class="bg-white shadow-sm border-b">
                <div class="max-w-6xl mx-auto px-8 py-6 flex justify-between items-center">

                    <div>
                        <h1 class="text-3xl font-bold text-green-700">
                            Vitale Concierge
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Plataforma de gerenciamento de cuidados.
                        </p>
                    </div>

                    <div>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg transition">
                            Sair
                        </button>
                    </div>

                </div>
            </div>

            <!-- Conteúdo -->
            <div class="max-w-5xl mx-auto p-8">

                <h2 class="text-4xl font-bold text-gray-800">
                    Bem-vindo!
                </h2>

                <p class="text-gray-500 mt-2 mb-10">
                    Escolha uma das opções abaixo para começar.
                </p>

                <!-- Cards -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border">

                        <div class="text-green-600 text-5xl mb-4">
                            👤
                        </div>

                        <h3 class="text-xl font-semibold">
                            Cuidadores
                        </h3>
1
                        <p class="text-gray-500 mt-2">
                            Gerencie todos os cuidadores cadastrados.
                        </p>

                        <button class="mt-6 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                            Acessar
                        </button>

                    </div>

                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border">

                        <div class="text-blue-600 text-5xl mb-4">
                            👨‍👩‍👧
                        </div>

                        <h3 class="text-xl font-semibold">
                            Responsáveis
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Visualize e gerencie os responsáveis.
                        </p>

                        <button class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Acessar
                        </button>

                    </div>

                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border">

                        <div class="text-yellow-500 text-5xl mb-4">
                            📅
                        </div>

                        <h3 class="text-xl font-semibold">
                            Agendamentos
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Consulte e acompanhe os serviços.
                        </p>

                        <button class="mt-6 bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                            Acessar
                        </button>

                    </div>

                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border">

                        <div class="text-purple-600 text-5xl mb-4">
                            ⚙️
                        </div>

                        <h3 class="text-xl font-semibold">
                            Configurações
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Personalize as configurações do sistema.
                        </p>

                        <button class="mt-6 bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg">
                            Acessar
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
