<?php

namespace App\Models\OwnerKost;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OwnerKostRepository extends Model
{
    public function getAllKost($filter)
    {
        $kost =  OwnerKost::select('id', 'name', 'full_address', 'price');

        if (isset($filter['search_by']) && isset($filter['search'])) {
            if ($filter['search_by'] == 'location') {
                $kost = $kost->where('full_address', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('province', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('city', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('district', 'ilike', '%' . $filter['search'] . '%');
            } else {
                $kost = $kost->where($filter['search_by'], 'ilike', '%' . $filter['search'] . '%');
            }
        }

        if (isset($filter['sorted_by']) && isset($filter['sorted'])) {
            $kost = $kost->orderBy($filter['sorted_by'], $filter['sorted']);
        } else {
            $kost = $kost->orderBy('created_at', 'desc');
        }

        if (isset($filter['limit'])) {
            $kost = $kost->paginate($filter['limit']);
        } else {
            $kost = $kost->paginate(10);
        }

        return $kost;
    }

    public function myKostlist($filter)
    {
        $user = Auth::user();
        $kost =  OwnerKost::select('id', 'name', 'full_address', 'price')->where('user_id', $user['id']);

        if (isset($filter['search_by']) && isset($filter['search'])) {
            if ($filter['search_by'] == 'location') {
                $kost = $kost->where('full_address', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('province', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('city', 'ilike', '%' . $filter['search'] . '%')
                    ->orWhere('district', 'ilike', '%' . $filter['search'] . '%');
            } else {
                $kost = $kost->where($filter['search_by'], 'ilike', '%' . $filter['search'] . '%');
            }
        }

        if (isset($filter['sorted_by']) && isset($filter['sorted'])) {
            $kost = $kost->orderBy($filter['sorted_by'], $filter['sorted']);
        } else {
            $kost = $kost->orderBy('created_at', 'desc');
        }

        if (isset($filter['limit'])) {
            $kost = $kost->paginate($filter['limit']);
        } else {
            $kost = $kost->paginate(10);
        }

        return $kost;
    }

    public function detail($id)
    {
        return OwnerKost::select('name', 'full_address', 'province', 'city', 'district', 'price', 'description', 'created_at')->find($id);
    }

    public function store($data)
    {
        $user = Auth::user();
        $owner_kost = OwnerKost::create([
            'user_id' => $user['id'],
            'name' => $data['name'],
            'full_address' => $data['full_address'],
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        return $owner_kost;
    }

    public function edit($data, $id)
    {
        $owner_kost = OwnerKost::find($id);
        $user = Auth::user();
        if ($owner_kost['user_id'] !== $user['id']) {
            return false;
        }

        $owner_kost->update($data);

        return $owner_kost;
    }

    public function deleteKost($id)
    {
        $owner_kost = OwnerKost::find($id);
        $user = Auth::user();
        if ($owner_kost['user_id'] !== $user['id']) {
            return false;
        }

        $owner_kost->delete();

        return true;
    }
}
