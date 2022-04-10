<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo('App\Models\RoleUser\RoleUser');
    }

    public function credit()
    {
        return $this->belongsTo('App\Models\UserCredit\UserCredit', 'id', 'user_id');
    }

    public function kosts()
    {
        return $this->hasMany('App\Models\OwnerKost\OwnerKost', 'user_id', 'id');
    }

    public function isAdmin()
    {
        if (Auth::user()->role['type'] == 'admin') {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if (Auth::user()->role['type'] == $role) {
            return true;
        }

        return false;
    }
}
