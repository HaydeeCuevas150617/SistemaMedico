<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct(){
        //$this->middleware('guest',['only'=>'ShowLoginForm']);
    }
    public function ShowLoginForm()
    {
        return view('Auth.login');
    }
    public function login()
    {
        $this->validate(request(),[
            'email'=>'required',
            'password'=>'required'],
            [
                'email.required'=>'El Correo es obligatorio',
                'password.required'=>'La contraseña es obligatoria'
            ]);
        //Autenticacion o inicio de sesion
        if(Auth::attempt(['email' => request()->get('email'), 'password' =>request()->get('password') ])){
            return redirect()->route('indexB');
        }else{
            return \Redirect::to('/')->with('msj','Usuario o Contraseña Incorrecta')
            ->withInput(request(['email']));
        }
    }

    //Funcion para cerrar sesion
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
