<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = "users";

    protected $primaryKey = 'user_id';

    protected $guarded = [''];

    public function perfil()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'user_id');
    }

    // public function role()
    // {
    //     return $this->hasOne('App\Models\Role', 'role_id', 'role_id');
    // }
}