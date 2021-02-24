<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadSocioNegocioController as ApiOportunidadSocioNegocioController;
use App\Http\Requests\Api\OportunidadSocioNegocioStoreRequest;
use App\Http\Requests\Api\OportunidadSocioNegocioUpdateRequest;
use App\Models\OportunidadSocioNegocio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadSocioNegocioController extends ApiOportunidadSocioNegocioController
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
     * @param \App\Http\Requests\Api\OportunidadSocioNegocioStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadSocioNegocioStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = parent::store($request);
            DB::commit();

            $data["oportunidadp"] = [];
            $data["oportunidadg"] = [];
            $data["oportunidade"] = [];
            $data["oportunidads"] = [];
            $data["oportunidadc"] = [];
            $data["oportunidada"] = [];
            $data["oportunidada"] = [];

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
     * @param \App\Models\OportunidadSocioNegocio $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadSocioNegocio $oportunidads)
    {
        //return $oportunidads;

        $data = parent::show($request, $oportunidads);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadSocioNegocioUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadSocioNegocio $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadSocioNegocioUpdateRequest $request, OportunidadSocioNegocio $oportunidads)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidads);
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
     * @param \App\Models\OportunidadSocioNegocio $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadSocioNegocio $oportunidads)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidads);
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
