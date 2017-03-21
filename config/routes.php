<?php
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('CakephpSpongeBlog',  ['path' => '/news'], function ($routes) {

    $routes->connect('/', [
      'controller' => 'BlogPosts',
      'action' => 'index',
    ]);

    $routes->connect('/latest', [
      'controller' => 'BlogPosts',
      'action' => 'latest',
    ]);

    $routes->connect(
      '/:slug',
      [
        'controller' => 'BlogPosts',
        'action' => 'view'
      ],
      [
        'pass' => ['slug'],
        'slug' => '[a-zA-Z0-9\-\_]+',
      ]
    );

    $routes->fallbacks(DashedRoute::class);

});