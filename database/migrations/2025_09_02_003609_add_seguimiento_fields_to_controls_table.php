<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('controls', function (Blueprint $table) {
            $table->boolean('necesita_seguimiento')->default(false);
            $table->boolean('seguimiento_completado')->default(false);
            $table->date('fecha_ultimo_seguimiento')->nullable();
            $table->date('fecha_proximo_seguimiento')->nullable();
            $table->text('observaciones_seguimiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('controls', function (Blueprint $table) {
            $table->dropColumn([
                'necesita_seguimiento',
                'seguimiento_completado',
                'fecha_ultimo_seguimiento',
                'fecha_proximo_seguimiento',
                'observaciones_seguimiento'
            ]);
        });
    }
};
