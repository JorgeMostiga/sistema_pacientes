<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\DashBoardController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\TreatmentController;
use App\Http\Controllers\Doctor\TreatmentSheetController;

use App\Http\Controllers\Doctor\SessionController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') return view('admin.dashboard');
    if (in_array($user->role, ['medico', 'licenciado'])) return app(DashBoardController::class)->index();
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


use App\Http\Controllers\Doctor\PdfController;

Route::middleware(['auth', 'role:medico,licenciado'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::resource('patients', PatientController::class);
    Route::get('patients/{patient}/ficha/create', [TreatmentSheetController::class, 'create'])->name('treatments.create');
    Route::post('patients/{patient}/ficha', [TreatmentSheetController::class, 'store'])->name('treatments.store');
    Route::get('ficha/{sheet}', [TreatmentController::class, 'show'])->name('treatments.show');
    Route::post('ficha/{sheet}/update-diagnosis', [TreatmentController::class, 'updateDiagnosis'])->name('treatments.updateDiagnosis');
    Route::post('ficha/{sheet}/sesion', [SessionController::class, 'store'])->name('sessions.store');
    Route::put('ficha/sesion/{session}', [SessionController::class, 'update'])->name('sessions.update');
    Route::get('ficha/{sheet}/pdf', [PdfController::class, 'download'])->name('treatments.pdf');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
