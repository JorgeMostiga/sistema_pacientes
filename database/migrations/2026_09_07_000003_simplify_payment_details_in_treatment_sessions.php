<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            // Agregamos el campo de texto libre para detalles de pago
            if (!Schema::hasColumn('treatment_sessions', 'payment_details')) {
                $table->text('payment_details')->nullable()->after('notes');
            }
            
            // Limpiamos columnas antiguas si existen
            if (Schema::hasColumn('treatment_sessions', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
            if (Schema::hasColumn('treatment_sessions', 'payment_receiver_id')) {
                $table->dropForeign(['payment_receiver_id']);
                $table->dropColumn('payment_receiver_id');
            }
        });

        // Eliminamos la tabla de receptores si existe
        if (Schema::hasTable('payment_receivers')) {
            Schema::dropIfExists('payment_receivers');
        }
    }

    public function down(): void
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            if (Schema::hasColumn('treatment_sessions', 'payment_details')) {
                $table->dropColumn('payment_details');
            }
        });
    }
};
