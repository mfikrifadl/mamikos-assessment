<?php

namespace App\Models\OwnerKost;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OwnerKost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'owner_kost';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }
}
