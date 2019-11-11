<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Carrera;

class CarreraController extends Controller
{
    public function indexCa(Request $request)
    {
         $regCarreras=DB::table('carrera')
        ->select( 'carrera.id_carrera','carrera.nombre','carrera.created_at')
        //->where('carrera.nombre', 'like', '%'.$request->nombre.'%')
        //->where('carrera.created_at', 'like', '%'.$request->fecha.'%')
        ->get();
        return view('carrera',compact('regCarreras'));
    }
}
