<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antobs extends Model
{
    protected $fillable = [
        'paciente_id',
        'muerte',
        'abortos',
        'gestas',
        'peso_bajo',
        'pesoa',
        'hipertencion',
        'cirujias',
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
