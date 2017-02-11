<?php

namespace kayzore\bundle\RouterBundle\model;

use Exception;

class RouterException
{
    public function __construct($type, $message) {
        switch ($type) {
            case 404:
                @set_exception_handler(array($this, 'exception_404'));
                break;
            case 500:
                @set_exception_handler(array($this, 'exception_500'));
                break;
        }
        throw new Exception($message);
    }

    public function exception_404(Exception $exception) {
        echo "404 Not Found : ". $exception->getMessage() ."\n";
    }

    public function exception_500(Exception $exception) {
        echo "500 Internal Error : ". $exception->getMessage() ."\n";
    }
}