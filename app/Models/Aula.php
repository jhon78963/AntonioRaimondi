<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = "aulas";

    protected $primaryKey = 'aula_id';

    protected $guarded = [''];

    public function grados()
    {
        return $this->hasOne('App\Models\Grado', 'grado_id', 'grado_id');
    }

    public function secciones()
    {
        return $this->hasOne('App\Models\Seccion', 'secc_id', 'secc_id');
    }
}