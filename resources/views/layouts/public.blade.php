<!DOCTYPE html>
<html lang="pt-BR" x-data x-init>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GK Events')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-9 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-2xl font-extrabold">GKA <span class="text-blue-300">events</span></div>

            <nav class="flex flex-wrap gap-12 text-sm font-medium justify-center">
                <a href="{{ route('home') }}" class="hover:text-blue-300">Início</a>
                <a href="{{ route('institucional.quem-somos') }}" class="hover:text-blue-300">Quem Somos</a>
                <a href="{{ route('institucional.nossa-missao') }}" class="hover:text-blue-300">Nossa Missão</a>
                <a href="{{ route('institucional.contato') }}" class="hover:text-blue-300">Contato</a>
            </nav>


            <div class="flex gap-6">
                <a href="{{ route('login') }}"
                class="bg-gray-100 text-blue-900 px-5 py-2 rounded-lg text-sm font-semibold flex items-center gap-1 hover:bg-gray-200 transition">
                    🔒 Entrar
                </a>
                <a href="{{ route('register') }}"
                class="bg-blue-100 text-blue-900 px-5 py-2 rounded-lg text-sm font-semibold flex items-center gap-1 hover:bg-blue-200 transition">
                    📋 Cadastrar
                </a>
            </div>
        </div>
    </header>

    <!-- CARROSSEL (OPCIONAL) -->
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
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM4.5 7.75a3.25 3.25 0 013.25-3.25h8.5a3.25 3.25 0 013.25 3.25v8.5a3.25 3.25 0 01-3.25 3.25h-8.5A3.25 3.25 0 014.5 16.25v-8.5zM12 8a4 4 0 100 8 4 4 0 000-8zm0 1.5a2.5 2.5 0 110 5 2.5 2.5 0 010-5zm5.5-.88a1 1 0 11-2 0 1 1 0 012 0z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="hover:text-blue-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M22 12a10 10 0 10-11.63 9.87v-6.99h-2.77v-2.88h2.77V9.4c0-2.74 1.63-4.25 4.12-4.25 1.2 0 2.45.21 2.45.21v2.69h-1.38c-1.36 0-1.79.84-1.79 1.7v2.04h3.05l-.49 2.88h-2.56V22A10 10 0 0022 12z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube" class="hover:text-blue-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M21.8 8.001s-.2-1.5-.8-2.2c-.7-.8-1.5-.8-1.9-.9C16.5 4.7 12 4.7 12 4.7h-.1s-4.5 0-7.1.2c-.5.1-1.2.1-1.9.9C2.2 6.5 2 8 2 8S1.8 9.7 1.8 11.5v1c0 1.8.2 3.5.2 3.5s.2 1.5.8 2.2c.7.8 1.7.8 2.2.9 1.6.2 6.8.2 6.8.2s4.5 0 7.1-.2c.5-.1 1.2-.1 1.9-.9.6-.7.8-2.2.8-2.2s.2-1.8.2-3.5v-1c0-1.8-.2-3.5-.2-3.5zM9.75 14.8V9.2l5.3 2.8-5.3 2.8z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <p class="text-center text-xs mt-8">GK Eventos © {{ date('Y') }}. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
