@extends('layouts.doctor')

@section('content')
<div class="bg-white p-4 rounded shadow-sm border">
    <h3 class="text-primary mb-4 border-bottom pb-2">Ficha de Tratamiento: {{ $patient->names }} {{ $patient->paternal_surname }}</h3>
    
    <div class="row mb-4">
        <div class="col-md-4"><strong>DNI:</strong> {{ $patient->dni }}</div>
        <div class="col-md-4"><strong>Celular:</strong> {{ $patient->phone }}</div>
        <div class="col-md-4"><strong>Edad:</strong> {{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age : 'N/A' }}</div>
    </div>

    <!-- AQUÍ IRÍA LA CUADRÍCULA -->
    <div class="table-responsive">
        <table class="table table-bordered border-dark text-center">
            <thead class="table-light">
                <tr>
                    <th>Tratamiento</th>
                    @for($i=1; $i<=31; $i++) <th style="width: 30px;">{{ $i }}</th> @endfor
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start">Ejemplo de Terapia</td>
                    @for($i=1; $i<=31; $i++)
                        <td><input type="checkbox" class="form-check-input"></td>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-end">
        <button class="btn btn-lg btn-success">Guardar Avance del Mes</button>
    </div>
</div>
@endsection
