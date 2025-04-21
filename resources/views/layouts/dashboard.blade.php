<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel - GK Eventos')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: false }">

    <!-- TOPO MOBILE -->
    <header class="md:hidden bg-blue-900 text-white flex justify-between items-center p-4">
        <div class="text-xl font-bold">GK<span class="text-blue-300">Eventos</span></div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl">
            ☰
        </button>
    </header>

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside
            class="bg-blue-900 text-white w-64 flex flex-col justify-between space-y-2 px-4 py-6 fixed md:relative inset-y-0 left-0 z-40 transform transition-transform duration-200 md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div>
                <div class="text-2xl font-bold mb-6 border-b border-blue-700 pb-4 px-2">
                    GK<span class="text-blue-300">Eventos</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        📊 Painel
                    </a>
                    <a href="{{ route('public.events') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        🌐 Ver Eventos
                    </a>
                    <a href="{{ route('events.create') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        ➕ Criar Evento
                    </a>
                    <!-- 📋 Meus Eventos Criados -->
                    <a href="{{ route('events.index') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        📋 Meus Eventos Criados
                    </a>
                    <a href="{{ route('events.my') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        📝 Minhas Inscrições
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-blue-700 transition">
                        ⚙️ Perfil
                    </a>
                </nav>
            </div>

            <div class="border-t border-blue-700 pt-4 px-2 text-sm">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-700 transition">
                        🚪 Sair
                    </button>
                </form>
            </div>
        </aside>

        <!-- OVERLAY MOBILE -->
        <div
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        <!-- Conteúdo principal -->
        <div class="flex-1">
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
