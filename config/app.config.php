<?php

return [
    'routes' =>
    [
        'GET' => [
            '' => 'App\Controllers\PostController@index',
            '/' => 'App\Controllers\PostController@index',
            'posts' => 'App\Controllers\PostController@index',
            'post/create' => 'App\Controllers\PostController@createGet',
            'post/:id' => 'App\Controllers\PostController@show',
        ]
    ]
];
