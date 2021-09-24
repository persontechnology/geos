<?php

namespace Database\Seeders;

use App\Models\Antena;
use App\Models\Geo;
use App\Models\User;
use Illuminate\Database\Seeder;

class AntenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $g=Geo::find(1);
        if(!$g){
            $g=new Geo();
        }
      
       

        $g->codDispositivo='';
        $g->codMovi='';
        $g->celdaMovi='';
        $g->codClaro='';
        $g->celdaClaro='';
        $g->codCnt='';
        $g->celdaCnt='';
        $g->potenciaMovistar='';
        $g->potenciaClaro='';
        $g->potenciaCnt='';
        $g->tiempoActualizacion='';
        $g->auxlt='-1.254828';
        $g->auxln='-78.623217';
        $g->save();


        // user
        $email='admin@gmail.com';
        $user=User::where('email',$email)->first();
        if(!$user){
            $user=new User();
        }
        $user->name = $email;
        $user->email = $email;
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = 'ok';
        $user->save();
    }

    
}
