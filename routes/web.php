<?php

use App\Models\Geo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('crudbooster:install');
    return 'ok';
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    // Artisan::call('migrate:fresh --seed');
});
Route::get('/', function () {
    return view('welcome');
});

//routes para geo
Route::get(
    'datos-geo/{codDispositivo}/{codMovistar}/{codClaro}/{codCnt}/{potenciaMovistar}/{potenciaClaro}/{potenciaCnt}/{tiempoActualizacion}'
    , function (
        $codDispositivo,
        $codMovistar,
        $codClaro,
        $codCnt,
        $potenciaMovistar,
        $potenciaClaro,
        $potenciaCnt,
        $tiempoActualizacion
    ) {
        $data = array(
            'codDispositivo'=>$codDispositivo,
            'codMovistar'=>$codMovistar,
            'codClaro'=>$codClaro,
            'codCnt'=>$codCnt,
            'potenciaMovistar'=>$potenciaMovistar,
            'potenciaClaro'=>$potenciaClaro,
            'potemciaCnt'=>$potenciaCnt,
            'tiempoActualizacion'=>$tiempoActualizacion,
        );

        $geo=Geo::find(1);
        if(!$geo){
            $geo=new Geo();
        }
        $geo->codDispositivo=$codDispositivo??'-';
        $geo->codMovistar=$codMovistar??'-';
        $geo->codClaro=$codClaro??'-';
        $geo->codCnt=$codCnt??'-';
        $geo->potenciaMovistar=$potenciaMovistar??'-';
        $geo->potenciaClaro=$potenciaClaro??'-';
        $geo->potemciaCnt=$potenciaCnt??'-';
        $geo->tiempoActualizacion=$tiempoActualizacion??'-';
        $geo->save();
});
Route::get('/geo-get',function(){
    return Geo::find(1);
});