<?php

use App\Models\Antena;
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

Route::get('/obtener-lat-lng', function(){
    $geo=Geo::find(1);
    $data = array('latitude' => $geo->latitud??null,'longitude'=>$geo->longitud??null);
    return response()->json($data);

})->name('obtenerLatLng');



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
        // $data = array(
        //     'codDispositivo'=>$codDispositivo,
        //     'codMovistar'=>$codMovistar,
        //     'codClaro'=>$codClaro,
        //     'codCnt'=>$codCnt,
        //     'potenciaMovistar'=>$potenciaMovistar,
        //     'potenciaClaro'=>$potenciaClaro,
        //     'potemciaCnt'=>$potenciaCnt,
        //     'tiempoActualizacion'=>$tiempoActualizacion,
        // );

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


        // proceso
        $antena_M=Antena::where('Cod',$codMovistar)->first();
        $antena_C=Antena::where('Cod',$codClaro)->first();
        $antena_CNT=Antena::where('Cod',$codCnt)->first();


        $A_CT=1;
        $G_T=15.7;
        $A_CR=1;
        $G_R=2;
        $Pot_M=$potenciaMovistar;
        $Pot_C=$potenciaClaro;
        $Pot_CNT=$potenciaCnt;
        
        $L_50_M=$antena_M->P-$A_CT+$G_T-$A_CR+$G_R-$Pot_M;
        $L_50_C=$antena_C->P-$A_CT+$G_T-$A_CR+$G_R-$Pot_C;
        $L_50_CNT=$antena_CNT->P-$A_CT+$G_T-$A_CR+$G_R-$Pot_CNT;

        $L_50_CNT;
        
        $F_c_M=850;
        $F_c_C=850;
        $F_c_CNT=1900;
        $h_T=60;
        
        $a_M=($L_50_M-69.55-26.16*log10($F_c_M)+13.82*log10($h_T))/(44.9-6.55*log10($h_T));
        $a_C=($L_50_C-69.55-26.16*log10($F_c_C)+13.82*log10($h_T))/(44.9-6.55*log10($h_T));
        $a_CNT=($L_50_CNT-69.55-26.16*log10($F_c_CNT)+13.82*log10($h_T))/(44.9-6.55*log10($h_T));

        
        $d_M= pow(10, $a_M);
        $d_C= pow(10, $a_C);
        $d_CNT= pow(10, $a_CNT);

        //CALCULO DE RADIO DE CIRCUNFERENCIA

        $r1_M=$d_M/111.111;
        $r2_C=$d_C/111.111;
        $r3_CNT=$d_CNT/111.111;

        //ECUACION DE LATITUD Y LONGITUD
        $k1_M=$antena_M->Lat;
        $k2_C=$antena_C->Lat;
        $k3_CNT=$antena_CNT->Lat;

        $h1_M=$antena_M->Long;
        $h2_C=$antena_C->Long;
        $h3_CNT=$antena_CNT->Long;
        

        //latitud

        $ec1=((2*$k1_M)+(2*$k2_C)-(4*$k3_CNT))/((-2*$h1_M)-(2*$h2_C)+(4*$h3_CNT));

        $ec2    =
                ((-pow($h1_M,2)-pow($k1_M,2)+pow($r1_M,2)-pow($h2_C,2)-pow($k2_C,2)+pow($r2_C,2)+(2*pow($h3_CNT,2))
                +(2*pow($k3_CNT,2))-(2*pow($r3_CNT,2)))/((-2*$h1_M)-(2*$h2_C)+(4*$h3_CNT)))-$h1_M;
        
        $f_a1=pow($ec1, 2)+1;
        $f_b1=(2*($ec1*$ec2))-(2*$k1_M);
        $f_c1=(pow($ec2, 2))+pow($k1_M, 2)-pow($r1_M, 2);
        
        $f_ec1=-$f_b1;
        $f_ec2=abs(pow($f_b1, 2)-(4*$f_a1*$f_c1));
        $f_ec3=pow($f_ec2, 1/2);

        $lat=(($f_ec1-$f_ec3)/(2*$f_a1))+0.00417555762;

        
        // longitud

        $ec12=((2*$h1_M)+(2*$h2_C)-(4*$h3_CNT))/((-2*$k1_M)-(2*$k2_C)+(4*$k3_CNT));

        $ec22    =
                ((-pow($h1_M,2)-pow($k1_M,2)+pow($r1_M,2)-pow($h2_C,2)-pow($k2_C,2)+pow($r2_C,2)+(2*pow($h3_CNT,2))
                +(2*pow($k3_CNT,2))-(2*pow($r3_CNT,2)))/((-2*$k1_M)-(2*$k2_C)+(4*$k3_CNT)))-$k2_C;
        
        $f_a12=pow($ec12, 2)+1;
        $f_b12=(2*($ec12*$ec22))-(2*$h2_C);
        $f_c12=(pow($ec22, 2))+pow($h2_C, 2)-pow($r2_C, 2);
        
        $f_ec12=-$f_b12;
        $f_ec22= abs( pow($f_b12, 2)-(4*$f_a12*$f_c12) );
        $f_ec32=pow($f_ec22, 1/2);

        $long=(($f_ec12-$f_ec32)/(2*$f_a12))+0.00417555762;

        $geo->latitud=$lat;
        $geo->longitud=$long;
        $geo->save();

    return json_encode('ok');

});
Route::get('/geo-get',function(){
    return Geo::find(1);
});


Route::get('/dashboard', function () {
    $geo=Geo::find(1);
    
    return view('dashboard',['geo'=>$geo]);

})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
