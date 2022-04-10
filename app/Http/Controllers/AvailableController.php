<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAskAvailRequest;
use App\Models\UserAskAvailable\UserAskAvailableRepository;
use Illuminate\Http\Request;

class AvailableController extends Controller
{
    public function __construct(UserAskAvailableRepository $user_ask)
    {
        $this->middleware('role:user');
        $this->user_ask = $user_ask;
    }

    public function getMyList(Request $request)
    {
        $filter = $request->post();
        $data = $this->user_ask->getMyList($filter);

        if (!$data) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to get my ask',
            ]);
        }

        return response()->json([
            'code' => 500,
            'message' => 'Success get my ask',
            'data' => $data
        ]);
    }

    public function askAvail(PostAskAvailRequest $request)
    {
        $kost_id = $request['kost_id'];
        $data = $this->user_ask->store($kost_id);

        if (!$data) {
            return response()->json([
                'code' => 500,
                'error' => 'Failed to ask kost',
                'message' => 'You have asked the availability of this kost',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success to ask kost',
            'data' => $data,
        ]);
    }
}
