<?php
/**
 * Created by PhpStorm.
 * User: jangmarker
 * Date: 08.04.15
 * Time: 18:53
 */

namespace framework;


class QueryRequestFactory {

    public function createRequest($server) {
        $result = array();
        parse_str($server['QUERY_STRING'], $result);
        $result['method'] = $server['REQUEST_METHOD'];

        $rawContent = file_get_contents('php://input');

        $contentType = 'text/json';
        if (isset($server['CONTENT_TYPE'])) {
            $contentType = $server['CONTENT_TYPE'];
        }
        $result['content'] = ContentParser::parse($contentType, $rawContent);

        return new Request($result);
    }

}