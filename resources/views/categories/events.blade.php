@extends('layouts.public')


@section('title', 'Eventos da Categoria')

@section('content')
    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-blue-900">
            🎯 Eventos da categoria: {{ $category->name }}
        </h1>

        @forelse ($events as $event)
            <div class="bg-white shadow rounded-xl p-4 flex flex-col md:flex-row gap-4 items-center">
                <!-- Banner -->
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/' . $event->banner_path) }}"
                         alt="Banner"
                         class="w-full h-40 object-cover rounded-lg">
                </div>

                <!-- Informações -->
                <div class="w-full md:w-2/3 space-y-2">
                    <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                    <p class="text-sm text-gray-600">
                        📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às ⏰ {{ $event->event_time }}
                    </p>
                    <p class="text-sm text-gray-600">📍 {{ $event->location }}</p>
                    <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>

                    <a href="{{ route('public.events.show', $event->id) }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm mt-2">
                        🔍 Ver Detalhes
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                Nenhum evento disponível nesta categoria no momento.
            </div>
        @endforelse

        <!-- Paginação -->
        <div class="pt-6">
            {{ $events->links() }}
        </div>
    </div>
@endsection
