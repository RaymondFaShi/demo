<?php
declare( strict_types = 1 );    // 严格模式

use App\Middleware\ValidatorMiddleware;
use Hyperf\HttpServer\Router\Router;

// default
Router::get( '/', function () {
    // tests
    return [ 'code' => 0, 'message' => 'success', 'timestamp' => time() ];
});

/**
 * web路由
 */
Router::addGroup( '/test', function() {
    Router::get( '', [ \App\Controller\Test\Index::class, 'index' ] );

}, [ 'middleware' => [] ] );