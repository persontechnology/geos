<?php

use App\Http\Controllers\AppController;
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



Route::get('/camara', function () {
    return view('camara');
});


Route::get('/antenas',function(){
    return view('antenas',['antenas'=>Antena::latest()->paginate(20)]);
})->name('antenas');
Route::post('/antenas-guardar',[AppController::class,'import'])->name('antenas-guardar');


Route::get('/obtener-lat-lng', function(){
    $geo=Geo::latest()->first();
    $data = array('latitude' => $geo->auxlt??0,'longitude'=>$geo->auxln??0);
    return response()->json($data);

})->name('obtenerLatLng');



//routes para geo
Route::get(
    'datos-geo/{codDispositivo}/{codMovi}/{celdaMovi}/{codClaro}/{celdaClaro}/{codCnt}/{celdaCnt}/{potenciaMovistar}/{potenciaClaro}/{potenciaCnt}/{tiempo}/{auxlt}/{auxln}'
    , function (
        $codDispositivo,
        $codMovi,
        $celdaMovi,
        $codClaro,
        $celdaClaro,
        $codCnt,
        $celdaCnt,
        $potenciaMovistar,
        $potenciaClaro,
        $potenciaCnt,
        $tiempo,
        $auxlt,
        $auxln
    ) {        
       // proceso
        $antena_M=Antena::where('codi',$codMovi.$celdaMovi)->first();
        $antena_C=Antena::where('codi',$codClaro.$celdaClaro)->first();
        $antena_CNT=Antena::where('codi',$codCnt.$celdaCnt)->first();

         if($antena_M && $antena_C && $antena_CNT){

            $g=new Geo();
            $g->codDispositivo=$codDispositivo;
            $g->codMovi=$codMovi;
            $g->celdaMovi=$celdaMovi;
            $g->codClaro=$codClaro;
            $g->celdaClaro=$celdaClaro;
            $g->codCnt=$codCnt;
            $g->celdaCnt=$celdaCnt;
            $g->potenciaMovistar=$potenciaMovistar;
            $g->potenciaClaro=$potenciaClaro;
            $g->potenciaCnt=$potenciaCnt;
            $g->tiempoActualizacion=$tiempo;
       
            $g->save();



            $A_CT=1;
            $G_T=15.7;
            $A_CR=1;
            $G_R=2;
            $Pot_M=$potenciaMovistar;
            $Pot_C=$potenciaClaro;
            $Pot_CNT=$potenciaCnt;
            
            $L_50_M=$antena_M->potencia-$A_CT+$G_T-$A_CR+$G_R-$Pot_M;
            $L_50_C=$antena_C->potencia-$A_CT+$G_T-$A_CR+$G_R-$Pot_C;
            $L_50_CNT=$antena_CNT->potencia-$A_CT+$G_T-$A_CR+$G_R-$Pot_CNT;

            $L_50_CNT;
            
            $F_c_M=850;
            $F_c_C=850;
            $F_c_CNT=850;
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
            $k1_M=$antena_M->lat;
            $k2_C=$antena_C->lat;
            $k3_CNT=$antena_CNT->lat;

            $h1_M=$antena_M->lon;
            $h2_C=$antena_C->lon;
            $h3_CNT=$antena_CNT->lon;
            
            // lat

            $ec1=((2*$k1_M)+(2*$k2_C)-(4*$k3_CNT))/((-2*$h1_M)-(2*$h2_C)+(4*$h3_CNT));

            $ec2    =
                    ((pow($h1_M,2)+pow($k1_M,2)-pow($r1_M,2)+pow($h2_C,2)+pow($k2_C,2)-pow($r2_C,2)-(2*pow($h3_CNT,2))
                    -(2*pow($k3_CNT,2))+(2*pow($r3_CNT,2)))/((-2*$h1_M)-(2*$h2_C)+(4*$h3_CNT)))+$h1_M;
            
            $f_a1=pow($ec1, 2)+1;
            $f_b1=-((2*($ec1*$ec2))+(2*$k1_M));
            $f_c1=pow($ec2, 2)+pow($k1_M, 2)-pow($r1_M, 2);

            $lat=(-$f_b1-sqrt(pow($f_b1,2)-4*$f_a1*$f_c1))/(2*$f_a1);

            
        //    long

            $ec12=((2*$h1_M)+(2*$h2_C)-(4*$h3_CNT))/((-2*$k1_M)-(2*$k2_C)+(4*$k3_CNT));

            $ec22    =
                    ((pow($h1_M,2)+pow($k1_M,2)-pow($r1_M,2)+pow($h2_C,2)+pow($k2_C,2)-pow($r2_C,2)-(2*pow($h3_CNT,2))
                    -(2*pow($k3_CNT,2))+(2*pow($r3_CNT,2)))/((-2*$k1_M)-(2*$k2_C)+(4*$k3_CNT)))+$k2_C;
            
            $f_a12=pow($ec12, 2)+1;
            $f_b12=-((2*($ec12*$ec22))+(2*$h2_C));
            $f_c12=(pow($ec22, 2))+pow($h2_C, 2)-pow($r2_C, 2);
            
           

            $long=(-$f_b12-sqrt(pow($f_b12,2-4*$f_a12*$f_c12)))/(2*$f_a12);

            
            $g->auxlt=(float)number_format($lat,7,'.',''); //-0.0189163
            $g->auxln=(float)number_format($long,7,'.','');//-0.3441808;
            $g->save();
        }

    return json_encode('ok');

});
Route::get('/geo-get',function(){
    $geo= Geo::latest()->first();
    $data = array(
        'codDispositivo'=>$geo->codDispositivo,
        'codMovi'=>$geo->codMovi,
        'celdaMovi'=>$geo->celdaMovi,
        'codClaro'=>$geo->codClaro,
        'celdaClaro'=>$geo->celdaClaro,
        'codCnt'=>$geo->codCnt,
        'celdaCnt'=>$geo->celdaCnt,
        'potenciaMovistar'=>$geo->potenciaMovistar,
        'potenciaClaro'=>$geo->potenciaClaro,
        'potenciaCnt'=>$geo->potenciaCnt,
        'tiempoActualizacion'=>$geo->tiempoActualizacion,
        'auxlt'=>$geo->auxlt,
        'auxln'=>$geo->auxln,
        'created_at'=>$geo->created_at->diffForHumans(),
    );
    return $data;
});
Route::get('/historial',function(){
    return view('historial',['geos'=>Geo::latest()->paginate(20)]);
})->name('historial');

Route::get('/vaciar-antenas',function(){
    $ul=Antena::latest()->first();
    Antena::where('id','!=',$ul->id)->delete();
    return redirect()->route('antenas');
})->name('vaciarAntenas');

Route::get('/vaciar',function(){
    $ul=Geo::latest()->first();
    Geo::where('id','!=',$ul->id)->delete();
    return redirect()->route('historial');
})->name('vaciar');


Route::get('/dashboard', function () {
    $geo=Geo::latest()->first();
    
    return view('dashboard',['geo'=>$geo]);

})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
