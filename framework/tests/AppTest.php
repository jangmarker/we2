<?php

namespace framework\tests;

require_once("../Framework.php");

use framework\App;
use framework\Middleware;


class AppTest extends \PHPUnit_Framework_TestCase {
    private $app;

    function setUp() {
        $this->app = new App();

    }

    /**
     * @dataProvider data_requests
     */
    function test_middleware_call($requestData, $method) {
        // Prepare
        $request = new \framework\Request($requestData);
        $middleware = $this->getMockBuilder('\framework\Middleware')->getMock();
        $this->app->registerMiddleware($middleware);

        // Do
        $this->app->exec($request);

        //Done
        $middleware->expects($this->once())->method($method); //->with($this->equalTo($request));

    }

    function data_requests() {
        return array(
            array(
                array(
                    "content" => "testContent",
                    "method" => "GET",
                    "resourceName" => "testResource",
                ),
                'onGet',
            ),
            array(
                array(
                    "content" => "testContent",
                    "method" => "POST",
                    "resourceName" => "testResource",
                ),
                'onPost',
            ),
        );
    }

}
