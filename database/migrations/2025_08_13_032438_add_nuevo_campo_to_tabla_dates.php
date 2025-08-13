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
        Schema::table('dates', function (Blueprint $table) {

            $table->enum('status', ['Programada', 'Confirmada', 'Completada', 'Cancelada', 'No asistió'])->default('Programada');
  


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dates', function (Blueprint $table) {
            //
        });
    }
};
