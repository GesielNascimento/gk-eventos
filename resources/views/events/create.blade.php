@extends('layouts.dashboard')

@section('title', 'Criar Novo Evento')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold text-blue-900 mb-6 flex items-center gap-2">
            ➕ Cadastrar Novo Evento
        </h1>

        {{-- MENSAGEM DE SUCESSO --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- MENSAGENS DE ERRO --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORMULÁRIO DE EVENTO --}}
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Título -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">🎯 Título do Evento</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Descrição -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📝 Descrição</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <!-- Data e Horário -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Data do Evento</label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">⏰ Horário</label>
                    <input type="time" name="event_time" value="{{ old('event_time') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
            </div>

            <!-- Local -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📍 Local do Evento</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Categoria -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📚 Categoria</label>
                <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Banner -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">🖼️ Banner do Evento</label>
                <input type="file" name="banner"
                       class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg file:bg-blue-100 file:border-none file:px-4 file:py-2 file:mr-3 file:text-blue-700">
            </div>

            <!-- Botão -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    🚀 Cadastrar Evento
                </button>
            </div>
        </form>
    </div>
@endsection
