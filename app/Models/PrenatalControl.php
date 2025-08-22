<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PrenatalControl  extends Model
{
    use HasFactory;
    public function pregnancie()
    {
        return $this->belongsTo(pregnancie::class,'id');
    }
        public function ObstetricRisk(): HasOne
    {
        return $this->hasOne(ObstetricRisk::class, 'id');
    }
    public function pregnancies()
    {
        return $this->belongsTo(Pregnancie::class, 'pregnancy_id');
    }
//-------------------------------------

        public function pregnancy() // Singular, no "pregnancie"
    {
        return $this->belongsTo(Pregnancy::class, 'pregnancy_id');
    }
    
    public function obstetricRisks(): HasOne
    {
        return $this->hasOne(ObstetricRisk::class, 'control_id');
    }



    protected $table = 'prenatal_controls'; // ← Especifica el nombre de la tabla
    protected $fillable = [
        'pregnancy_id',
        'control_number',
        'control_date',
        'gestational_weeks',
        'is_risk',
        'notes',
    ];
}
