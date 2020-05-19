<?php

require_once(__DIR__ . "/../../src/Config.php");

use Guzzle\Tests\GuzzleTestCase;
//use PHPUnit\Framework\TestCase;
use Hbe\ServiceLog\Sdk\Config;

/**
 * @covers TestBase
 */
class TestBase extends GuzzleTestCase
{
    protected function setUp()
    {
        Config::initialise("sandbox", "", "");
    }
}
?>