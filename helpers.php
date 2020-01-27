<?php
if (function_exists('toSuccess') === false) {
    /**
     * http返回成功结果
     * @param int $code
     * @param $data
     * @param null $msg
     * @return array
     */
    function toSuccess(int $code, $data = [], $msg = null): array
    {
        return [
            'success' => true,
            'code' => $code,
            'data' => $data,
            'msg' => $msg
        ];
    }
}

if (function_exists('toError') === false) {
    /**
     * http返回失败结果
     * @param int $code
     * @param $data
     * @param string $msg
     * @return array
     */
    function toError(int $code, $data, string $msg): array
    {
        return [
            'success' => false,
            'code' => $code,
            'data' => $data,
            'msg' => $msg
        ];
    }
}
