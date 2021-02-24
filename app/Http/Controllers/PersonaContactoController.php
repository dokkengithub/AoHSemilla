<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\PersonaContactoController as ApiPersonaContactoController;
use App\Http\Requests\Api\PersonaContactoStoreRequest;
use App\Http\Requests\Api\PersonaContactoUpdateRequest;
use App\Models\PersonaContacto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class PersonaContactoController extends ApiPersonaContactoController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = parent::index($request);

        return Response::json([
            'status' => true,
            'data' => $list
        ], 200);  //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\PersonaContactoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaContactoStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = parent::store($request);
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $oportunidadpc)
    {
        $data = PersonaContacto::findOrFail($oportunidadpc);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\PersonaContactoUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaContactoUpdateRequest $request, $oportunidadpc)
    {
        try {
            DB::beginTransaction();
            $data = PersonaContacto::findOrFail($oportunidadpc);
            $data->update($request->validated());
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PersonaContacto $oportunidadpc)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidadpc);
            DB::commit();

            return Response::json([
                    'status' => true,
                    'message' => 'El recurso se ha eliminado.'
                ],
                200  //HTTP 204 No Content
            );
        }catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }
}
