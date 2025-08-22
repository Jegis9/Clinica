<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class pregnancie extends Model
{
    use HasFactory;

 protected $table = 'pregnancie'; 
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    // Relación con prenatal controls
    public function prenatalControls(): HasMany
    {
        return $this->hasMany(PrenatalControl::class);
    }


    protected $fillable = [
        'patient_id',
        'start_date',
        'gestational_weeks',
        'pregnancy_count',
        'previous_cesarean',
        'previous_births',
        'previous_abortions',
        'short_interpregnancy',
        'registration_date',
    ];


}
