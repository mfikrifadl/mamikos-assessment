<?php

namespace App\Models\UserCredit;

use Illuminate\Database\Eloquent\Model;

class UserCreditRepository extends Model
{
    public function storeCredit($user)
    {
        if ($user['role_id'] == 2) $credit = 40;
        else $credit = 20;

        $user_credit = UserCredit::create([
            'user_id' => $user['id'],
            'role_id' => $user['role_id'],
            'credit' => $credit,
            'last_recharge_date' => date('Y-m-d'),
        ]);

        return $user_credit;
    }
}
