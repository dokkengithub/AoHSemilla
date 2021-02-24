<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\OportunidadActividadStoreRequest;
use App\Http\Requests\Api\OportunidadActividadUpdateRequest;
use App\Models\OportunidadActividad;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadActividadController extends Api\OportunidadActividadController
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
     * @param \App\Http\Requests\Api\OportunidadActividadStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadActividadStoreRequest $request)
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
     * @param \App\Models\OportunidadActividad $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $oportunidada)
    {
        //return $oportunidada;

        $data = OportunidadActividad::findOrFail($oportunidada);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadActividadUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadActividad $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadActividadUpdateRequest $request, $oportunidada)
    {
        try {
            DB::beginTransaction();
            $data = OportunidadActividad::findOrFail($oportunidada);
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
     * @param \App\Models\OportunidadActividad $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadActividad $oportunidada)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidada);
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
