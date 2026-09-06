@extends('layouts.doctor')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="bi bi-arrow-left"></i> Regresar al Panel
            </a>
            <h2 class="mb-0">Pacientes</h2>
        </div>
        <a href="{{ route('doctor.patients.create') }}" class="btn btn-primary btn-lg">+ Nuevo Paciente</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th>Edad</th>
                        <th>Direccion</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->names }} {{ $patient->paternal_surname }} {{ $patient->maternal_surname }}</td>
                            <td>{{ $patient->dni }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age : 'N/A' }}</td>
                            <td>{{ $patient->address }}</td>
                            <td class="text-center">
                                <a href="{{ route('doctor.patients.edit', $patient) }}"
                                    class="btn btn-outline-warning btn-sm">Editar</a>

                                @if ($patient->treatmentSheets->count() > 0)
                                    {{-- Si tiene ficha, enviamos el ID de la primera ficha (la actual) --}}
                                    <a href="{{ route('doctor.treatments.show', $patient->treatmentSheets->first()->id) }}"
                                        class="btn btn-outline-success btn-sm">Ver Ficha</a>
                                @else
                                    {{-- Si no tiene, lo enviamos a crearla --}}
                                    <a href="{{ route('doctor.treatments.create', $patient) }}"
                                        class="btn btn-outline-primary btn-sm">Nueva Ficha</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
