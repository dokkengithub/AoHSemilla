<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadAnexoController as ApiOportunidadAnexoController;
use App\Models\OportunidadAnexo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadAnexoController extends ApiOportunidadAnexoController
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @param \App\Models\OportunidadAnexo $oportunidadan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $oportunidadan)
    {
        $data = OportunidadAnexo::findOrFail($oportunidadan);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     *  @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadAnexo $oportunidadan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $oportunidadan)
    {
        try {
            DB::beginTransaction();
            $data = OportunidadAnexo::findOrFail($oportunidadan);
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
     * @param \App\Models\OportunidadAnexo $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadAnexo $obj)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $obj);
            DB::commit();

            return Response::json([
                    'status' => true,
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
