<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //De la petición solo requerimos las variables email y password
        $credenciales = $request->only(['email', 'password']);

        //Validar credenciales
        $validator = Validator::make($credenciales, [
            'email'    => 'required',
            'password' => 'required'
        ],[
            "email.required"    => "El email es requerido.",
            "password.required" => "La contraseña es requerida."
        ]);


        if( ! $validator->fails() ) { //Si la validación es correcta
            try {
                $user = Auth::attempt($credenciales); //Se intenta acceder a las credenciales en la BD
                #$token = ... //Atrapar token
                if(!$user){ //Si el usuario no existe
                    return response()->json(
                        [
                            'status'    =>  false,
                            'message'   =>  'Credenciales inválidas',
                        ]
                    );
                }
            } catch (AuthenticationException $e) {
                return response()->json(
                    [
                        'status'    =>  false,
                        'error'     =>  $e->getMessage(),
                        'message'   =>  'Credenciales inválidas',
                    ]
                );
            }

            return response()->json(
                [
                    'status'    =>  true,
                    //'token'     =>  compact('token'),
                    'message'   =>  'Credenciales válidas',
                ]
            );
        }
        else{
            return response()->json(
                [
                    'status'    =>  false,
                    'errors'    =>  $validator->errors(),
                ]
            );
        }
    }

    public function logout(Request $request)
    {
}
