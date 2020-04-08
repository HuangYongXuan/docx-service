<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api-auth']);
    }

    public function info()
    {
        return toSuccess(200, \Auth::user());
    }
}
