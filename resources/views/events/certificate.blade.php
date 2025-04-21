<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Participação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 60px;
            border: 12px solid #004aad;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #004aad;
        }

        .certificado {
            margin-top: 60px;
            font-size: 20px;
            line-height: 1.8;
        }

        .destaque {
            font-size: 26px;
            font-weight: bold;
            color: #111;
        }

        .footer {
            margin-top: 100px;
            text-align: center;
            font-size: 16px;
            color: #444;
        }

        .codigo {
            font-size: 14px;
            margin-top: 30px;
            color: #888;
        }

        .assinatura {
            margin-top: 60px;
            font-size: 18px;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 120px;
        }
    </style>
</head>
<body>

    {{-- Logotipo do sistema --}}
    <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">

    <h1>Certificado de Participação</h1>

    <div class="certificado">
        Certificamos que<br><span class="destaque">{{ $participant_name }}</span><br>
        participou do evento <strong>"{{ $event_title }}"</strong>, realizado no dia 
        {{ \Carbon\Carbon::parse($event_date)->format('d/m/Y') }}, com carga horária de 
        <strong>{{ $event_hours }} horas</strong>.
    </div>

    <div class="assinatura">
        _________________________________ <br>
        {{ $responsible_name }}<br>
        Organização do Evento
    </div>

    <div class="codigo">
        Código de Autenticação: {{ $auth_code }}
    </div>

    <div class="footer">
        GK Eventos • Sistema de Gestão de Eventos Automatizado
    </div>

</body>
</html>
