<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreKostrequest;
use App\Models\OwnerKost\OwnerKostRepository;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function __construct(OwnerKostRepository $kost)
    {
        $this->middleware('role:owner', ['except' => ['getAllKost', 'getDetailKost']]);
        $this->kost = $kost;
    }

    public function getAllKost(Request $request)
    {
        $filter = $request->post();
        $data = $this->kost->getAllKost($filter);

        if (!$data) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Get All Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Kost',
            'data' => $data,
        ]);
    }

    public function myKostlist(Request $request)
    {
        $filter = $request->post();
        $data = $this->kost->myKostlist($filter);

        if (!$data) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Get My Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Get My Kost',
            'data' => $data,
        ]);
    }

    public function getDetailKost($id)
    {
        $kost = $this->kost->detail($id);
        if (!$kost) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Get Detail Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Get Detail Kost',
            'data' => $kost,
        ]);
    }

    public function store(PostStoreKostrequest $request)
    {
        $data = $request->post();
        $owner_kost = $this->kost->store($data);

        if (!$owner_kost) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Add Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Add Kost',
            'data' => $owner_kost,
        ]);
    }

    public function edit(PostStoreKostrequest $request, $id)
    {
        $data = $request->post();
        $owner_kost = $this->kost->edit($data, $id);

        if (!$owner_kost) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Edit Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Edit Kost',
            'data' => $owner_kost,
        ]);
    }

    public function deleteKost($id)
    {
        $owner_kost = $this->kost->deleteKost($id);

        if (!$owner_kost) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Delete Kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Delete Kost',
        ]);
    }
}
