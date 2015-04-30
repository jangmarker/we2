<?php
namespace framework;


class App {
    private $middlewares = array();
    private $handles = array();
    private $services = array();
    private $templateDir;

    function registerMiddleware(Middleware $middleware) {
        $this->middlewares[] = $middleware;
    }

    function registerService($name, Service $service) {
        $this->services[$name] = $service;
        $this->registerHandle("GET", $name, '__default', 'defaultHandleGet');
        $this->registerHandle("POST", $name, '__default', 'defaultHandlePost');
        $this->registerHandle("UPDATE", $name, '__default', 'defaultHandleUpdate');
        $this->registerHandle("DELETE", $name, '__default', 'defaultHandleDelete');
    }

    function getService($name) {
        return $this->services[$name];
    }

    function registerHandle($method, $resourceName, $subresourceName, $function) {
        if (!array_key_exists($resourceName, $this->handles))
            $this->handles[$resourceName] = array();
        if (!array_key_exists($method, $this->handles[$resourceName]))
            $this->handles[$resourceName][$method] = array();

        $this->handles[$resourceName][$method][$subresourceName] = $function;
    }

    function exec(Request $request) {
        foreach ($this->middlewares as $middleware) {
            switch ($request->getMethod()) {
                case 'POST': $middleware->onPost($request); break;
                case 'GET': $middleware->onGet($request); break;
                case 'UPDATE': $middleware->onUpdate($request); break;
                case 'DELETE': $middleware->onDelete($request); break;
                default: throw new \ErrorException('Unkown method: ' . $request->getMethod());
            }
        }

        $response = null;
        if (!array_key_exists($request->getResourceName(), $this->handles)) {
            $response = $this->errorHandler(404, $request);
        } else {
            $function = $this->handles[$request->getResourceName()][$request->getMethod()][$request->getSubresourceName()];

            if (is_string($function)) {
                $response = $this->$function($this, $request, $request->getResourceName());
            } else {
                $response = $function($this, $request, $request->getResourceName());
            }
        }

        $this->render($response);
    }

    function errorHandler($errorNo, $request) {
        $response = new \framework\Response();
        switch ($errorNo) {
            case 404:
                    $response->setTemplateName("404");
                    $response->setData("Not found: " . $request->getResourceName());
                    $response->addHeader("Status", "404");
                break;
            default:
                break;
        }

        return $response;
    }

    function render(Response $response) {
        $headers = $response->getHeaders();
        for ($i = 0; $i < count($headers); ++$i) {
            header($headers[$i]);
        }

        $htmlTemplate = new HtmlTemplate($this->templateDir, $response->getTemplateName());
        echo $htmlTemplate->process($response->getData());
    }

    function setTemplateDir($templateDir) {
        $this->templateDir = $templateDir;
    }

    function defaultHandleGet(\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $response->setData($service->get($request->getId()));

        return $response;
    }

    function defaultHandleDelete(\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $response->setData($service->remove($request->getId()));

        return $response;
    }

}