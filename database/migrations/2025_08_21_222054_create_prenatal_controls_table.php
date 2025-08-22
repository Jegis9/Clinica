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
        Schema::create('prenatal_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pregnancy_id');
            $table->integer('control_number');
            $table->date('control_date');
            $table->integer('gestational_weeks');
            $table->boolean('is_risk')->default(false);
            $table->text('notes')->nullable();

            $table->foreign('pregnancy_id')->references('id')->on('pregnancie')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenatal_controls');
    }
};
