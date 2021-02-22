<?php

namespace App\Http\Controllers;

use App\Models\OportunidadH;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OportunidadHController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->modelClass = OportunidadH::class;
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
            'Nombre_Oportunidad' => 'required',
            'Fecha_Inicio' => 'required'
        ], [
            "Nombre_Oportunidad.required" => "El campo es requerido.",
            "Fecha_Inicio.required" => "El campo es requerido."
        ]);

        if( $validator->fails() ) {
            return response()->json([
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

        try {
            DB::beginTransaction();
            $data = $this->modelClass::create($data);
            DB::commit();

            return Response::json([
                    'status' => true,
                    'data' =>  $data,
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
        $data = $this->modelClass::findOrFail($id);

        return Response::json([
            'status' => true,
            'data' => $data
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
            $data = $this->modelClass::findOrFail($id);
            $data->update($request->toArray());

            DB::commit();

            return Response::json([
                    'status' => true,
                    'data' =>  $data,
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

            $data = $this->modelClass::findOrFail($id);
            //$obj->activo = false;
            // $obj->save();  //$data->update(['activo' => false]);
            $data->delete();

            DB::commit();

            return Response::json([
                    'status' => true,
                    'data' =>  $data,
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
