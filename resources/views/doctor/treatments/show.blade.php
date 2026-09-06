@extends('layouts.doctor')

@section('content')
<div class="container py-4">
    <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left"></i> Regresar a la lista de pacientes
    </a>
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

            @foreach($sheet->sessions->groupBy(fn($s) => $s->month . '-' . $s->year) as $monthYear => $sessions)
                @php [$m, $y] = explode('-', $monthYear); @endphp
                <h5 class="mt-4 text-secondary border-bottom pb-2">{{ \Carbon\Carbon::create($y, $m)->isoFormat('MMMM YYYY') }}</h5>
                @foreach($sessions as $session)
                    <div class="card mb-3 shadow-sm border-0 border-start border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-muted">{{ \Carbon\Carbon::create($session->year, $session->month, $session->day)->isoFormat('LL') }}</h6>
                            </div>
                            <p class="mt-2 mb-2" id="text-{{$session->id}}">{{ $session->notes }}</p>
                            
                            @if($session->payment_details)
                                <div class="alert alert-light border-start border-warning border-3 p-2 mt-2">
                                    <small class="text-muted d-block fw-bold mb-1">Detalles del Pago:</small>
                                    <small class="text-dark">{{ $session->payment_details }}</small>
                                </div>
                            @endif

                            <button class="btn btn-link btn-sm text-decoration-none p-0 mt-2" onclick="document.getElementById('edit-session-{{$session->id}}').style.display='block'; this.style.display='none'">
                                <i class="bi bi-pencil"></i> Editar nota y pago
                            </button>

                            <form action="{{ route('doctor.sessions.update', $session) }}" method="POST" id="edit-session-{{$session->id}}" style="display:none;" class="mt-2">
                                @csrf @method('PUT')
                                <label class="form-label fw-bold small">Nota de la sesión:</label>
                                <textarea name="notes" class="form-control mb-2" rows="3">{{ $session->notes }}</textarea>
                                
                                <label class="form-label fw-bold small">Detalles del Pago:</label>
                                <textarea name="payment_details" class="form-control mb-2" rows="2" placeholder="Ej: Pago en efectivo a Daniel...">{{ $session->payment_details }}</textarea>
                                
                                <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('edit-session-{{$session->id}}').style.display='none'; this.parentElement.previousElementSibling.style.display='inline-block'">Cancelar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
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
                <label class="form-label fw-bold">Detalle del Tratamiento:</label>
                <textarea name="notes" class="form-control mb-3" placeholder="Ej: Se le hizo una serie de ejercicios para el tratamiento de la lumbalgia..." required rows="4"></textarea>
                
                <label class="form-label fw-bold">Detalles del Pago (Opcional):</label>
                <textarea name="payment_details" class="form-control" placeholder="Ej: El paciente pagó en efectivo directamente al doctor. O: Se pagó por Yape a Juan Pérez al número 999-999-999." rows="3"></textarea>
                <div class="form-text text-muted">Aquí puedes especificar a quién se le pagó, el método usado (Yape, Plin, Efectivo) o cualquier otra observación sobre el cobro.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar Atención</button>
            </div>
        </form>
    </div>
</div>
@endsection
