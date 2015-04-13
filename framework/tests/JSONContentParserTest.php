<?php
namespace framework\tests;

require_once('../Framework.php');

use framework\JSONContentParser;

class JSONContentParserTest extends \PHPUnit_Framework_TestCase {

    public function test_parse() {
        // Prepare
        $json = "{\"attr1\":\"guten tag\"}";

        // Do
        $contentParser = new JSONContentParser($json);
        $parsedContent = $contentParser->parse();

        // Verify
        $this->assertEquals(array('attr1'=>'guten tag'), $parsedContent);

    }

}
