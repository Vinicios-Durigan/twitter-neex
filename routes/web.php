<?php

use Illuminate\Support\Facades\Route;




//Tela de Login
Route::get('/', 'App\Http\Controllers\UsersController@login');
Route::get('/login', 'App\Http\Controllers\UsersController@login');
Route::post('/login', 'App\Http\Controllers\UsersController@verificaLogin')->name('verifica_login');

//Tela de Cadastro
Route::get('/signup', 'App\Http\Controllers\UsersController@signup');
Route::post('/signup', 'App\Http\Controllers\UsersController@criarNovoUsuario')->name('criar_usuario');

//Tela de Dashboard
Route::get('/dashboard/{id}', 'App\Http\Controllers\DashboardController@dashboard');
Route::get('/dashboardsecundaria/{id}', 'App\Http\Controllers\DashboardController@dashboardsecundaria');
//Publicação
Route::post('/dashboard/{id}', 'App\Http\Controllers\PublicacoesController@criarPublicacao')->name('criar_publicacao');




Route::get('/seguirusuario/{id}', 'App\Http\Controllers\SeguidoresController@seguirUsuario')->name('seguir_usuario');
Route::get('/criarComentario/{id}', 'App\Http\Controllers\ComentariosController@criarComentario')->name('criar_comentario');
Route::get('/criarcomentariosecundario/{id}', 'App\Http\Controllers\ComentariosController@criarComentarioSecundario')->name('criar_comentario');

