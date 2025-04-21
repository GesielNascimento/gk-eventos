@extends('layouts.public')

@section('title', 'Eventos Públicos')

@section('content')
    <h1 class="text-3xl font-bold text-center text-blue-900 mb-10">🌅 Inscrições Abertas</h1>

    @forelse ($events as $event)
        <div class="bg-white shadow-md rounded-2xl overflow-hidden flex flex-col md:flex-row items-center gap-4 p-4 hover:shadow-xl transition mb-6">
            <!-- Imagem do evento -->
            <div class="w-full md:w-1/3">
                <img src="{{ asset('storage/' . $event->banner_path) }}"
                     alt="Banner do Evento"
                     class="w-full h-44 object-cover rounded-lg bg-gray-100">
            </div>

            <!-- Informações do evento -->
            <div class="flex-1 space-y-1">
                <h2 class="text-xl font-bold text-gray-800 uppercase">{{ $event->title }}</h2>
                <p class="text-sm text-gray-600">
                    📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às {{ $event->event_time }}
                </p>
                <p class="text-sm text-gray-600">📍 {{ $event->location }}</p>
                <p class="text-sm text-gray-700">
                    {{ Str::limit($event->description, 120) }}
                </p>

                <a href="{{ route('public.events.show', $event->id) }}"
                   class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700 transition">
                    🔍 Ver Detalhes
                </a>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500">Nenhum evento disponível no momento.</p>
    @endforelse
@endsection
