<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - GK Eventos</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-blue-600 to-sky-900 text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-7xl flex flex-col md:flex-row items-center justify-between px-4 py-12 gap-10">

        <!-- FORMULÁRIO À ESQUERDA -->
        <div class="w-full md:w-1/2">
            <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md mx-auto text-gray-800">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-blue-900">GKA <span class="text-blue-400">Events</span></h1>
                    <p class="text-sm text-gray-500">Cadastre-se e participe de eventos incríveis!</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" autocomplete="off">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input id="name" name="name" type="text" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- E-mail -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input id="email" name="email" type="email" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input id="password" name="password" type="password" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" autocomplete="new-password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar senha</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" autocomplete="new-password">
                    </div>

                    <!-- Botão -->
                    <div>
                        <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            📝 Cadastrar
                        </button>
                    </div>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Acesse aqui</a>
                </p>
            </div>
        </div>

        <!-- ILUSTRAÇÃO À DIREITA -->
        <div class="hidden md:flex flex-col justify-center items-center w-1/2 text-center px-6">
            <img src="{{ asset('images/register-illustration.png') }}" alt="Cadastro Ilustração" class="w-72 mb-6">
            <h2 class="text-3xl font-bold text-white mb-2 leading-snug">
                Junte-se à comunidade <span class="text-yellow-200">GK Eventos</span>!
            </h2>
            <p class="text-blue-100 text-base max-w-sm">
                Cadastre-se agora e desbloqueie uma nova experiência:
            </p>

            <ul class="text-sm text-blue-100 mt-4 space-y-1">
                <li>✔️ Inscreva-se em eventos</li>
                <li>✔️ Gere certificados digitais</li>
                <li>✔️ Acompanhe suas participações</li>
            </ul>
        </div>

    </div>

</body>
</html>
