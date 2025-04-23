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

            {{-- INSCRIÇÃO SOMENTE SE NÃO ENCERRADO --}}
            @if (!$event->is_finished)
                @auth
                    @if (!auth()->user()->registrations->contains('event_id', $event->id))
                        <form method="POST" action="{{ route('events.register', $event->id) }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                ✅ Inscrever-se
                            </button>
                        </form>
                    @else
                        <span class="text-green-700 font-medium">Você já está inscrito neste evento.</span>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-300 text-yellow-900 rounded hover:bg-yellow-400 transition">
                        🔐 Faça login para se inscrever
                    </a>
                @endauth
            @else
                <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded font-semibold">
                    Evento Encerrado
                </span>
            @endif
        </div>
    </section>
@endsection
