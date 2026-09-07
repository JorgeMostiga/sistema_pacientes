<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; font-weight: bold; font-size: 20px; margin-bottom: 25px; color: #000; }
        .info-box { margin-bottom: 25px; line-height: 1.6; font-size: 13px; }
        .info-box strong { color: #000; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f0f0f0; border: 1px solid #999; padding: 6px 4px; text-align: center; font-size: 11px; }
        td { border: 1px solid #ccc; padding: 6px 4px; text-align: center; font-size: 12px; }
        .month-label { text-align: left !important; font-weight: bold; padding-left: 8px !important; background-color: #fafafa; }
        .attended-day { background-color: #e8f4f8; font-weight: bold; color: #0056b3; }
        
        .detail-section { margin-top: 30px; }
        .detail-section h3 { border-bottom: 2px solid #333; padding-bottom: 5px; margin-bottom: 15px; font-size: 16px; }
        .month-group { margin-top: 20px; margin-bottom: 15px; }
        .month-header { 
            background-color: #f8f9fa; 
            padding: 8px 12px; 
            border-left: 5px solid #007bff; 
            font-size: 15px; 
            font-weight: bold; 
            color: #000;
            margin-bottom: 0;
        }
        .detail-table { width: 100%; margin-top: 0; }
        .detail-table td { 
            border: none; 
            border-bottom: 1px solid #ddd; 
            padding: 10px 8px; 
            text-align: left; 
            font-size: 13px;
            vertical-align: top;
        }
        .date-cell { width: 35%; font-weight: bold; color: #333; }
        .notes-cell { width: 65%; line-height: 1.5; }
        .payment-info { color: #d9534f; font-weight: bold; margin-top: 4px; display: block; }
    </style>
</head>
<body>
    <div class="header">CLINICA SACITEB - FICHA DE TRATAMIENTO</div>
    
    <div class="info-box">
        <strong>Paciente:</strong> {{ $sheet->patient->names }} {{ $sheet->patient->paternal_surname }} {{ $sheet->patient->maternal_surname }}<br>
        <strong>DNI:</strong> {{ $sheet->patient->dni }} &nbsp;|&nbsp; <strong>Celular:</strong> {{ $sheet->patient->phone }} &nbsp;|&nbsp; <strong>Edad:</strong> {{ $sheet->patient->birth_date ? \Carbon\Carbon::parse($sheet->patient->birth_date)->age : 'N/A' }} años<br>
        <strong>Dirección:</strong> {{ $sheet->patient->address }}<br>
        <strong>Diagnóstico:</strong> {{ $sheet->diagnosis ?: 'No especificado' }}
    </div>

    @php
        $monthNames = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        
        // Agrupar sesiones por mes y año para la tabla
        $sessionsByMonth = $sheet->sessions->groupBy(function($s) use ($monthNames) {
            return ($monthNames[$s->month] ?? 'Mes') . ' ' . $s->year;
        });
        
        // Ordenar los meses cronológicamente
        $sortedMonths = $sessionsByMonth->sortKeysUsing(function($a, $b) use ($sheet) {
            // Extraer año y mes para comparar
            $partsA = explode(' ', $a);
            $partsB = explode(' ', $b);
            $yearA = (int)($partsA[1] ?? 0);
            $yearB = (int)($partsB[1] ?? 0);
            if ($yearA !== $yearB) return $yearA <=> $yearB;
            
            $monthA = array_search($partsA[0], $monthNames);
            $monthB = array_search($partsB[0], $monthNames);
            return $monthA <=> $monthB;
        });
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width: 18%; text-align: left; padding-left: 8px;">MES</th>
                @for($i=1; $i<=31; $i++)
                    <th style="width: 2.6%;">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach($sortedMonths as $monthYear => $sessions)
                <tr>
                    <td class="month-label">{{ $monthYear }}</td>
                    @for($i=1; $i<=31; $i++)
                        @php
                            $hasSession = $sessions->contains('day', $i);
                        @endphp
                        <td class="{{ $hasSession ? 'attended-day' : '' }}">
                            {{ $hasSession ? 'X' : '' }}
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="detail-section">
        <h3>Detalle de Atenciones</h3>
        
        @php
            // Agrupar para el detalle, ordenado del más reciente al más antiguo
            $sessionsByMonthDetail = $sheet->sessions->sortByDesc(function($s) {
                return $s->year . str_pad($s->month, 2, '0', STR_PAD_LEFT);
            })->groupBy(function($s) use ($monthNames) {
                return ($monthNames[$s->month] ?? 'Mes') . ' ' . $s->year;
            });
        @endphp

        @foreach($sessionsByMonthDetail as $monthYear => $sessions)
            <div class="month-group">
                <h4 class="month-header">{{ strtoupper($monthYear) }}</h4>
                <table class="detail-table">
                    @foreach($sessions->sortByDesc('day') as $s)
                        @php
                            $dateString = $s->day . ' de ' . ($monthNames[$s->month] ?? 'Mes') . ' de ' . $s->year;
                        @endphp
                        <tr>
                            <td class="date-cell">{{ $dateString }}</td>
                            <td class="notes-cell">
                                {{ $s->notes ?: 'Sin observaciones' }}
                                @if($s->payment_details)
                                    <span class="payment-info">💰 Pago: {{ $s->payment_details }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
</body>
</html>