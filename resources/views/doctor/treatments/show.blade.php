@extends('layouts.doctor')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Panel de Diagnóstico -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">Diagnóstico Médico</h5>
                    <div id="view-diagnosis">
                        <p class="p-3 bg-light rounded">{{ $sheet->diagnosis }}</p>
                        <button class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="toggleEdit()">Editar Diagnóstico</button>
                        <a href="{{ route('doctor.treatments.pdf', $sheet) }}" class="btn btn-danger w-100" target="_blank">
                            Descargar PDF Oficial
                        </a>
                    </div>
                    <form id="edit-diagnosis" action="{{ route('doctor.treatments.updateDiagnosis', $sheet) }}" method="POST" style="display:none;">
                        @csrf
                        <textarea name="diagnosis" class="form-control mb-2" rows="5">{{ $sheet->diagnosis }}</textarea>
                        <button type="submit" class="btn btn-warning btn-sm w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Historial de Atenciones -->
        <div class="col-lg-8">
            <button class="btn btn-primary btn-lg w-100 mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalSesion">
                <i class="bi bi-plus-lg"></i> Registrar nueva atención para hoy
            </button>

            @foreach($sheet->sessions as $session)
                <div class="card mb-3 shadow-sm border-0 border-start border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="text-muted">{{ \Carbon\Carbon::create($session->year, $session->month, $session->day)->isoFormat('LL') }}</h6>
                            <span class="badge bg-light text-dark border">{{ strtoupper($session->payment_method) }}</span>
                        </div>
                        <p class="mt-2 mb-2" id="text-{{$session->id}}">{{ $session->notes }}</p>
                        
                        <form action="{{ route('doctor.sessions.update', $session) }}" method="POST" id="edit-session-{{$session->id}}" style="display:none;">
                            @csrf @method('PUT')
                            <textarea name="notes" class="form-control mb-2">{{ $session->notes }}</textarea>
                            <button class="btn btn-success btn-sm">Guardar</button>
                        </form>
                        <button class="btn btn-link btn-sm text-decoration-none" onclick="document.getElementById('edit-session-{{$session->id}}').style.display='block'; this.style.display='none'">Editar nota</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        document.getElementById('view-diagnosis').style.display = 'none';
        document.getElementById('edit-diagnosis').style.display = 'block';
    }
</script>

<div class="modal fade" id="modalSesion" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('doctor.sessions.store', $sheet) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white"><h5 class="modal-title">Nueva Atención</h5></div>
            <div class="modal-body">
                <textarea name="notes" class="form-control mb-3" placeholder="Detalle del tratamiento..." required rows="4"></textarea>
                <label>Método de Pago:</label>
                <select name="payment_method" class="form-select" required>
                    <option value="efectivo">Efectivo</option>
                    <option value="yape">Yape</option>
                    <option value="plin">Plin</option>
                    <option value="tarjeta">Tarjeta</option>
                </select>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Registrar</button></div>
        </form>
    </div>
</div>
@endsection
