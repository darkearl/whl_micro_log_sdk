<?php

require_once(__DIR__."/Shared/TestBase.php");
require_once(__DIR__."/../src/ResponseException.php");
require_once(__DIR__."/../src/services/ExceptionLog.php");

use Hbe\ServiceLog\Sdk\config;
use Hbe\ServiceLog\Sdk\ExceptionLog;
use Hbe\ServiceLog\Sdk\ResponseException;

/**
 * @covers UserActivity
 */
final class TestExceptionLog extends TestBase
{
    public function testCreate()
    {
        $svc = new ExceptionLog();
        $response = $svc->create('info','test message','2020-06-01')
            ->call();

        $this->assertEquals("200", $response["status"]);
    }

    public function testGet()
    {
        $svc = new ExceptionLog();
        
        $response = $svc->get()
            ->withParameters([
                'Level' => 'info',
                'DateFrom' => '2020-06-01',
                'DateTo' => '2020-06-30',
            ])
            ->call();
        $this->assertEquals("200", $response["status"]);
        $this->assertGreaterThan(0, count($response['data']));

    }

    
}
?>