<?php

require_once(__DIR__."/Shared/TestBase.php");
require_once(__DIR__."/../src/ResponseException.php");
require_once(__DIR__."/../src/services/UserActivity.php");

use Hbe\ServiceLog\Sdk\config;
use Hbe\ServiceLog\Sdk\UserActivity;
use Hbe\ServiceLog\Sdk\ResponseException;

/**
 * @covers UserActivity
 */
final class TestUserActivity extends TestBase
{
    public function testCreate()
    {
        $svc = new UserActivity();
        $response = $svc->create('userA','hotelB','pageC','test message','2020-06-01')
            ->call();

        $this->assertEquals("200", $response["status"]);
    }

    public function testGetUser()
    {
        $svc = new UserActivity();
        
        $response = $svc->get()
            ->withParameters([
                'UserID' => 'userA',
                'DateFrom' => '2020-06-01',
                'DateTo' => '2020-06-30',
            ])
            ->call();
        $this->assertEquals("200", $response["status"]);
        $this->assertGreaterThan(0, count($response['data']));

    }

    public function testGetHotel()
    {
        $svc = new UserActivity();

        $response = $svc->get()
            ->withParameters([
                'HotelID' => 'hotelB',
                'DateFrom' => '2020-06-01',
                'DateTo' => '2020-06-30',
            ])
            ->call();

        $this->assertEquals("200", $response["status"]);
        $this->assertGreaterThan(0, count($response['data']));
    }

    public function testGetHotelFunction()
    {
        $svc = new UserActivity();

        $response = $svc->get()
            ->withParameters([
                'HotelID' => 'hotelB',
                'Function' => 'pageC',
                'DateFrom' => '2020-06-01',
                'DateTo' => '2020-06-30',
            ])
            ->call();

        $this->assertEquals("200", $response["status"]);
        $this->assertGreaterThan(0, count($response['data']));
    }

    public function testGetHotelUser()
    {
        $svc = new UserActivity();

        $response = $svc->get()
            ->withParameters([
                'HotelID' => 'hotelB',
                'UserID' => 'userA',
                'DateFrom' => '2020-06-01',
                'DateTo' => '2020-06-30',
            ])
            ->call();

        $this->assertEquals("200", $response["status"]);
        $this->assertGreaterThan(0, count($response['data']));
    }
}
?>