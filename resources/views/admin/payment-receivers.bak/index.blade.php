@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Receptores de Pago</h2>
        <a href="{{ route('admin.payment-receivers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Receptor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Métodos Aceptados</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receivers as $receiver)
                            <tr>
                                <td class="fw-bold">{{ $receiver->name }}</td>
                                <td>{{ $receiver->phone_number ?? 'N/A' }}</td>
                                <td>
                                    @if($receiver->accepts_yape) <span class="badge bg-purple text-white">Yape</span> @endif
                                    @if($receiver->accepts_plin) <span class="badge bg-info text-dark">Plin</span> @endif
                                    @if($receiver->accepts_efectivo) <span class="badge bg-success">Efectivo</span> @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.payment-receivers.edit', $receiver) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.payment-receivers.destroy', $receiver) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este receptor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay receptores de pago registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $receivers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .bg-purple { background-color: #7c3aed; }
</style>