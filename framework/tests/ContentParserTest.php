<?php
namespace framework\tests;

require_once('../Framework.php');

use \framework\ContentParser;

class ContentParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider data_parse
     */
    public function test_parse($mimeType, $content, $result) {
        // Do
        $parsedObject = ContentParser::parse($mimeType, $content);

        // Verify
        $this->assertEquals($result, $parsedObject);
    }

    public function data_parse() {
        return array(
            array("text/json", '{"attr":"val"}', array('attr'=>'val')),
        );
    }
}
