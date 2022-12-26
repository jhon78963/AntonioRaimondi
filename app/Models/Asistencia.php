<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $primaryKey = 'asis_id';

    protected $guarded = [''];

    public function lista()
    {
        return $this->hasOne('App\Models\AlumnoSeccion', 'asec_id', 'asec_id');
    }

}
