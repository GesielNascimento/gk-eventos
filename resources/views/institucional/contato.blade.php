@extends('layouts.public')

@section('title', 'Contato')

@section('content')
    <section class="max-w-4xl mx-auto mt-8 mb-12 text-center">
        <h1 class="text-3xl font-bold text-blue-900 mb-4">Fale Conosco</h1>
        <p class="text-gray-700 text-lg mb-6">
            Se você deseja tirar dúvidas, dar sugestões, relatar algum problema ou apenas nos enviar uma mensagem de apoio, estaremos felizes em ouvir você.
        </p>

        <div class="grid gap-6 text-left">
        <div class="flex flex-col md:flex-row justify-center items-stretch gap-6 text-left mt-8">
    <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-1/3">
        <h3 class="text-xl font-semibold text-blue-900 mb-2">📧 E-mail</h3>
        <p class="text-gray-700">contato@gkeventos.com</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-1/3">
        <h3 class="text-xl font-semibold text-blue-900 mb-2">📱 WhatsApp</h3>
        <p class="text-gray-700">(96) 9XXXX-XXXX</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-1/3">
        <h3 class="text-xl font-semibold text-blue-900 mb-2">📍 Endereço</h3>
        <p class="text-gray-700">Afuá - Pará, Brasil</p>
    </div>
</div>

    </section>
@endsection
