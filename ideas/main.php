<?php

require_once(dirname(__FILE__) . "/../framework/Framework.php");

$app = new framework\App();
$app->setTemplateDir(__DIR__ . "/tmpl/");
$app->registerService("idea", new \framework\Service());
$app->registerService("main", new \framework\Service());

$requestFactory = new \framework\QueryRequestFactory();
$request = $requestFactory->createRequest($_SERVER);

$app->exec($request);
