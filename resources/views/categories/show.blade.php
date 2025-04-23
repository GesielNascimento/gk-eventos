{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.public')

@section('title', 'Eventos: ' . $category->name)

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Eventos da categoria: <span class="text-blue-600">{{ $category->name }}</span>
    </h2>

    @if ($category->events->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            Nenhum evento encontrado para esta categoria.
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($category->events as $event)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $event->banner_path) }}"
                         alt="Banner do Evento"
                         class="w-full h-40 object-cover">
                    
                    <div class="p-4 space-y-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->description }}</p>
                        <a href="{{ route('public.events.show', $event->id) }}"
                           class="inline-block mt-2 text-blue-600 hover:underline text-sm">
                            Ver detalhes →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
