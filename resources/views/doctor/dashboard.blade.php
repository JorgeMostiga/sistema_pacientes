@extends('layouts.doctor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="bg-white p-5 rounded shadow-sm border">
            <h2 class="text-secondary">Bienvenido, Doctor</h2>
            <p class="lead">Gestione sus fichas de tratamiento y pacientes aquí.</p>
        <div class="mt-4">
            <a href="{{ route('doctor.patients.index') }}" class="btn btn-primary px-4">Ver Pacientes</a>
            <a href="{{ route('doctor.patients.create') }}" class="btn btn-outline-secondary px-4">Nuevo Paciente</a>
        </div>
        </div>
    </div>
</div>
@endsection
