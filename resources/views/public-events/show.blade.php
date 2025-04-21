@extends('layouts.public')

@section('title', $event->title)

@section('content')
    <!-- BANNER DO EVENTO -->
    <section class="flex justify-center mb-10">
        <div class="w-full max-w-lg aspect-[16/9] rounded-xl overflow-hidden shadow">
            <img src="{{ asset('storage/' . $event->banner_path) }}"
                alt="Banner do evento"
                class="w-full h-full object-cover">
        </div>
    </section>

    <!-- INFORMAÇÕES DO EVENTO -->
    <section class="w-full max-w-5xl mx-auto space-y-6">
        <!-- Título, data e local -->
        <div class="space-y-2">
            <h1 class="text-3xl font-bold text-blue-900">{{ $event->title }}</h1>
            <p class="text-gray-600 text-sm flex items-center gap-2">
                📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às {{ $event->event_time }}
            </p>
            <p class="text-gray-600 text-sm flex items-center gap-2">
                📍 {{ $event->location }}
            </p>
        </div>

        <!-- Descrição -->
        <div class="text-gray-700 leading-relaxed text-justify bg-gray-100 p-5 rounded-lg shadow">
            {!! nl2br(e($event->description)) !!}
        </div>

        <!-- Botões -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('public.events') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                ⬅️ Voltar
            </a>

            @auth
                @if (!auth()->user()->registrations->contains('event_id', $event->id))
                    <form method="POST" action="{{ route('events.register', $event->id) }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            ✅ Inscrever-se
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </section>
@endsection
