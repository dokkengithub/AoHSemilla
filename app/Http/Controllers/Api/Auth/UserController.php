<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiBasicController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiBasicController
{
    public function __construct()
    {
        //$this->middleware('auth:api'); //->except('index');
        $this->model = User::class;
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . request()->get('id'),
                'password' => 'required|string|min:6|confirmed',  //'required|string|min:6|confirmed',
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

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        try {
            $data = parent::_store($data);

            return Response::json([
                    'status' => true,
                    'data' =>  $data,
                    'message' => 'El recurso se ha creado.'
                ],
                201 //HTTP 201 Object created
            );
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function show($id)
    {
        $data = parent::_show($id);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $status = parent::_update($request->validated(), $id);
            $data = parent::_show($id);

            return Response::json([
                    'status' => $status,
                    'data' =>  $data,
                    'message' => 'El recurso se actualizó.'
                ],
                201 //HTTP 201 Object created
            );
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try{
            parent::_destroy($id);

            return Response::json([
                    'status' => true,
                    'message' => 'El recurso se ha eliminado.'
                ],
                200  //HTTP 204 No Content
            );
        }catch (QueryException $e) {
            throw $e;
        }
    }
}
