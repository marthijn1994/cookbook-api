<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @param RegisterFormRequest $request
     * @return UserResource
     */
    public function __invoke(RegisterFormRequest $request)
    {
        $user = User::create($request->only('name', 'username', 'email', 'password'));

        return new UserResource($user);
    }

}
