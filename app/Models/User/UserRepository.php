<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRepository extends Model
{
    public function checkType($type)
    {
        $user = Auth::user();
        if ($user->role['type'] == $type) {
            return true;
        } else {
            return false;
        }
    }
}
