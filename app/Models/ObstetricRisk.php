<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObstetricRisk extends Model // ← PascalCase correcto
{
    protected $table = 'obstetric_risks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'control_id',
        'previous_fetal_death',
        'recurrent_abortions',
        'multigravida',
        'previous_low_weight',
        'previous_macrosomia',
        'hypertension_history',
        'previous_cesarean',
        'previous_surgeries',
        'multiple_pregnancy',
        'age_under20',
        'age_35plus',
        'anemia',
        'malnutrition',
        'abdominal_pain',
        'urinary_symptoms',
        'jaundice',
        'hiv_syphilis_positive',
        'hypertension_current',
        'other_conditions',
    ];

    public function prenatalControl(): BelongsTo
    {
        return $this->belongsTo(PrenatalControl::class, 'control_id');
    }

    public function prenatalControls(): BelongsTo
{
    return $this->belongsTo(PrenatalControl::class, 'control_id');
}

}
