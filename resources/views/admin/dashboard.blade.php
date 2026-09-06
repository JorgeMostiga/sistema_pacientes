@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <h1>Bienvenido, Admin</h1>
            <p>Selecciona una opción del menú superior para comenzar a gestionar el sistema.</p>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Gestionar Usuarios</h5>
                            <p class="card-text">Crea, edita o elimina usuarios del sistema (Doctores, Admins, etc.).</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Ir a Usuarios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
