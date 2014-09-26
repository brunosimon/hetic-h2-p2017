<?php

require_once 'config.php';
require_once 'controllers/index.controller.php';
require_once 'controllers/admin.controller.php';

/**
 * INDEX
 */
$app['index.controller'] = $app->share(function() use ($app) {
    return new IndexController('someStuffYouWantToUseInController');
});

$app->get('/'       ,'index.controller:indexAction');
$app->get('/about'  ,'index.controller:aboutAction');
$app->get('/contact','index.controller:contactAction');

/**
 * ADMIN
 */
$app['admin.controller'] = $app->share(function() use ($app) {
    return new AdminController('someStuffYouWantToUseInController');
});

$admin = $app['controllers_factory'];
$admin->get('/'       ,'admin.controller:indexAction');
$admin->get('/options','admin.controller:optionsAction');

$app->mount('/admin', $admin);

/**
 * RUN
 */
$app->run();
