<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GK Events')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-9 py-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-2xl font-extrabold">GKA <span class="text-blue-300">events</span></div>

            <nav class="flex flex-wrap gap-6 text-sm font-medium justify-center items-center relative">
                <a href="{{ route('home') }}" class="hover:text-blue-300">Início</a>
                <a href="{{ route('institucional.quem-somos') }}" class="hover:text-blue-300">Quem Somos</a>
                <a href="{{ route('institucional.nossa-missao') }}" class="hover:text-blue-300">Nossa Missão</a>
                <a href="{{ route('institucional.contato') }}" class="hover:text-blue-300">Contato</a>

                <!-- Dropdown de Categorias -->
                <div class="relative group">
                    <button class="flex items-center gap-1 text-white hover:text-blue-300">
                        Eventos
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="absolute left-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg z-50
                                opacity-0 group-hover:opacity-100 invisible group-hover:visible
                                transition-all duration-200 ease-in-out">
                        @foreach ($categories as $category)
                            @if ($category->slug)
                                <a href="{{ route('categories.showBySlug', ['slug' => $category->slug]) }}"
                                   class="block px-4 py-2 text-sm hover:bg-blue-100 transition">
                                    {{ $category->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </nav>

            <!-- Autenticação -->
            <div class="flex items-center gap-3 mt-2 md:mt-0">
                @auth
                    <div class="relative group">
                        <button class="relative flex items-center justify-center w-10 h-10 rounded-full bg-white shadow focus:outline-none overflow-hidden z-10">
                            @if (auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                     alt="Foto de perfil"
                                     class="absolute top-0 left-0 w-full h-full object-cover rounded-full z-0">
                            @else
                                <span class="text-blue-900 font-bold text-sm z-10">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif

                            <!-- Seta de dropdown destacada -->
                            <span class="absolute bottom-0 right-0 bg-blue-300 rounded-full p-1 z-20 shadow-lg">
                                <svg class="w-4 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg z-50
                                    opacity-0 group-hover:opacity-100 invisible group-hover:visible
                                    transition-all duration-200 ease-in-out">
                            <div class="px-4 py-2 text-sm text-gray-500 border-b border-gray-200">
                                {{ auth()->user()->email }}
                            </div>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-blue-50">📊 Painel</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-blue-50">🙋 Meu Perfil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-blue-50">🔒 Sair</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-gray-100 text-blue-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                        🔒 Entrar
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-100 text-blue-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-200 transition">
                        📋 Cadastrar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- CARROSSEL -->
    @hasSection('carousel')
        @yield('carousel')
    @endif

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="py-10 px-4 max-w-7xl mx-auto">
        @yield('content')
    </main>

    <!-- RODAPÉ -->
    <footer class="bg-blue-900 text-white text-sm mt-16 py-10 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h5 class="font-bold text-lg">GK Events</h5>
                <p class="mt-2">Facilitando sua gestão de eventos com excelência!</p>
            </div>

            <div>
                <h5 class="font-bold">Contato</h5>
                <ul class="mt-2 space-y-1">
                    <li>📧 contato@gkeventos.com</li>
                    <li>📱 WhatsApp: (96) 9xxxx-xxxx</li>
                    <li>📍 Afuá - Pará, Brasil</li>
                </ul>
            </div>

            <div>
                <h5 class="font-bold">Redes Sociais</h5>
                <div class="flex gap-4 mt-2">
                    <a href="#" aria-label="Instagram" class="hover:text-blue-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="hover:text-blue-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                    <a href="#" aria-label="YouTube" class="hover:text-blue-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                </div>
            </div>
        </div>

        <p class="text-center text-xs mt-8">GK Eventos © {{ date('Y') }}. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
