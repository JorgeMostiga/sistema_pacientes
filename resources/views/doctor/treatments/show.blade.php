@extends('layouts.doctor')

@section('content')
<div class="container py-3 py-md-4">
    <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left"></i> Regresar a la lista
    </a>
    <div class="row g-4">
        <!-- Panel de Diagnóstico -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3 h6">Diagnóstico Médico</h5>
                    <div id="view-diagnosis">
                        <p class="p-3 bg-light rounded small">{{ $sheet->diagnosis }}</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-warning btn-sm" onclick="toggleEdit()">
                                <i class="bi bi-pencil"></i> Editar Diagnóstico
                            </button>
                            <a href="{{ route('doctor.treatments.pdf', $sheet) }}" class="btn btn-danger btn-sm" target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> Descargar PDF Oficial
                            </a>
                        </div>
                    </div>
                    <form id="edit-diagnosis" action="{{ route('doctor.treatments.updateDiagnosis', $sheet) }}" method="POST" style="display:none;">
                        @csrf
                        <textarea name="diagnosis" class="form-control mb-2" rows="5">{{ $sheet->diagnosis }}</textarea>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-sm">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEdit()">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Historial de Atenciones -->
        <div class="col-12 col-lg-8">
            <button class="btn btn-primary btn-lg w-100 mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalSesion">
                <i class="bi bi-plus-lg"></i> Registrar nueva atención
            </button>

            @foreach($sheet->sessions->groupBy(fn($s) => $s->month . '-' . $s->year) as $monthYear => $sessions)
                @php [$m, $y] = explode('-', $monthYear); @endphp
                <h5 class="mt-4 text-secondary border-bottom pb-2 h6">{{ \Carbon\Carbon::create($y, $m)->isoFormat('MMMM YYYY') }}</h5>
                @foreach($sessions as $session)
                    <div class="card mb-3 shadow-sm border-0 border-start border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <h6 class="text-muted mb-0">{{ \Carbon\Carbon::create($session->year, $session->month, $session->day)->isoFormat('LL') }}</h6>
                            </div>
                            <p class="mt-2 mb-2 small" id="text-{{$session->id}}">{{ $session->notes }}</p>
                            
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
                                
                                <div class="d-grid gap-2 d-sm-flex">
                                    <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('edit-session-{{$session->id}}').style.display='none'; this.parentElement.previousElementSibling.previousElementSibling.style.display='inline-block'">Cancelar</button>
                                </div>
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
        const view = document.getElementById('view-diagnosis');
        const edit = document.getElementById('edit-diagnosis');
        view.style.display = view.style.display === 'none' ? 'block' : 'none';
        edit.style.display = edit.style.display === 'none' ? 'block' : 'none';
    }
</script>

<div class="modal fade" id="modalSesion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('doctor.sessions.store', $sheet) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title h6">Nueva Atención</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label class="form-label fw-bold">Detalle del Tratamiento:</label>
                <textarea name="notes" class="form-control mb-3" placeholder="Ej: Se le hizo una serie de ejercicios..." required rows="4"></textarea>
                
                <label class="form-label fw-bold">Detalles del Pago (Opcional):</label>
                <textarea name="payment_details" class="form-control" placeholder="Ej: El paciente pagó en efectivo..." rows="3"></textarea>
                <div class="form-text text-muted small">Método usado (Yape, Plin, Efectivo) u observaciones sobre el cobro.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-sm">Registrar Atención</button>
            </div>
        </form>
    </div>
</div>
@endsection
