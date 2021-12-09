<?php
$connection = require __DIR__.'/../sistem/connection.php';

$request = function($controller, $method, $petition, $connect)
{
    return $GLOBALS[$controller]($method, $connect, $petition)();
};

$models = function($model, $method, $petition, $connect)
{
    return $GLOBALS[$model]($method, $connect, $petition);
};

$routePure = function($route, $controller, $connect, $requestObject, $request_uri, $petition)
{
    $routePath = function($controller)
    {
        $controllerAndMethod = explode('@', $controller);
        return [
            "controllerRoute"   => $controllerAndMethod[0],
            "methodRoute"       => $controllerAndMethod[1]
        ];
    };

    $request_uriFn = function($request_uri)
    {
        $escapingGetExplode = explode('?', $request_uri);
        return (is_array($escapingGetExplode)) 
            ? $escapingGetExplode[0] 
            : $request_uri;
    };

    $routeFn = function($routeString){return "/" . $routeString;};
    $requestRoute = function($routeRequest, $request_uriFn, $routePath, $requestObject) use ($connect, $petition)
    {
        if ($routeRequest == $request_uriFn)
        {
            return $requestObject
            (
                $routePath['controllerRoute'],
                $routePath['methodRoute'],
                $petition,
                $connect
            );
        }
    };

    return $requestRoute
    (
        $routeFn($route), 
        $request_uriFn($request_uri), 
        $routePath($controller), 
        $requestObject
    );
};

$routeFn = function($route, $controller) use ($connection, $request, $routePure)
{
    return $routePure($route, $controller, $connection, $request, $_SERVER['REQUEST_URI'], $_REQUEST);
};

$routePrint = function($route, $controller) use ($routeFn)
{
    $routeWithoutPoint = explode('.', $route);
    echo(rtrim($routeFn($routeWithoutPoint[0], $controller), '1'));
    #var_dump($routeFn($route, $controller));
};



