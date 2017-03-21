<?php
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('CakephpSpongeBlog',  ['path' => '/news'], function ($routes) {

    $routes->connect('/', [
      'controller' => 'blogPosts',
      'action' => 'index',
    ]);

    $routes->connect('/latest', [
      'controller' => 'blogPosts',
      'action' => 'latest',
    ]);

    $routes->connect(
      '/:slug',
      [
        'controller' => 'blogPosts',
        'action' => 'view'
      ],
      [
        'pass' => ['slug'],
        'slug' => '[a-zA-Z0-9\-\_]+',
      ]
    );

    $routes->fallbacks(DashedRoute::class);

});