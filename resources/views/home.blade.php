@extends('layouts.site')

<body id="body">


    <div class="min-h-screen flex items-center justify-center ">
        <div class="bg-zinc-900 p-8 rounded-2xl shadow-lg w-96">

            <h1 class="text-3xl font-bold text-white text-center mb-6">
                Vittalle
            </h1>

            <p class="text-zinc-400 text-center mb-6">
                Entre para continuar
            </p>

            <label for="nome" id="nome" class="text-white p-2">Nome Completo</label>
            <input type="text" name="nome" class=" mb-5 rounded-lg transition w-full"
                placeholder="Ex: João Silva">

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                Entrar
            </button>
            
        </div>

    </div>
</body>
