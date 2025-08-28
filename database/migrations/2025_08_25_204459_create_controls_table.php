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
        Schema::create('controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('antecedente_id')->nullable();
            $table->boolean('no_control')->default(false);
            $table->date('fecha')->nullable();
            $table->boolean('multiple')->default(false);
            $table->boolean('rh')->default(false);
            $table->boolean('hemorragia')->default(false);
            $table->boolean('vih')->default(false);
            $table->boolean('precion')->default(false);
            $table->boolean('anemia')->default(false);
            $table->boolean('desnutricion')->default(false);
            $table->boolean('dolor')->default(false);
            $table->boolean('sintomologia')->default(false);
            $table->boolean('ictericia')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->boolean('renal')->default(false);
            $table->boolean('corazon')->default(false);
            $table->boolean('hipertencion')->default(false);
            $table->boolean('drogras')->default(false);
            $table->boolean('enfermedad')->default(false);
            $table->text('otros')->nullable()->default(null);
            $table->foreign('antecedente_id')->references('id')->on('antobs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controls');
    }
};
