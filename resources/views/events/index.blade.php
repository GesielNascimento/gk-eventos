@extends('layouts.dashboard')

@section('title', 'Meus Eventos')

@section('content')
    <!-- Título -->
    <div class="bg-white p-4 rounded-xl shadow text-center mb-10">
        <h2 class="text-2xl font-bold text-blue-900">📂 Meus Eventos Criados</h2>
        <p class="text-sm text-gray-600 mt-1">Gerencie, edite ou exclua os eventos que você cadastrou.</p>
    </div>

    <!-- Listagem de Eventos -->
    <div class="space-y-8">
        @forelse ($events as $event)
            <div class="bg-white shadow-md rounded-xl overflow-hidden flex flex-col md:flex-row gap-6 p-6 items-start md:items-center">
                <!-- Banner -->
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/' . $event->banner_path) }}"
                         alt="Banner"
                         class="w-full h-44 object-cover rounded-lg shadow">
                </div>

                <!-- Informações + Ações -->
                <div class="w-full md:w-2/3 flex flex-col gap-3">
                    <div>
                        <h3 class="text-xl font-bold text-blue-900 mb-1">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às ⏰ {{ $event->event_time }}</p>
                        <p class="text-sm text-gray-600">📍 {{ $event->location }}</p>
                        <p class="text-sm text-gray-700 mt-2">{{ Str::limit($event->description, 100) }}</p>
                    </div>

                    <!-- Ações -->
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('events.show', $event->id) }}"
                           class="px-4 py-2 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            🔍 Ver Detalhes
                        </a>

                        @if ($event->user_id === auth()->id())
                            <a href="{{ route('events.registrations', $event->id) }}"
                               class="px-4 py-2 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                👥 Ver Inscritos
                            </a>

                            <a href="{{ route('events.registrations.export', $event->id) }}"
                               class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                                📄 Exportar PDF
                            </a>

                            <a href="{{ route('events.edit', $event->id) }}"
                               class="px-4 py-2 text-sm font-medium bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este evento?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    🗑️ Excluir
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 text-sm">🫤 Nenhum evento cadastrado por você ainda.</p>
        @endforelse
    </div>
@endsection
