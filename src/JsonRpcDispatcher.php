<?php

namespace Sb;

use Phalcon\Mvc\Dispatcher;
use Sb\JsonRpcApplication\Exception;
use Sb\JsonRpcApplication\JsonResponse;
use Phalcon\Mvc\Dispatcher\Exception as MvcDispatcherException;

class JsonRpcDispatcher  extends Dispatcher
{
    private $jsonReturnedValueList = [];

    public function dispatch()
    {

        $json = $this->getParam('json');

        $requests = $json;
        if (isset($requests['jsonrpc'])) {
            $requests = [$json];
        }

        foreach ($requests as $request) {

            $controller = 'index';

            if (strpos($request['method'], '.') === false) {
                $action = $request['method'];
            } else {
                list($controller, $action) = explode('.', $request['method']);
            }

            $this->setControllerName($controller);
            $this->setActionName($action);
            $this->setParams($request['params']);

            try {
                parent::dispatch();
                $result = $this->getReturnedValue();
                $this->jsonReturnedValueList[] = JsonResponse::success($result, $request['id']);

            } catch (\Exception $e) {

                $code = $e->getCode();
                $message = $e->getMessage();
                if ($e instanceof MvcDispatcherException) {
                    $code = Exception::ERROR_METHOD_NOT_FOUND['code'];
                    $message = Exception::ERROR_METHOD_NOT_FOUND['message'];
                }

                $this->jsonReturnedValueList[] = JsonResponse::error($message, $code, $request['id']);
            }
        }

        return $this;
    }

    public function getJsonReturnedValue()
    {
        if (count($this->jsonReturnedValueList) === 1) {
            return $this->jsonReturnedValueList[0];
        }

        return $this->jsonReturnedValueList;
    }
}