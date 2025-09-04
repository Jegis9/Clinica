<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = 'historicos';

    // Indicar que la PK es `id`
    protected $primaryKey = 'historico_id';

    public $incrementing = false;
    public $timestamps = false;
}
