<?php
namespace framework;


class App {
    private $middlewares = array();
    private $handles = array();
    private $services = array();
    private $templateDir;

    function registerMiddleware(Middleware $middleware) {
        $this->middlewares[] = $middleware;
        $middleware->setApp($this);
    }

    function registerService($name, Service $service) {
        $this->services[$name] = $service;
        $this->registerHandle("GET", $name, '__default', 'defaultHandleGet');
        $this->registerHandle("POST", $name, '__default', 'defaultHandlePost');
        $this->registerHandle("UPDATE", $name, '__default', 'defaultHandleUpdate');
        $this->registerHandle("DELETE", $name, '__default', 'defaultHandleDelete');
        $service->setApp($this);
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

    function exec($server) {
        $response = null;

        try {
            $requestFactory = new \framework\QueryRequestFactory();
            $request = $requestFactory->createRequest($_SERVER);

            foreach ($this->middlewares as $middleware) {
                switch ($request->getMethod()) {
                    case 'POST':
                        $middleware->onPost($request);
                        break;
                    case 'GET':
                        $middleware->onGet($request);
                        break;
                    case 'UPDATE':
                        $middleware->onUpdate($request);
                        break;
                    case 'DELETE':
                        $middleware->onDelete($request);
                        break;
                    default:
                        throw new \ErrorException('Unkown method: ' . $request->getMethod());
                }
            }

            if (!array_key_exists($request->getResourceName(), $this->handles)) {
                $response = $this->errorHandler(404, "Could not find " . $request->getResourceName());
            } else {
                $function = $this->handles[$request->getResourceName()][$request->getMethod()][$request->getSubresourceName()];

                if (is_string($function)) {
                    $response = $this->$function($this, $request, $request->getResourceName());
                } else {
                    $response = $function($this, $request, $request->getResourceName());
                }
            }

            $response->setAcceptedMimeType($request->getAcceptedMimeType());
        } catch (\Exception $e) {
            $response = $this->handleException($e);
        }

        $this->render($response);
    }

    function errorHandler($errorNo, $msg) {
        $response = new \framework\Response();
        switch ($errorNo) {
            case 404:
                    $response->setTemplateName("404");
                    $response->setData(array('error' => $msg));
                    $response->addHeader("Status", "404");
                break;
            default:
                $response->setTemplateName('error');
                $response->setData(array('error' => $msg));
                $response->addHeader("Status", $errorNo);
                break;
        }

        return $response;
    }

    private function handleException(\Exception $e) {
        if ($e instanceof \InvalidArgumentException) {
            return $this->errorHandler(400, $e->getMessage());
        } else {
            return $this->errorHandler(500, $e->getMessage());
        }
    }

    function render(Response $response) {
        try {
            $headers = $response->getHeaders();
            for ($i = 0; $i < count($headers); ++$i) {
                header($headers[$i]);
            }

            foreach ($this->middlewares as $middleware) {
                $response = $middleware->handleResponse($response);
            }

            $template = Template::create($response->getAccepted(), $this->templateDir, $response->getTemplateName());

            echo $template->process($response->getData());
        } catch(\Exception $e) {
            $this->render($this->handleException($e));
        }
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

    function defaultHandlePost(\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $response->setData($service->create($request->getContent()));

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