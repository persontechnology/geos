<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AntenaImport;
class AppController extends Controller
{
    public function import(Request $request) 
    {
        Excel::import(new AntenaImport, $request->file('antenas'));
        return redirect()->route('antenas');
    }
}
