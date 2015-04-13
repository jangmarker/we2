<?php
namespace framework;


class Request {
    private $wrapper;
    private $resourceName;
    private $id;
    private $subresourceName;
    private $content;
    private $method;

    function __construct($array) {
        $this->useIfExists($array, 'wrapper');
        $this->resourceName = $array['resourceName'];
        $this->useIfExists($array, 'id');
        $this->useIfExists($array, 'subresourceName');
        $this->content = $array['content'];
        $this->method = $array['method'];
    }

    private function useIfExists($array, $key) {
        if (array_key_exists($key, $array)) {
            $this->{$key} = $array[$key];
        }
    }

    /**
     * @return mixed
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @return mixed
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSubresourceName()
    {
        return $this->subresourceName;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

}