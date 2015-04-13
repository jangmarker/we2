<?php
/**
 * Created by PhpStorm.
 * User: jangmarker
 * Date: 08.04.15
 * Time: 16:40
 */

namespace framework\tests;

require_once("../Framework.php");

use framework\HtmlTemplate;


class HtmlTemplateTest extends \PHPUnit_Framework_TestCase {
    private $templateDir;

    function setUp() {
        $this->templateDir = __DIR__ . "/tmpl";
    }

    function test_useTestTemplate() {
        // Prepare
        $content = new \stdClass();
        $content->text = "gutenTag";
        $template = new HtmlTemplate($this->templateDir, "main");

        // Do
        $result = $template->process($content);

        // Test
        $this->assertEquals("<div>gutenTag</div>", $result);
    }

    function test_templateWithChild() {
        // Prepare
        $content = new \stdClass();
        $content->text = "gutenTag";
        $templateInner = new HtmlTemplate($this->templateDir, "main");
        $templateOuter = new HtmlTemplate($this->templateDir, "outer", $templateInner);

        // Do
        $result = $templateOuter->process($content);

        // Test
        $this->assertEquals("<html><div>gutenTag</div></html>", $result);
    }

    /**
     * @expectedException   InvalidArgumentException
     */
    function test_notExisting() {
        // Prepare, Do, Test
        $template = new HtmlTemplate($this->templateDir, "404");
    }

}
