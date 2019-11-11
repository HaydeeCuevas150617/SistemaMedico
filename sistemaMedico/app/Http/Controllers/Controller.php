<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
/*Constructor que hará que cada ves que deseen acceder a ese controller 
o alguna de sus funciones, deberan estar authenticados, de lo contrario
 lo redirecciona al Login. */
    public function __construct()
	{
        $this->middleware('auth');
	} 
}
