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
        // Primero renombrar la columna temporalmente
        $table->renameColumn('no_control', 'no_control_old');
    });
    
    Schema::table('controls', function (Blueprint $table) {
        // Crear la nueva columna integer
        $table->integer('no_control')->default(0);
    });
    
    // Migrar los datos (opcional)
    DB::table('controls')->update([
        'no_control' => DB::raw('CASE WHEN no_control_old = true THEN 1 ELSE 0 END')
    ]);
    
    Schema::table('controls', function (Blueprint $table) {
        // Eliminar la columna temporal
        $table->dropColumn('no_control_old');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
