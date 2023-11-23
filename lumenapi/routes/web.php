<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return Str::random(32);
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->get('/mahasiswa', 'MahasiswaController@getAllMahasiswa');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/mahasiswa/profile', 'MahasiswaController@getMahasiswaByToken');
    $router->post('/mahasiswa/matakuliah/{mkId}', 'MataKuliahController@postMataKuliah');
    $router->put('/mahasiswa/matakuliah/{mkId}', 'MataKuliahController@putMataKuliah');
});

$router->get('/mahasiswa/{nim}', 'MahasiswaController@getMahasiswaByNim');

$router->get('/prodi', 'ProdiController@getAllProdi');

$router->get('/matakuliah', 'MataKuliahController@getAllMataKuliah');