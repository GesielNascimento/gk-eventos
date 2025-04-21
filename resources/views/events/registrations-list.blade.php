@extends('layouts.dashboard')

@section('title', 'Inscrições do Evento')

@section('content')
    <div class="space-y-8">

        <!-- TÍTULO -->
        <h1 class="text-2xl font-bold text-blue-900">👥 Inscrições de: {{ strtoupper($event->title) }}</h1>

        <!-- MENSAGEM DE SUCESSO -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- MENSAGEM QUANDO NÃO HÁ INSCRITOS -->
        @if ($registrations->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded shadow-sm">
                Nenhum participante inscrito neste evento ainda.
            </div>
        @else
            <!-- BOTÕES E FORMULÁRIO (um abaixo do outro) -->
            <div class="flex flex-col gap-6">

                <!-- BOTÃO DE EXPORTAR -->
                <div>
                    <a href="{{ route('events.registrations.export', $event->id) }}"
                       class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded hover:bg-blue-700 transition">
                        📄 Exportar PDF
                    </a>
                </div>

                <!-- FORM DE PRESENÇA -->
                <form action="{{ route('events.registrations.markPresence', $event->id) }}" method="POST" class="w-full">
                    @csrf

                    <!-- TABELA RESPONSIVA -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-xl text-sm shadow">
                            <thead class="bg-blue-100 text-blue-900 font-semibold">
                                <tr>
                                    <th class="px-4 py-3 border text-left">#</th>
                                    <th class="px-4 py-3 border text-center">Presente</th>
                                    <th class="px-4 py-3 border text-left">Nome</th>
                                    <th class="px-4 py-3 border text-left">Email</th>
                                    <th class="px-4 py-3 border text-left">Data de Inscrição</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach ($registrations as $index => $registration)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <input type="checkbox" name="present[{{ $registration->id }}]" {{ $registration->present ? 'checked' : '' }}>
                                        </td>
                                        <td class="px-4 py-2 border">{{ $registration->user->name }}</td>
                                        <td class="px-4 py-2 border">{{ $registration->user->email }}</td>
                                        <td class="px-4 py-2 border">{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- BOTÃO DE SALVAR -->
                    <div class="mt-6 text-right">
                        <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition font-semibold">
                            ✅ Salvar Presenças
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
