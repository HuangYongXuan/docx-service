<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $rules
     */
    protected function makeValidator($rules = [])
    {
        $result = \Validator::make(request()->all(), $rules);

        if ($result->fails()) {
            abort(response(toError(-10000, $result->errors(), '数据验证失败')));
        }
    }
}
