@extends('layouts.dashboard')

@section('title', 'Editar Evento')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">

    <h1 class="text-2xl font-bold text-blue-900 mb-6">✏️ Editar Evento: {{ $event->title }}</h1>

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

    {{-- FORMULÁRIO DE EDIÇÃO --}}
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Título do Evento</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Descrição</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-1">Data</label>
                <input type="date" name="event_date" value="{{ old('event_date', $event->event_date) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Hora</label>
                <input type="time" name="event_time" value="{{ old('event_time', $event->event_time) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Local</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Atualizar Banner (opcional)</label>
            <input type="file" name="banner" class="w-full">
            @if ($event->banner_path)
                <p class="text-sm text-gray-600 mt-1">Banner atual:</p>
                <div class="mt-4 flex justify-center">
    <img src="{{ asset('storage/' . $event->banner_path) }}"
         alt="Banner atual"
         class="h-40 object-contain rounded shadow bg-gray-100 p-2">
</div>
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                💾 Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection
