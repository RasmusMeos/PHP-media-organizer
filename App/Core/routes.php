<?php
use App\Core\Middleware\GuestMiddleware;
use App\Core\Middleware\AuthMiddleware;

$router->get('/', [App\Core\Main::class, 'index']);
$router->get('/login', [App\Controllers\Auth\Login::class, 'displayLoginForm'], GuestMiddleware::class);
$router->post('/login', [App\Controllers\Auth\Login::class, 'login'], GuestMiddleware::class);
$router->get('/logout', [App\Controllers\Auth\Logout::class, 'logout'], AuthMiddleware::class);
$router->get('/upload', [App\Controllers\Media\UploadImage::class, 'displayUploadForm'], AuthMiddleware::class);
$router->post('/upload', [App\Controllers\Media\UploadImage::class, 'upload'], AuthMiddleware::class);
$router->get('/signup', [App\Controllers\Auth\Signup::class, 'displaySignupForm'], GuestMiddleware::class);
$router->post('/signup', [App\Controllers\Auth\Signup::class, 'signup'], GuestMiddleware::class);
$router->get('/change-password', [App\Controllers\Auth\ChangePassword::class, 'displayChangePasswordForm'], AuthMiddleware::class);
$router->post('/change-password', [App\Controllers\Auth\ChangePassword::class, 'changePassword'], AuthMiddleware::class);
$router->get('/profile', [App\Controllers\Auth\Profile::class, 'profile'], AuthMiddleware::class);
$router->post('/profile', [App\Controllers\Auth\Profile::class, 'changeScreenName'], AuthMiddleware::class);
$router->delete('/delete-image', [App\Controllers\Media\DeleteImage::class, 'deleteImage'], AuthMiddleware::class);
$router->post('/favourite-image', [App\Controllers\Media\FavouriteImage::class, 'toggleFavourite'], AuthMiddleware::class);
$router->get('/favourites', [App\Controllers\Favourites\Favourites::class, 'index'], AuthMiddleware::class);
$router->post('/rename-media', [App\Controllers\Media\RenameMedia::class, 'rename'], AuthMiddleware::class);
$router->get('/albums', [App\Controllers\Folders\Albums::class, 'index'], AuthMiddleware::class);
$router->post('/create-folder', [App\Controllers\Folders\CreateAlbum::class, 'createFolder'], AuthMiddleware::class);
$router->post('/edit-folder', [App\Controllers\Folders\EditAlbum::class, 'edit'], AuthMiddleware::class);

