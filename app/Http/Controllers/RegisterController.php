<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRegisterOwnerRequest;
use App\Http\Requests\PostRegisterUserPremiumRequest;
use App\Http\Requests\PostRegisterUserRegularRequest;
use App\Models\User\UserRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(UserRepository $user)
    {
        $this->middleware('role:admin', ['except' => ['registerOwner', 'registerUserRegular']]);
        $this->user = $user;
    }

    public function registerOwner(PostRegisterOwnerRequest $request)
    {
        $data = $request->post();
        $user = $this->user->storeUserOwner($data);

        if (!$user) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Register Owner',
            ]);
        }

        return response()->json([
            'code' => 500,
            'message' => 'Success Register Owner',
            'data' => $user,
        ]);
    }

    public function registerUserPremium(PostRegisterUserPremiumRequest $request)
    {
        $data = $request->post();
        $user = $this->user->storeUserPremium($data);

        if (!$user) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Register User Premium',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Register User Premium',
            'data' => $user,
        ]);
    }

    public function registerUserRegular(PostRegisterUserRegularRequest $request)
    {
        $data = $request->post();
        $user = $this->user->storeUserRegular($data);

        if (!$user) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed Register User Regular',
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Register User Regular',
            'data' => $user,
        ]);
    }
}
