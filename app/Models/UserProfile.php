<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = "user_profiles";

    protected $primaryKey = 'upro_id';

    protected $guarded = [''];

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }
}