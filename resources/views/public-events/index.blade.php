@extends('layouts.public')

@section('title', 'Eventos Públicos')

@section('carousel')
    <section
        class="relative w-full max-w-5xl mx-auto mt-12 mb-4 rounded-xl overflow-hidden bg-gray-100 shadow-md"
        style="aspect-ratio: 16 / 5; max-height: 260px;"
        x-data="{
            current: 0,
            slides: [
                '{{ asset('images/banner1.jpg') }}',
                '{{ asset('images/banner2.jpg') }}',
                '{{ asset('images/banner3.jpg') }}'
            ],
            start() {
                setInterval(() => {
                    this.current = (this.current + 1) % this.slides.length;
                }, 4000)
            }
        }"
        x-init="start()"
    >
        <div class="relative w-full h-full">
            <template x-for="(slide, i) in slides" :key="i">
                <img
                    :src="slide"
                    class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-700"
                    :style="'opacity: ' + (current === i ? '1' : '0') + '; z-index: ' + (current === i ? '10' : '0')"
                >
            </template>
        </div>

        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-50 flex gap-2">
            <template x-for="(slide, i) in slides" :key="i">
                <div
                    @click="current = i"
                    class="h-3 w-3 rounded-full border transition duration-300 cursor-pointer"
                    :class="current === i ? 'bg-white border-blue-500' : 'bg-black/60 border-white/50'">
                </div>
            </template>
        </div>
    </section>
@endsection

@section('content')

    <!-- TÍTULO DA SESSÃO -->
    <section class="bg-blue-900 py-4 rounded-md shadow-md mb-8">
        <h3 class="text-center text-white text-xl font-bold tracking-wide">🌅 Inscrições Abertas</h3>
    </section>

    <!-- CAMPO DE BUSCA -->
    <form method="GET" action="{{ route('public.events') }}" class="mb-6 max-w-xl mx-auto">
        <div class="flex items-center gap-2">
            <input
                type="text"
                name="search"
                placeholder="Buscar evento por título..."
                value="{{ request('search') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-200 focus:outline-none"
            >
            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                🔍 Buscar
            </button>
        </div>
    </form>

    <!-- LISTA DE EVENTOS -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        @forelse ($events as $event)
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden flex flex-col md:flex-row gap-4 p-4 items-center">
                <div class="w-full md:w-1/3 relative">
                    <img src="{{ asset('storage/' . $event->banner_path) }}" alt="Banner" class="w-full aspect-[16/9] object-cover rounded-lg">

                    @if ($event->is_finished)
                        <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded shadow">
                            Encerrado
                        </span>
                    @endif
                </div>

                <div class="w-full md:w-2/3 flex flex-col justify-between gap-2">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $event->title }}</h3>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às {{ $event->event_time }}</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">📍 {{ $event->location }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($event->description, 100) }}</p>

                    @if (!$event->is_finished)
                        <a href="{{ route('public.events.show', $event->id) }}"
                           class="px-4 py-2 mt-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition w-fit">
                            🔍 Ver Detalhes
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 dark:text-gray-300">Nenhum evento disponível no momento.</p>
        @endforelse
    </div>
@endsection
