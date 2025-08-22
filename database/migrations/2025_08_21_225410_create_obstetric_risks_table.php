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
        Schema::create('obstetric_risks', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('control_id');
            $table->boolean('previous_fetal_death')->default(false);
            $table->boolean('recurrent_abortions')->default(false);
            $table->boolean('multigravida')->default(false);
            $table->boolean('previous_low_weight')->default(false);
            $table->boolean('previous_macrosomia')->default(false);
            $table->boolean('hypertension_history')->default(false);
            $table->boolean('previous_cesarean')->default(false);
            $table->boolean('previous_surgeries')->default(false);
            $table->boolean('multiple_pregnancy')->default(false);
            $table->boolean('age_under20')->default(false);
            $table->boolean('age_35plus')->default(false);
            $table->boolean('anemia')->default(false);
            $table->boolean('malnutrition')->default(false);
            $table->boolean('abdominal_pain')->default(false);
            $table->boolean('urinary_symptoms')->default(false);
            $table->boolean('jaundice')->default(false);
            $table->boolean('hiv_syphilis_positive')->default(false);
            $table->boolean('hypertension_current')->default(false);
            $table->text('other_conditions')->nullable();
            $table->timestamps();

            $table->foreign('control_id')->references('id')->on('prenatal_controls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obstetric_risks');
    }
};
