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
            'auth/login' => 'App\Controllers\LoginController@showLogin',
            'auth/register' => 'App\Controllers\LoginController@showRegister'
        ],
        'POST' => [
            'post/create' =>  'App\Controllers\PostController@create',
            'post/delete/:id' => 'App\Controllers\PostController@delete',
            'post/update/:id' => 'App\Controllers\PostController@update',
            'comment/create' => 'App\Controllers\CommentController@create',
            'comment/delete/:id' => 'App\Controllers\CommentController@delete',
            'auth/login' => 'App\Controllers\LoginController@login',
            'auth/register' => 'App\Controllers\LoginController@register'
        ]
    ]
];
