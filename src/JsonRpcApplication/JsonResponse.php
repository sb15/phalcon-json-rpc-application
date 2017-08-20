<?php

namespace Sb\JsonRpcApplication;

class JsonResponse
{
    public static function success($result, $id)
    {
        return [
            'jsonrpc' => '2.0',
            'result' => $result,
            'id' => $id
        ];
    }

    public static function error($message, $code, $id)
    {
        return [
            'jsonrpc' => '2.0',
            'error' => [
                'code' => $code,
                'message' => $message
            ],
            'id' => $id
        ];
    }
}
