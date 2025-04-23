<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PublicEventController extends Controller
{
    // Página de eventos públicos (com busca)
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::where('is_public', true)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('public-events.index', compact('events'));
    }

    // Detalhes do evento público
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('public-events.show', compact('event'));
    }
}
