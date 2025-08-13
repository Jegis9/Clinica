<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Histories extends Model
{
    use HasFactory;
// app/Models/History.php

public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}
    protected $fillable = [
        'patient_id',          
        'date_consulting',
        'doctor_id',
        'diagnostic',
        'treatment',
        'observation',
      
    ];
}
