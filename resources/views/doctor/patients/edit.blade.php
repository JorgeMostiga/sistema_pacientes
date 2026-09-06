@extends('layouts.doctor')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 p-4">
            <h3 class="mb-4">Editar Datos del Paciente</h3>
            <form action="{{ route('doctor.patients.update', $patient) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" name="names" class="form-control form-control-lg" value="{{ $patient->names }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido Paterno</label>
                        <input type="text" name="paternal_surname" class="form-control form-control-lg" value="{{ $patient->paternal_surname }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido Materno</label>
                        <input type="text" name="maternal_surname" class="form-control form-control-lg" value="{{ $patient->maternal_surname }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control form-control-lg" value="{{ $patient->dni }}" maxlength="8" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Celular</label>
                    <input type="text" name="phone" class="form-control form-control-lg" value="{{ $patient->phone }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" class="form-control form-control-lg" value="{{ $patient->birth_date }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="address" class="form-control form-control-lg" value="{{ $patient->address }}">
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">Actualizar Información</button>
            </form>
        </div>
    </div>
</div>
@endsection
