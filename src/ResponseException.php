<?php
namespace Hbe\ServiceLog\Sdk;

use \Exception;

class ResponseException extends Exception
{
    public $Status;
    public $ErrorMessage;
    public $JsonResponse;
}
?>