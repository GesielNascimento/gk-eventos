@extends('layouts.dashboard')

@section('title', 'Painel do Usuário')

@section('content')
    <div class="space-y-8">

        <!-- Boas-vindas -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-2xl font-bold text-blue-900 mb-2">🎉 Bem-vindo, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-600">Este é o seu painel de controle. Aqui você poderá gerenciar seus eventos, inscrições e certificados.</p>
        </div>

        <!-- Cards de atalhos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Eventos -->
            <div class="bg-blue-100 text-blue-900 p-5 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-2">📅</div>
                <h4 class="font-bold text-lg">Eventos Criados</h4>
                <p class="text-sm">Gerencie seus eventos organizados.</p>
            </div>

            <!-- Inscrições -->
            <div class="bg-green-100 text-green-900 p-5 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-2">📝</div>
                <h4 class="font-bold text-lg">Minhas Inscrições</h4>
                <p class="text-sm">Veja em quais eventos você está participando.</p>
            </div>

            <!-- Certificados -->
            <div class="bg-yellow-100 text-yellow-900 p-5 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-2">📜</div>
                <h4 class="font-bold text-lg">Certificados</h4>
                <p class="text-sm">Baixe seus certificados digitais.</p>
            </div>
        </div>

        <!-- Rodapé -->
        <div class="text-center text-gray-500 text-sm mt-12">
            Sistema GK Eventos © {{ date('Y') }} — Todos os direitos reservados.
        </div>

    </div>
@endsection
