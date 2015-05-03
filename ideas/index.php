<?php

require_once(dirname(__FILE__) . "/../framework/Framework.php");
require_once(__DIR__ . "/LoginService.php");
require_once(__DIR__ . "/UserService.php");
require_once(__DIR__ . "/IdeaService.php");
require_once(__DIR__ . "/SearchService.php");
require_once(__DIR__ . "/LoginMiddleware.php");

require_once(__DIR__ . "/config.inc.php");

$app = new framework\App();
$app->setTemplateDir(__DIR__ . "/tmpl/");
$app->registerService("new_idea", new \framework\Service($config));
$app->registerService("main", new \framework\Service($config));
$app->registerService("about", new \framework\Service($config));
$app->registerService("login", new LoginService($config));
$app->registerService("user", new UserService($config));
$app->registerService("idea", new IdeaService($config));
$app->registerService("search", new SearchService($config));

$app->registerMiddleware(new LoginMiddleware());

$requestFactory = new \framework\QueryRequestFactory();
$request = $requestFactory->createRequest($_SERVER);

$app->exec($request);
