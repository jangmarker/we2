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
        $this->useIfExists($array, 'subresourceName', '__default');
        $this->content = $array['content'];
        $this->method = $array['method'];
    }

    private function useIfExists($array, $key, $default = false) {
        if (array_key_exists($key, $array)) {
            $this->{$key} = $array[$key];
            return;
        }
        if ($default !== false) {
            $this->{$key} = $default;
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

    /**
     * @param mixed $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @param mixed $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $subresourceName
     */
    public function setSubresourceName($subresourceName)
    {
        $this->subresourceName = $subresourceName;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

}