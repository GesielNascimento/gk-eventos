@extends('layouts.dashboard')

@section('title', 'Editar Perfil')

@section('content')
    <div class="max-w-3xl mx-auto space-y-10">
        <h1 class="text-2xl font-bold text-blue-900">⚙️ Gerenciar Perfil</h1>

        {{-- Mensagem de sucesso --}}
        @if (session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                Perfil atualizado com sucesso!
            </div>
        @endif

        {{-- Formulário de atualização de dados --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow space-y-6">
            @csrf
            @method('PATCH')

            <!-- Foto de Perfil -->
            <div>
                <label for="profile_photo" class="block font-semibold mb-1">Foto de Perfil</label>

                @if ($user->profile_photo_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Foto de Perfil"
                             class="w-24 h-24 object-cover rounded-full border border-gray-300">
                    </div>
                @endif

                <input type="file" name="profile_photo" id="profile_photo"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100" />
            </div>

            <!-- Nome -->
            <div>
                <label for="name" class="block font-semibold mb-1">Nome</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2">
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Botão -->
            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition font-semibold">
                    💾 Salvar Alterações
                </button>
            </div>
        </form>

        {{-- Formulário de senha --}}
        <form method="POST" action="{{ route('password.update') }}" class="bg-white p-6 rounded-xl shadow space-y-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-bold text-blue-800">🔒 Alterar Senha</h2>

            <!-- Senha atual -->
            <div>
                <label for="current_password" class="block font-semibold mb-1">Senha Atual</label>
                <input id="current_password" name="current_password" type="password"
                       class="w-full border border-gray-300 rounded px-4 py-2">
                @error('current_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Nova senha -->
            <div>
                <label for="password" class="block font-semibold mb-1">Nova Senha</label>
                <input id="password" name="password" type="password"
                       class="w-full border border-gray-300 rounded px-4 py-2">
                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirmação -->
            <div>
                <label for="password_confirmation" class="block font-semibold mb-1">Confirmar Nova Senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="w-full border border-gray-300 rounded px-4 py-2">
                @error('password_confirmation') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition font-semibold">
                    🔐 Atualizar Senha
                </button>
            </div>
        </form>

        {{-- Exclusão de conta --}}
        <form method="POST" action="{{ route('profile.destroy') }}" class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-bold text-red-700">🚨 Excluir Conta</h2>

            <p class="text-sm text-gray-600">
                Esta ação é irreversível. Ao excluir sua conta, todos os seus dados serão removidos permanentemente.
            </p>

            <input type="password" name="password" placeholder="Digite sua senha para confirmar"
                   class="w-full border border-gray-300 rounded px-4 py-2">

            @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

            <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition font-semibold">
                🗑️ Excluir Minha Conta
            </button>
        </form>
    </div>
@endsection
