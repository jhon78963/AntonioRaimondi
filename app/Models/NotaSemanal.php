<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaSemanal extends Model
{
    use HasFactory;

    protected $table = 'notas_semanas';

    protected $primaryKey = 'nsem_id';

    protected $guarded = [''];

    public function notas()
    {
        return $this->hasOne('App\Models\Nota', 'nota_id', 'nota_id');
    }
}