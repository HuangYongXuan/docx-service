<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    protected $guard = 'api';

    public function login(Request $request)
    {
        $this->makeValidator([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard($this->guard)->attempt($credentials)) {
            return toError(1000, [], '邮箱和密码错误');
        }
        return toSuccess(200, [
            'token' => $token,
            'expires_in' => Auth::guard($this->guard)->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return mixed
     */
    public function refreshToken()
    {
        $token = Auth::guard($this->guard)->refresh();
        return toSuccess(200, [
            'token' => $token,
            'expires_in' => Auth::guard($this->guard)->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return array
     */
    public function destroy()
    {
        Auth::guard($this->guard)->logout();
        return toSuccess(200, [], 'logout success');
    }
}
