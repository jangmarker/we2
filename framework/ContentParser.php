<?php
namespace framework;


class ContentParser {

    public static function parse($mimeType, $content) {
        $contentParser = ContentParser::parserForMimeType($mimeType, $content);
        return $contentParser->parse();
    }

    private static function parserForMimeType($mimeType, $content) {
        $mimeType = preg_replace("/;.*/", "", $mimeType);

        switch ($mimeType) {
            case 'text/json':
                return new JSONContentParser($content);
            case 'application/x-www-form-urlencoded':
                return new PostContentParser($content);
            default:
                throw new \InvalidArgumentException("Fatal: Could not find content parser for $mimeType");
        }
    }

}