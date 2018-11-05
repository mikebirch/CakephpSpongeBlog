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
      '/archive/:year', 
      [
        'controller' => 'BlogPosts',
        'action' => 'archive',
      ],
      [
        'pass' => ['year'],
        'year' => '[0-9]+',
      ]
    );

    $routes->connect(
      '/archive/:year/:month', 
      [
        'controller' => 'BlogPosts',
        'action' => 'archive',
      ],
      [
        'pass' => ['year', 'month'],
        'year' => '[0-9]+',
        'month' => '[0-9]+'
      ]
    );

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