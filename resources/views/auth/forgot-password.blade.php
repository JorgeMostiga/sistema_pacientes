@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm p-4">
            <h3 class="text-center mb-4">Recuperar Contraseña</h3>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email asociado</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar enlace de reseteo</button>
            </form>
        </div>
    </div>
</div>
@endsection
