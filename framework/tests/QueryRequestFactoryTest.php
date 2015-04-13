<?php
namespace framework\tests;

require_once('../Framework.php');

use framework\QueryRequestFactory;


class QueryRequestFactoryTest extends \PHPUnit_Framework_TestCase {

    function test_correctlyLoadsWrappedResource() {
        // Prepare
        $server = array(
            'QUERY_STRING' => "wrapper=main&resourceName=testResource",
            'CONTENT_TYPE' => "text/json",
            'REQUEST_METHOD' => "GET"
        );
        $factory = new QueryRequestFactory();

        // Do
        $request = $factory->createRequest($server);

        // Assert
        $this->assertEquals("main", $request->getWrapper());
        $this->assertEquals("testResource", $request->getResourceName());
    }

}
