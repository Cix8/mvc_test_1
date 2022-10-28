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
            'post/update/:id' => 'App\Controllers\PostController@edit',
        ],
        'POST' => [
            'post/create' =>  'App\Controllers\PostController@create',
            'post/delete/:id' => 'App\Controllers\PostController@delete',
            'post/update/:id' => 'App\Controllers\PostController@update',
            'comment/delete/:id' => 'App\Controllers\CommentController@delete',
        ]
    ]
];
