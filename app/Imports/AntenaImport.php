<?php

namespace App\Imports;

use App\Models\Antena;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;



class AntenaImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $a=Antena::where('codi',$row[3].$row[4])->first();
        if(!$a){
            $a=new Antena();
            $a->codi=$row[3].$row[4];
            $a->radio=$row[0];
            $a->mcc=$row[1];
            $a->net=$row[2];
            $a->area=$row[3];
            $a->cell=$row[4];
            $a->lon=$row[5];
            $a->lat=$row[6];
            $a->range=$row[7];
            $a->potencia=$row[8];
            $a->save();

        }
        return $a;       
        
    }

    
}
