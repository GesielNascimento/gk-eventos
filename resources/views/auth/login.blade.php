<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GK Eventos</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 text-white min-h-screen flex items-center justify-center">



    <div class="w-full max-w-7xl flex flex-col md:flex-row items-center justify-between px-4 py-12 gap-10">

        <!-- ILUSTRAÇÃO E MENSAGEM -->
        <div class="hidden md:flex flex-col justify-center items-center w-1/2 text-center px-6">
            <img src="{{ asset('images/login-illustration.png') }}" alt="Login Ilustração" class="w-72 mb-6">
            
            <h2 class="text-3xl font-bold text-white mb-2 leading-snug">
                Bem-vindo ao <span class="text-blue-50">GK Eventos</span>!
            </h2>
            
            <p class="text-blue-100 text-base max-w-sm">
                Gerencie inscrições, eventos e certificados com agilidade e excelência.
            </p>
        </div>

        <!-- FORMULÁRIO -->
        <div class="w-full md:w-1/2">
            <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md mx-auto">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-blue-900">GKA <span class="text-blue-400">Events</span></h1>
                    <p class="text-sm text-gray-500">Acesse sua conta para continuar</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input id="password" type="password" name="password" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Lembrar e link -->
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            Lembrar-me
                        </label>

                        @if (Route::has('password.request'))
                            <a class="hover:underline text-blue-600" href="{{ route('password.request') }}">
                                Esqueceu sua senha?
                            </a>
                        @endif
                    </div>

                    <!-- Botão -->
                    <div>
                        <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            🔐 Entrar
                        </button>
                    </div>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Não tem uma conta?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Cadastre-se aqui</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
