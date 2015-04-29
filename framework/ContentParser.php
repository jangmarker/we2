<?php
namespace framework;


class ContentParser {

    public static function parse($mimeType, $content) {
        $contentParser = ContentParser::parserForMimeType($mimeType, $content);
        return $contentParser->parse();
    }

    private static function parserForMimeType($mimeType, $content) {
        if ($mimeType == 'text/json') {
            return new JSONContentParser($content);
        }
    }

}