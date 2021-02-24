<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->modelClass = User::class;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,' . (request()->get('id')?:null),
                'password' => 'required|string|min:6|confirmed',
            ],[
                'name.required' => 'El nombre de usuario es requerido.',
                'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
                'name.max' => 'El nombre de usuario debe contener 255 caracteres como máximo.',

                'email.required' => 'El email es requerido',
                'email.string' => 'El email debe ser una cadena de texto.',
                'email.email' => 'El email no tiene un formato adecuado.',
                'email.max' => 'El email debe contener 255 caracteres como máximo.',

                'password.required' => 'El password es requerido',
                'password.string' => 'El password debe ser una cadena de texto.',
                'password.min' => 'El password debe contener como mínimo 6 caracteres.',
                'password.confirmed' => 'El password no se ha confirmado.',
            ]
        );

        if( $validator->fails() ) {
            return Response::json([
                    'status'    =>  false,
                    'errors'    =>  $validator->errors(),
                ],
                422  //HTTP 422 Unprocessable Entity
            );
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->modelClass::all();

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200);  //HTTP 201 Ok
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validator($data);

        $data['password'] = Hash::make($data['password']);

        try {
            DB::beginTransaction();
            $obj = $this->modelClass::create($data);
            DB::commit();

            return Response::json([
                    'status' => true,
                    //'token'     =>  compact('token'),
                    'data' =>  $obj,
                    'message' => 'El recurso se ha creado.'
                ],
                201 //HTTP 201 Object created
            );
        } catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = User::findOrFail($id);

        return Response::json([
            'status' => true,
            'data' => $obj
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validator($data);

        try {
            DB::beginTransaction();
            $obj = $this->modelClass::findOrFail($id);
            $obj->update($data);
            DB::commit();

            return Response::json([
                    'status' => true,
                    'data' =>  $obj,
                    'message' => 'El recurso se actualizó.'
                ],
                201 //HTTP 201 Object created
            );
        } catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $obj = $this->modelClass::findOrFail($id);
            //$obj->activo = false;
            // $obj->save();  //$data->update(['activo' => false]);
            //$obj->delete();

            DB::commit();

            return Response::json([
                    'status' => true,
                    'data' =>  $obj,
                    'message' => 'El recurso se ha eliminado.'
                ],
                200
            );
        }catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }
}
