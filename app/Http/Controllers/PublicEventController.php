<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PublicEventController extends Controller
{
    // Página de eventos públicos (com novo layout)
    public function index()
    {
        $events = Event::where('is_public', true)->latest()->get();
        return view('public-events.index', compact('events')); // ← aqui está a correção
    }

    // Detalhes do evento público
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('public-events.show', compact('event')); // ← nomeie como quiser (vamos criar a view depois)
    }
}