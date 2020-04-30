<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __invoke(LoginFormRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'account' => __('auth.failed')
                ]
            ], 422);
        }

        return response()->json([
            'data' => [
                'token' => $token
            ]
        ], 200);
    }

}
