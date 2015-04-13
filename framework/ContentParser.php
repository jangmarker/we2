<?php
/**
 * Created by PhpStorm.
 * User: jangmarker
 * Date: 13.04.15
 * Time: 10:49
 */

namespace framework;


class ContentParser {

    public static function parse($mimeType, $content) {
        $contentParser = ContentParser::parserForMimeType($mimeType, $content);
        return $contentParser->parse();
    }

    private function parserForMimeType($mimeType, $content) {
        if ($mimeType == 'text/json') {
            return new JSONContentParser($content);
        }
    }

}