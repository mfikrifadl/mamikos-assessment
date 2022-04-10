<?php

namespace App\Models\UserCredit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    use HasFactory;

    protected $table = 'user_credit';
    protected $guarded = ['id'];
}
