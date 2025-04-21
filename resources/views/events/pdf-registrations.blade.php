<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscritos - {{ $event->title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .title { text-align: center; font-size: 18px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="title">
        Lista de Inscritos<br>
        Evento: {{ $event->title }}<br>
        Data: {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} às {{ $event->event_time }}<br>
        Local: {{ $event->location }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Inscrição</th>
                <th>Assinatura</th> {{-- Espaço para marcar presença --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($event->registrations as $registration)
                <tr>
                    <td>{{ $registration->user->name }}</td>
                    <td>{{ $registration->user->email }}</td>
                    <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                    <td></td> {{-- Espaço vazio para assinatura --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
