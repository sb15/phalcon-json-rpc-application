<?php

namespace Sb\JsonRpcApplication;

class Exception extends \Exception
{
    const ERROR_PARSE_ERROR = [
        'code' => -32700,
        'message' => 'Parse error'
    ];

    const ERROR_INVALID_REQUEST = [
        'code' => -32600,
        'message' => 'Invalid Request'
    ];

    const ERROR_METHOD_NOT_FOUND = [
        'code' => -32601,
        'message' => 'Method not found'
    ];

    const ERROR_INVALID_PARAMS = [
        'code' => -32602,
        'message' => 'Invalid params'
    ];

    const ERROR_INTERNAL_ERROR = [
        'code' => -32603,
        'message' => 'Internal error'
    ];

    const ERROR_INVALID_DISPATCHER = [
        'code' => -32000,
        'message' => 'Dispatcher class must be JsonRpcDispatcher'
    ];

}