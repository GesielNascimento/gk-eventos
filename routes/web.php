<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\CategoryController; // ✅ Importado para rotas de categoria

// ✅ Página inicial leva aos eventos públicos
Route::get('/', [PublicEventController::class, 'index'])->name('home');

// 🔐 Rotas protegidas (requer login)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Eventos (CRUD)
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Inscrições e exportações
    Route::get('/events/{id}/registrations', [EventController::class, 'registrationsList'])->name('events.registrations');
    Route::get('/events/{id}/registrations/export', [EventController::class, 'exportRegistrationsPdf'])->name('events.registrations.export');
    Route::post('/events/{id}/registrations/mark-presence', [EventController::class, 'markPresence'])->name('events.registrations.markPresence');

    // Certificado (se presença confirmada)
    Route::get('/events/{id}/certificate', [EventController::class, 'generateCertificate'])->name('events.certificate');

    // Minhas inscrições
    Route::get('/my-registrations', [EventController::class, 'myRegistrations'])->name('events.my');

    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🌐 Rotas públicas (sem login)
Route::get('/public-events', [PublicEventController::class, 'index'])->name('public.events');
Route::get('/public-events/{id}', [PublicEventController::class, 'show'])->name('public.events.show');

// 📌 Listagem e detalhes de eventos
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/register', [EventController::class, 'register'])->middleware(['auth'])->name('events.register');

// 🏛️ Páginas Institucionais
Route::view('/quem-somos', 'institucional.quem-somos')->name('institucional.quem-somos');
Route::view('/nossa-missao', 'institucional.nossa-missao')->name('institucional.nossa-missao');
Route::view('/contato', 'institucional.contato')->name('institucional.contato');

// ✅ Rota correta com nome esperado na navbar
Route::get('/categorias/{slug}', [CategoryController::class, 'showBySlug'])->name('categories.showBySlug');

// 🔐 Rotas de autenticação
require __DIR__ . '/auth.php';
