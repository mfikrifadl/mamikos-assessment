<?php

namespace App\Models\User;

use App\Models\UserCredit\UserCreditRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Model
{
    public function __construct(UserCreditRepository $credit)
    {
        $this->credit = $credit;
    }

    public function checkType($type)
    {
        $user = Auth::user();
        if ($user->role['type'] == $type) {
            return true;
        } else {
            return false;
        }
    }

    public function storeUserOwner($data)
    {
        $user = User::create([
            'role_id' => 1,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function storeUserPremium($data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id' => 2,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $credit_user = $this->credit->storeCredit($user);
            if (!$credit_user) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
            // something went wrong
        }
    }

    public function storeUserRegular($data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id' => 3,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $credit_user = $this->credit->storeCredit($user);
            if (!$credit_user) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
            // something went wrong
        }
    }
}
