@extends('layouts.doctor')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="bg-white p-3 p-md-5 rounded shadow-sm border text-center text-md-start">
            <h2 class="text-secondary h3 h-md-2">Bienvenido, Doctor</h2>
            <p class="lead fs-6 fs-md-5">Gestione sus fichas de tratamiento y pacientes aquí.</p>
            <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('doctor.patients.index') }}" class="btn btn-primary px-4">
                    <i class="bi bi-people-fill me-2"></i>Ver Pacientes
                </a>
                <a href="{{ route('doctor.patients.create') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-person-plus-fill me-2"></i>Nuevo Paciente
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
