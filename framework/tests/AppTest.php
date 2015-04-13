<?php
namespace framework\tests;

require_once("../Framework.php");


use framework\App;
use framework\Service;

class AppTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var App
     */
    private $app;

    function setUp() {
        $this->app = new App();
    }

    function test_registerAndGetService() {
        // Do
        $this->app->registerService("testservice", new Service());
        $testService = $this->app->getService("testservice");

        // Test
        $this->assertTrue($testService instanceof Service);
    }

    function test_get_usesServiceCorrectly() {
        // Prepare
        $serviceStub = $this->getMockBuilder('Service')->getMock();
        $serviceStub->get(1)->shouldBeCalled();

        $this->app->registerService("testservice", $serviceStub);

        $this->simulateHTTPRequest('GET', '/testservice/1');

        // Do
        $this->app->start();
    }

    function simulateHTTPRequest($method, $url) {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $url;
    }

}
