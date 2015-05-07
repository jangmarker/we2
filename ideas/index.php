<?php

require_once(dirname(__FILE__) . "/../framework/Framework.php");
require_once(__DIR__ . "/LoginService.php");
require_once(__DIR__ . "/UserService.php");
require_once(__DIR__ . "/IdeaService.php");
require_once(__DIR__ . "/SearchService.php");
require_once(__DIR__ . "/AboutService.php");
require_once(__DIR__ . "/VotesService.php");
require_once(__DIR__ . "/CommentService.php");
require_once(__DIR__ . "/LoginMiddleware.php");

require_once(__DIR__ . "/config.inc.php");

$app = new framework\App();
$app->setTemplateDir(__DIR__ . "/tmpl/");
$app->registerService("new_idea", new \framework\Service($config));
$app->registerService("main", new \framework\Service($config));
$app->registerService("about", new AboutService($config));
$app->registerService("login", new LoginService($config));
$app->registerService("user", new UserService($config));
$app->registerService("idea", new IdeaService($config));
$app->registerService("search", new SearchService($config));
$app->registerService("votes", new VotesService($config));
$app->registerService("comment", new CommentService($config));

$app->registerMiddleware(new LoginMiddleware());

$app->registerHandle('GET', 'idea', '__default',
    function (\framework\App $app, \framework\Request $request, $resource) {
        $response = new \framework\Response();

        $service = $app->getService($resource);

        $response->setTemplateName($resource);
        $data = $service->getWithAspect($request->getId(), $request->getParam('aspect'));
        $response->setData($data);

        return $response;
    }
);

$app->exec($_SERVER);
