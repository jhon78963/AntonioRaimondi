<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = "alumnos";

    protected $primaryKey = 'alum_id';

    protected $guarded = [''];

    public function distrito()
    {
        return $this->hasOne('App\Models\Distrito', 'dist_id', 'dist_id');
    }

    public function provincia()
    {
        return $this->hasOne('App\Models\Provincia', 'prov_id', 'prov_id');
    }

    public function departamento()
    {
        return $this->hasOne('App\Models\Departamento', 'depa_id', 'depa_id');
    }

    public function pais()
    {
        return $this->hasOne('App\Models\Pais', 'pais_id', 'pais_id');
    }
}