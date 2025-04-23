<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // 👈🏽 Carrega as categorias
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // ✅ validação da categoria
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['banner_path'] = $request->file('banner')->store('banners', 'public');

        Event::create($validated);

        return redirect()->route('events.create')->with('success', 'Evento cadastrado com sucesso!');
    }

    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', [
            'event' => $event,
            'header' => 'Detalhes do Evento: ' . $event->title
        ]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        $categories = Category::all(); // 👈🏽 também carrega as categorias para edição
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner_path'] = $request->file('banner')->store('banners', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir este evento.');
        }

        if ($event->banner_path && Storage::disk('public')->exists($event->banner_path)) {
            Storage::disk('public')->delete($event->banner_path);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }

    public function register($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        if ($user->registrations()->where('event_id', $event->id)->exists()) {
            return redirect()->back()->with('warning', 'Você já está inscrito neste evento.');
        }

        $user->registrations()->create([
            'event_id' => $event->id
        ]);

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    public function myRegistrations()
    {
        $registrations = auth()->user()->registrations()->with('event')->latest()->get();
        return view('events.my-registrations', compact('registrations'));
    }

    public function registrationsList($id)
    {
        $event = Event::with('registrations.user')->findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para ver os inscritos deste evento.');
        }

        $registrations = $event->registrations;

        return view('events.registrations-list', [
            'event' => $event,
            'registrations' => $registrations,
            'header' => 'Inscrições de: ' . $event->title
        ]);
    }

    public function exportRegistrationsPdf($id)
    {
        $event = Event::with('registrations.user')->findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para exportar os inscritos deste evento.');
        }

        $pdf = Pdf::loadView('events.pdf-registrations', compact('event'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('inscritos-evento-' . $event->id . '.pdf');
    }

    public function markPresence(Request $request, $id)
    {
        $event = Event::with('registrations')->findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para alterar os inscritos deste evento.');
        }

        $presentIds = $request->input('present', []);

        foreach ($event->registrations as $registration) {
            $registration->present = array_key_exists($registration->id, $presentIds);
            $registration->save();
        }

        return redirect()->route('events.registrations', $event->id)
                         ->with('success', 'Presenças atualizadas com sucesso!');
    }

    public function generateCertificate($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        $registration = Registration::where('event_id', $event->id)
                                     ->where('user_id', $user->id)
                                     ->where('present', true)
                                     ->first();

        if (!$registration) {
            return redirect()->route('dashboard')->with('warning', 'Você não participou ou ainda não teve sua presença confirmada neste evento.');
        }

        $pdf = Pdf::loadView('events.certificate', [
            'participant_name' => strtoupper($user->name),
            'event_title' => $event->title,
            'event_date' => $event->event_date,
            'event_hours' => 8,
            'responsible_name' => 'Fulano de Tal',
            'auth_code' => strtoupper(uniqid('GK-')),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('certificado-' . $event->id . '-' . $user->id . '.pdf');
    }
}
