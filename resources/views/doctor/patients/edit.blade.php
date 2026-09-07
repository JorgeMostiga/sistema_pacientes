@extends('layouts.doctor')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Regresar a la lista
        </a>
        <div class="card shadow-sm border-0 p-3 p-md-4">
            <h3 class="mb-4 h4">Editar Datos del Paciente</h3>
            <form action="{{ route('doctor.patients.update', $patient) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" name="names" class="form-control" value="{{ $patient->names }}" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Apellido Paterno</label>
                        <input type="text" name="paternal_surname" class="form-control" value="{{ $patient->paternal_surname }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Apellido Materno</label>
                        <input type="text" name="maternal_surname" class="form-control" value="{{ $patient->maternal_surname }}">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" value="{{ $patient->dni }}" maxlength="8" pattern="\d{8}" title="Debe tener 8 dígitos" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Celular</label>
                    <input type="tel" name="phone" class="form-control" value="{{ $patient->phone }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ $patient->birth_date }}">
                </div>
                <div class="mb-4">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ $patient->address }}">
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-check-circle me-2"></i>Actualizar Información
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
