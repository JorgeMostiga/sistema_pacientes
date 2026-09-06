<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fernando Luis Móstiga Martin',
            'usuario' => 'fernando',
            'password' => Hash::make('123456789'),
            'role' => 'medico',
            // Nota: Si el modelo User no tiene un campo 'celular', 
            // este dato no podrá ser guardado directamente en la tabla users.
            // Si existe una tabla 'doctors', deberías crear el registro allí.
        ]);
    }
}
