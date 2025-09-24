<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menores extends Model
{
    protected $table = 'vista_menores_14';

    // Indicar que la PK es `id`
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
