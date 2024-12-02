<?php
$router->get('/', [\App\Core\Main::class, 'index']);
$router->get('/login', [App\Controllers\Auth\Login::class, 'displayLoginForm']);
$router->post('/login', [App\Controllers\Auth\Login::class, 'login']);
$router->get('/logout', [App\Controllers\Auth\Logout::class, 'logout']);
$router->get('/upload', [App\Controllers\Media\UploadImage::class, 'displayUploadForm']);
$router->post('/upload', [App\Controllers\Media\UploadImage::class, 'upload']);
$router->get('/signup', [App\Controllers\Auth\Signup::class, 'displaySignupForm']);
$router->post('/signup', [App\Controllers\Auth\Signup::class, 'signup']);
$router->get('/change-password', [App\Controllers\Auth\ChangePassword::class, 'displayChangePasswordForm']);
$router->post('/change-password', [App\Controllers\Auth\ChangePassword::class, 'changePassword']);
$router->get('/profile', [App\Controllers\Auth\Profile::class, 'profile']);
$router->post('/profile', [App\Controllers\Auth\Profile::class, 'changeScreenName']);
