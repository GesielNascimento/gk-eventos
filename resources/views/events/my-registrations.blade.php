@extends('layouts.dashboard')

@section('title', 'Minhas Inscrições')

@section('content')
    <div class="space-y-8">

        <h1 class="text-2xl font-extrabold text-blue-900">📝 Minhas Inscrições</h1>

        @forelse ($registrations as $registration)
            @php
                $event = $registration->event;
            @endphp

            <div class="bg-white rounded-xl shadow p-6 flex flex-col md:flex-row gap-6 items-start">
                <!-- Banner -->
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/' . $event->banner_path) }}" alt="Banner"
                         class="w-full h-40 object-cover rounded-lg">
                </div>

                <!-- Informações do Evento -->
                <div class="w-full md:w-2/3 space-y-2">
                    <h2 class="text-xl font-bold text-gray-800">{{ $event->title }}</h2>

                    <p class="text-sm text-gray-600">📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às {{ $event->event_time }}</p>
                    <p class="text-sm text-gray-600">📍 {{ $event->location }}</p>

                    <p class="text-sm font-medium {{ $registration->present ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $registration->present ? '✅ Presença Confirmada' : '⏳ Aguardando Confirmação de Presença' }}
                    </p>

                    @if ($registration->present)
                        <a href="{{ route('events.certificate', $event->id) }}"
                           class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                            📄 Baixar Certificado
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded">
                <p>Você ainda não está inscrito em nenhum evento.</p>
            </div>
        @endforelse

    </div>
@endsection
