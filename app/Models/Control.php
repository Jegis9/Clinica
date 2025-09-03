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
        'necesita_seguimiento',
        'seguimiento_completado',
        'fecha_ultimo_seguimiento',
        'fecha_proximo_seguimiento',
        'observaciones_seguimiento'
        
    ];
    public function antobs()
    {
        return $this->belongsTo(Antobs::class, 'antecedente_id');
    }
    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'paciente_id');
    }

}
