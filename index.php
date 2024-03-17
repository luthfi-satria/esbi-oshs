<?php
session_start();
require_once realpath(__DIR__.'/vendor/autoload.php');
use App\Core\Framework;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Framework();
$app::get('/','Users','index');
$app::post('/','Users','insert');
$app::put('/:id','Users','update');
$app::delete('/:id', 'Users', 'delete');

// SIGNIN
$app::get('/signin','Users','signin');
$app::post('/signin','Users','authenticate');

// LIST USER
$app::get('/list_user','Users','list');
$app->run();
?>