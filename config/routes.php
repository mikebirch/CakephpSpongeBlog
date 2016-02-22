<?php
use Cake\Routing\Router;

Router::plugin(
    'CakephpSpongeBlog',
    ['path' => '/cakephp-sponge-blog'],
    function ($routes) {
        $routes->fallbacks('InflectedRoute');
    }
);
