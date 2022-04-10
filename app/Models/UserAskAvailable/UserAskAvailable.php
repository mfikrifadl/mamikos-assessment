<?php

namespace App\Models\UserAskAvailable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAskAvailable extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_ask_available';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }

    public function kost()
    {
        return $this->belongsTo('App\Models\OwnerKost\OwnerKost', 'kost_id', 'id');
    }
}
