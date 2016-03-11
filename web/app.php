<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// define all available environments in this array
$environments = [
    'dev',
    'test',
    'qa',
    'prod'
];
$debug = false;

if (defined('APP_ENV') and in_array(APP_ENV, $environments)) {
    $env = APP_ENV;
} elseif (getenv('APP_ENV') !== false and in_array(getenv('APP_ENV'), $environments)) {
    $env = getenv('APP_ENV');
} else {
    $env = 'prod';
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Enable APC for auto-loading to improve performance.
// You should change the ApcClassLoader first argument to a unique prefix
// in order to prevent cache key conflicts with other applications
// also using APC.
if ($env === 'prod') {
    $apcLoader = new ApcClassLoader(sha1(__FILE__), $loader);
    $loader->unregister();
    $apcLoader->register(true);

    require_once __DIR__.'/../app/AppCache.php';
}

require_once __DIR__.'/../app/AppKernel.php';

if ($env === 'dev' or (defined('APP_DEBUG') and APP_DEBUG === true)) {
    $debug = true;
    Debug::enable();
}

$kernel = new AppKernel($env, $debug);
$kernel->loadClassCache();

if ($env === 'prod') {
    $kernel = new AppCache($kernel);
}

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
