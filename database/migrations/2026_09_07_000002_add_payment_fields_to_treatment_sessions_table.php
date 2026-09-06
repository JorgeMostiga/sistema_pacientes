<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('notes');
            $table->foreignId('payment_receiver_id')->nullable()->after('payment_method')->constrained('payment_receivers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('treatment_sessions', function (Blueprint $table) {
            $table->dropForeign(['payment_receiver_id']);
            $table->dropColumn(['payment_method', 'payment_receiver_id']);
        });
    }
};