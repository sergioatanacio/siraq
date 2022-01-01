<?php
/**
 * Obtiene la conección a la base de datos y la asigna al simbolo $connection.
 */
def($connection, require __DIR__.'/../sistem/connection.php');

def($request, function($controller, $method, $petition, $connect)
{
    return $GLOBALS[$controller]($method, $connect, $petition)();
});

def($models, function($model, $method, $petition, $connect)
{
    return $GLOBALS[$model]($method, $connect, $petition);
});

def($routePure, function($route, $controller, $connect, $requestObject, $request_uri, $petition)
{
    def($routePath, function($controller)
    {
        def($controllerAndMethod, explode('@', $controller));
        return [
            "controllerRoute"   => $controllerAndMethod[0],
            "methodRoute"       => $controllerAndMethod[1]
        ];
    });

    def($request_uriFn, function($request_uri)
    {
        def($escapingGetExplode, explode('?', $request_uri));
        return (is_array($escapingGetExplode)) 
            ? $escapingGetExplode[0] 
            : $request_uri;
    });

    def($routeFn, fn($routeString)=> "/" . $routeString);

    def($requestRoute, function($routeRequest, $request_uriFn, $routePath, $requestObject) use ($connect, $petition)
    {
        return iffn(
            fn()=>  $routeRequest == $request_uriFn,
            fn()=>  $requestObject
                (
                    $routePath['controllerRoute'],
                    $routePath['methodRoute'],
                    $petition,
                    $connect
                )
        );
    });

    return $requestRoute
    (
        $routeFn($route), 
        $request_uriFn($request_uri), 
        $routePath($controller), 
        $requestObject
    );
});

def($routeFn, function($route, $controller) use ($connection, $request, $routePure)
{
    return $routePure($route, $controller, $connection, $request, $_SERVER['REQUEST_URI'] ?? null, $_REQUEST);
});

def($routePrint, function($route, $controller) use ($routeFn)
{
    def($routeWithoutPoint, explode('.', $route));

    printFunction($routeFn($routeWithoutPoint[0], $controller));
    #echo(rtrim($routeFn($routeWithoutPoint[0], $controller), '1'));
    #var_dump($routeFn($route, $controller));
});


