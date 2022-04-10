<?php

namespace App\Models\UserAskAvailable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAskAvailableRepository extends Model
{
    public function store($kost_id)
    {
        $user = Auth::user();
        $check = UserAskAvailable::where('user_id', $user['id'])->where('kost_id', $kost_id)->where('available', -1)->first();

        if ($check) {
            return false;
        }

        $user_ask = UserAskAvailable::create([
            'user_id' => $user['id'],
            'kost_id' => $kost_id,
        ]);

        return $user_ask;
    }

    public function getMyList($filter)
    {
        $user = Auth::user();
        $data = UserAskAvailable::select('id', 'kost_id', 'available', 'created_at')->where('user_id', $user['id'])->with('kost:id,name,full_address,province,city,district,price,description');

        if (isset($filter['status'])) {
            if ($filter['status'] == 'pending') $data = $data->where('available', -1);
            else if ($filter['status'] == 'available') $data = $data->where('available', 1);
            else if ($filter['status'] == 'not-available') $data = $data->where('available', 0);
        }

        if (isset($filter['sorted'])) {
            $data = $data->orderBy('created_at', $filter['sorted']);
        } else {
            $data = $data->orderBy('created_at', 'desc');
        }

        if (isset($filter['limit'])) {
            $data = $data->paginate($filter['limit']);
        } else {
            $data = $data->paginate(10);
        }

        return $data;
    }
}
