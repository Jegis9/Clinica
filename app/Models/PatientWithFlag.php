<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientWithFlag extends Model
{
    protected $table = 'patients_with_flags';

    // Indicar que la PK es `id`
    protected $primaryKey = 'id';

    public $incrementing = false; // porque no es autoincremental
    public $timestamps = false;

public function historicos()
{
    return $this->hasMany(Historico::class, 'antecedente_id', 'antecedente_id');
}

}
