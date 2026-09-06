<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        .info-box { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">CLINICA SACITEB - FICHA DE TRATAMIENTO</div>
    <div class="info-box">
        <strong>Paciente:</strong> {{ $sheet->patient->names }} {{ $sheet->patient->paternal_surname }} {{ $sheet->patient->maternal_surname }}<br>
        <strong>DNI:</strong> {{ $sheet->patient->dni }} | <strong>Celular:</strong> {{ $sheet->patient->phone }} | <strong>Edad:</strong> {{ $sheet->patient->birth_date ? \Carbon\Carbon::parse($sheet->patient->birth_date)->age : 'N/A' }}<br>
        <strong>Dirección:</strong> {{ $sheet->patient->address }}<br>
        <strong>Diagnóstico:</strong> {{ $sheet->diagnosis }}
    </div>
    <table>
        <thead>
            <tr><th>MES/DIA</th> @for($i=1; $i<=31; $i++) <th>{{ $i }}</th> @endfor </tr>
        </thead>
        <tbody>
            <tr>
                <td>Atención</td>
                @for($i=1; $i<=31; $i++)
                    <td>{{ $sheet->sessions->where('day', $i)->count() > 0 ? 'X' : '' }}</td>
                @endfor
            </tr>
        </tbody>
    </table>
    <h3>Detalle de Atenciones</h3>
    <ul style="list-style-type: none; padding-left: 0;">
        @foreach($sheet->sessions->sortByDesc(fn($s) => $s->year . $s->month . $s->day) as $s)
            <li style="margin-bottom: 10px; padding: 8px; border-bottom: 1px solid #eee;">
                <strong>Fecha:</strong> {{ $s->day }}/{{ $s->month }}/{{ $s->year }}<br>
                <strong>Tratamiento:</strong> {{ $s->notes }}
                @if($s->payment_details)
                    <br><strong style="color: #d9534f;">Detalles del Pago:</strong> {{ $s->payment_details }}
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
