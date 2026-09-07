@extends('layouts.doctor')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
         <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Regresar a la lista
        </a>
        <div class="card shadow-sm border-0 p-4">
            <h3 class="mb-4">Nueva Ficha: {{ $patient->names }}</h3>
            <form action="{{ route('doctor.treatments.store', $patient) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Diagnóstico</label>
                    <textarea name="diagnosis" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Método de Pago</label>
                    <select name="payment_method" class="form-select">
                        <option value="efectivo">Efectivo</option>
                        <option value="yape">Yape</option>
                        <option value="plin">Plin</option>
                        <option value="tarjeta">Tarjeta</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">Crear Ficha</button>
            </form>
        </div>
    </div>
</div>
@endsection
