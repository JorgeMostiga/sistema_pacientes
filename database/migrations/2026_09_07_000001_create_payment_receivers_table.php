<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_receivers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la persona a quien se le paga
            $table->boolean('accepts_yape')->default(false);
            $table->boolean('accepts_plin')->default(false);
            $table->boolean('accepts_efectivo')->default(true);
            $table->string('phone_number')->nullable(); // Número de teléfono para Yape/Plin
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_receivers');
    }
};