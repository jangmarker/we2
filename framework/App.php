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
        $this->registerHandle("GET", $name, '__default', $this->defaultHandleGet);
        $this->registerHandle("POST", $name, '__default', $this->defaultHandlePost);
        $this->registerHandle("UPDATE", $name, '__default', $this->defaultHandleUpdate);
        $this->registerHandle("DELETE", $name, '__default', $this->defaultHandleDelete);
    }

    function defaultHandleGet(\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $response->setData($service->get($request->getId()));
        $response->setReturnCode(200);

        return $response;
    }

    function defaultHandleDelete(\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $response->setData($service->remove($request->getId()));
        $response->setReturnCode(200);

        return $response;
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

        $function = $this->handles[$request->getResourceName()][$request->getMethod()][$request->getSubresourceName()];

        $response = $function($this, $request, $request->getResourceName());

        $this->render($response);
    }

    function render(Response $response) {
        // TODO send headers

        $htmlTemplate = new HtmlTemplate($this->templateDir, $response->getTemplateName());
        echo $htmlTemplate->process($response->getData());
    }

    public function setTemplateDir($templateDir)
    {
        $this->templateDir = $templateDir;
    }

}