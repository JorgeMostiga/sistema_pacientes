@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Registrar Nuevo Receptor de Pago</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment-receivers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label fw-bold">Número de Teléfono (para Yape/Plin)</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Métodos de Pago Aceptados</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="accepts_yape" id="accepts_yape" value="1" {{ old('accepts_yape') ? 'checked' : '' }}>
                                <label class="form-check-label" for="accepts_yape">Yape</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="accepts_plin" id="accepts_plin" value="1" {{ old('accepts_plin') ? 'checked' : '' }}>
                                <label class="form-check-label" for="accepts_plin">Plin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="accepts_efectivo" id="accepts_efectivo" value="1" {{ old('accepts_efectivo', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="accepts_efectivo">Efectivo</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold">Notas Adicionales</label>
                            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.payment-receivers.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Receptor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection