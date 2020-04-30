<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    /**
     * LogoutController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     *
     */
    public function __invoke()
    {
        auth()->logout();

        return response()
            ->json([
                'message' => __('auth.logged_out')
            ], 200);
    }

}
