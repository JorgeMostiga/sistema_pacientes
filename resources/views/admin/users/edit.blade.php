@extends('layouts.admin')

@section('content')
<div class="card p-4">
    <h3>Editar Usuario</h3>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" value="{{ $user->usuario }}" required>
            @error('usuario')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="role" class="form-control">
                <option value="paciente" {{ $user->role == 'paciente' ? 'selected' : '' }}>Paciente</option>
                <option value="medico" {{ $user->role == 'medico' ? 'selected' : '' }}>Médico</option>
                <option value="licenciado" {{ $user->role == 'licenciado' ? 'selected' : '' }}>Licenciado</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
