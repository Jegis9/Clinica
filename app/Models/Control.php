<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $fillable = [
        'antecedente_id',
        'no_control',
        'fecha',
        'multiple',
        'rh',
        'hemorragia',
        'vih',
        'precion',
        'anemia',
        'desnutricion',
        'dolor',
        'sintomologia',
        'ictericia',
        'diabetes',
        'renal',
        'corazon',
        'hipertencion',
        'drogras',
        'enfermedad',
        'otros',
    ];
    public function antobs()
    {
        return $this->belongsTo(Antobs::class, 'antecedente_id');
    }
}
