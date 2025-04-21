@extends('layouts.dashboard')

@section('title', 'Detalhes do Evento')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Banner -->
        <div class="rounded-xl overflow-hidden shadow">
            <img src="{{ asset('storage/' . $event->banner_path) }}"
                 alt="Banner do Evento"
                 class="w-full h-64 object-cover">
        </div>

        <!-- Informações do evento -->
        <div class="bg-white p-6 rounded-xl shadow space-y-4">
            <h1 class="text-3xl font-bold text-blue-900">{{ $event->title }}</h1>

            <p class="text-gray-600">
                📅 <strong>Data:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às ⏰ {{ $event->event_time }}
            </p>

            <p class="text-gray-600">
                📍 <strong>Local:</strong> {{ $event->location }}
            </p>

            <p class="text-gray-700 leading-relaxed border-t pt-4">
                {!! nl2br(e($event->description)) !!}
            </p>
        </div>

        <!-- Feedbacks -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Botão de inscrição -->
        <div class="text-right">
            @auth
                @if (!auth()->user()->registrations->contains('event_id', $event->id))
                    <form action="{{ route('events.register', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                            ✅ Inscrever-se
                        </button>
                    </form>
                @else
                    <p class="text-green-700 font-medium">Você já está inscrito neste evento.</p>
                @endif
            @else
                <p class="text-gray-500 italic">Faça login para se inscrever neste evento.</p>
            @endauth
        </div>
    </div>
@endsection
