<?php
session_start();
require_once realpath(__DIR__.'/vendor/autoload.php');
use App\Core\Framework;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Framework();
$app::get('/','Users','index');
$app::post('/','Users','insert');

// SIGNIN
$app::get('/signin','Users','signin');
$app::post('/signin','Users','authenticate');

// LIST USER
$app::get('/list_user','Users','list');
$app::get('/edit/{id}','Users','edit/:id');
$app::post('/update/{id}','Users','update/:id');
$app::delete('/delete/{id}','Users','delete/:id');

$app->run();
?>