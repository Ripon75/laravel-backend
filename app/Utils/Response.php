<?php
namespace App\Utils;

class Response
{
    public function response($result, $msg, $token = null)
    {
        $res = [
            'success' => true,
            'token'   => $token,
            'msg'     => $msg,
            'result'  => $result
        ];

        return response()->json($res, 200);
    }

    public function error($result, $msg, $token = null)
    {
        $res = [
            'success' => false,
            'token'   => $token,
            'msg'     => $msg,
            'result'  => $result
        ];

        return response()->json($res, 200);
    }
}
