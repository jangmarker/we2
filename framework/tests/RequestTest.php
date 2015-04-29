<?php
namespace framework\tests;

require_once('../Request.php');

class RequestTest extends \PHPUnit_Framework_TestCase {
    private $originArray = array(
            'wrapper' => 'wrap',
            'resourceName' => 'resName',
            'id' => 'id',
            'subresourceName' => 'subResName',
            'content' => '{}',
            'method' => 'POST'
    );

    function test_hasBasicProperties() {
        $this->assertClassHasAttribute("wrapper", '\framework\Request');
        $this->assertClassHasAttribute("resourceName", '\framework\Request');
        $this->assertClassHasAttribute("id", '\framework\Request');
        $this->assertClassHasAttribute("subresourceName", '\framework\Request');
        $this->assertClassHasAttribute("content", '\framework\Request');
        $this->assertClassHasAttribute("method", '\framework\Request');
    }

    function test_constructsCorrectlyFromArrayWithoutId() {
        // Prepare
        $originArray = $this->originArray;
        $originArray['id'] = false;
        $originArray = array_filter($originArray);

        // Do
        $request = new \framework\Request($originArray);

        // Test
        $this->assertEquals($originArray['wrapper'], $request->getWrapper());
        $this->assertEquals($originArray['resourceName'], $request->getResourceName());
        $this->assertNull($request->getId());
        $this->assertEquals($originArray['subresourceName'], $request->getSubresourceName());
        $this->assertEquals($originArray['content'], $request->getContent());
        $this->assertEquals($originArray['method'], $request->getMethod());
    }

    function test_constructsCorrectlyFromArray()
    {
        //Prepare
        $originArray = $this->originArray;

        // Do
        $request = new \framework\Request($originArray);

        // Test
        $this->assertEquals($originArray['wrapper'], $request->getWrapper());
        $this->assertEquals($originArray['resourceName'], $request->getResourceName());
        $this->assertEquals($originArray['id'], $request->getId());
        $this->assertEquals($originArray['subresourceName'], $request->getSubresourceName());
        $this->assertEquals($originArray['content'], $request->getContent());
        $this->assertEquals($originArray['method'], $request->getMethod());
    }

    function test_constructsCorrectlyFromArrayWithoutSubresourceName()
    {
        //Prepare
        $originArray = $this->originArray;
        $originArray['subresourceName'] = false;
        $originArray = array_filter($originArray);

        // Do
        $request = new \framework\Request($originArray);

        // Test
        $this->assertEquals($originArray['wrapper'], $request->getWrapper());
        $this->assertEquals($originArray['resourceName'], $request->getResourceName());
        $this->assertEquals($originArray['id'], $request->getId());
        $this->assertEquals('__default', $request->getSubresourceName());
        $this->assertEquals($originArray['content'], $request->getContent());
        $this->assertEquals($originArray['method'], $request->getMethod());
    }
}
