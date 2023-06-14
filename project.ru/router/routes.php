<?php

use App\Services\Router;
use App\Controllers\Auth;

Router::page('/login', 'login');
Router::page('/register', 'register');
Router::page('/', 'home');
Router::page('/profile', 'profile');
Router::page('/singin', 'singin');
Router::page('/singup', 'singup');

Router::post('/auth/register', Auth::class, 'register', true);
Router::post('/auth/login', Auth::class, 'login', true);
Router::post('/auth/logout', Auth::class, 'logout');

Router::enable();