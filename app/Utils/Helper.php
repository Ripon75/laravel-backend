<?php
namespace App\Utils;

class Helper
{
    static public function response($result, $msg, $token = null)
    {
        $res = [
            'success' => true,
            'token'   => $token,
            'msg'     => $msg,
            'result'  => $result
        ];

        return response()->json($res, 200);
    }

    static public function error($result, $msg, $token = null)
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
