<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #fff;
            padding: 40px;
            text-align: center;
        }
        .certificado {
            border: 8px double #0b3d91;
            padding: 60px 40px;
        }
        h1 {
            font-size: 36px;
            color: #0b3d91;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 24px;
            margin: 20px 0;
        }
        .nome {
            font-size: 28px;
            font-weight: bold;
            margin-top: 30px;
            color: #222;
        }
        .evento {
            font-size: 20px;
            margin-top: 10px;
        }
        .data {
            margin-top: 40px;
            font-size: 14px;
        }
        .assinatura {
            margin-top: 60px;
            text-align: center;
        }
        .linha {
            border-top: 1px solid #000;
            width: 200px;
            margin: 0 auto;
        }
        .responsavel {
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="certificado">
        <h1>Certificado de Participação</h1>
        <p>Conferimos o presente certificado a:</p>

        <div class="nome">{{ $user->name }}</div>

        <div class="evento">
            pela sua participação no evento<br>
            <strong>{{ $event->title }}</strong><br>
            realizado em {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }},
            com carga horária de {{ $event->duration ?? '8' }} horas.
        </div>

        <div class="data">
            Emitido em {{ now()->format('d/m/Y') }}
        </div>

        <div class="assinatura">
            <div class="linha"></div>
            <div class="responsavel">Coordenação do GK Eventos</div>
        </div>
    </div>
</body>
</html>
