<?php

require_once(dirname(__FILE__) . "/../framework/Framework.php");
require_once(__DIR__ . "/LoginService.php");
require_once(__DIR__ . "/UserService.php");
require_once(__DIR__ . "/IdeaService.php");
require_once(__DIR__ . "/LoginMiddleware.php");

$app = new framework\App();
$app->setTemplateDir(__DIR__ . "/tmpl/");
$app->registerService("new_idea", new \framework\Service());
$app->registerService("main", new \framework\Service());
$app->registerService("about", new \framework\Service());
$app->registerService("login", new LoginService());
$app->registerService("user", new UserService());
$app->registerService("idea", new IdeaService());

$app->registerMiddleware(new LoginMiddleware());

$requestFactory = new \framework\QueryRequestFactory();
$request = $requestFactory->createRequest($_SERVER);

$app->exec($request);
