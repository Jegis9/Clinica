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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('registro_no')->unique()->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('pueblo')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('nombre_esposo')->nullable();
            $table->string('pueblo_esposo')->nullable();
            $table->string('escolaridad_esposo')->nullable();
            $table->string('ocupacion_esposo')->nullable();
            $table->enum('estado_civil', ['soltera', 'casada', 'union_libre', 'divorciada', 'viuda'])->nullable();
            $table->decimal('distancia_servicio_salud_km', 8, 2)->nullable();
            $table->decimal('tiempo_servicio_salud_hrs', 4, 2)->nullable();
            $table->string('nombre_comunidad')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->date('fecha_ultima_regla')->nullable();
            $table->date('fpp')->nullable();
            $table->integer('no_embarazos')->default(0);
            $table->integer('no_partos')->default(0);
            $table->integer('no_cesareas')->default(0);
            $table->integer('no_abortos')->default(0);
            $table->integer('no_hijos_vivos')->default(0);
            $table->integer('no_hijos_muertos')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
