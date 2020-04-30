<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{

    /**
     * MeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

}
