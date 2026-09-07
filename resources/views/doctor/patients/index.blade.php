@extends('layouts.doctor')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm mb-2 mb-md-0">
                <i class="bi bi-arrow-left"></i> Regresar al Panel
            </a>
            <h2 class="mb-0 h3 h-md-2">Pacientes</h2>
        </div>
        <a href="{{ route('doctor.patients.create') }}" class="btn btn-primary btn-lg w-100 w-md-auto">
            <i class="bi bi-person-plus-fill me-2"></i>Nuevo Paciente
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>DNI</th>
                        <th class="d-none d-md-table-cell">Celular</th>
                        <th class="d-none d-sm-table-cell">Edad</th>
                        <th class="d-none d-lg-table-cell">Direccion</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $patient->names }} {{ $patient->paternal_surname }}</div>
                                <small class="text-muted d-md-none">{{ $patient->phone }}</small>
                            </td>
                            <td>{{ $patient->dni }}</td>
                            <td class="d-none d-md-table-cell">{{ $patient->phone }}</td>
                            <td class="d-none d-sm-table-cell">{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age : 'N/A' }}</td>
                            <td class="d-none d-lg-table-cell">{{ $patient->address }}</td>
                            <td class="text-center">
                                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                    <a href="{{ route('doctor.patients.edit', $patient) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
                                    </a>

                                    @if ($patient->treatmentSheets->count() > 0)
                                        <a href="{{ route('doctor.treatments.show', $patient->treatmentSheets->first()->id) }}"
                                            class="btn btn-outline-success btn-sm">
                                            <i class="bi bi-file-earmark-medical"></i> <span class="d-none d-sm-inline">Ver Ficha</span>
                                        </a>
                                    @else
                                        <a href="{{ route('doctor.treatments.create', $patient) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-plus-circle"></i> <span class="d-none d-sm-inline">Nueva Ficha</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
