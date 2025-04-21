<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bem-vindo ao GK Eventos 🎉
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
        @auth
            <p class="mb-6">Olá, {{ Auth::user()->name }}! 👋</p>
            <a href="{{ route('events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Criar novo evento
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Fazer login
            </a>
        @endauth
    </div>
</x-app-layout>
