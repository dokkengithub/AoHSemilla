<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadCompetidorController as ApiOportunidadCompetidorController;
use App\Http\Requests\Api\OportunidadCompetidorStoreRequest;
use App\Http\Requests\Api\OportunidadCompetidorUpdateRequest;
use App\Models\OportunidadCompetidor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadCompetidorController extends ApiOportunidadCompetidorController
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
     * @param \App\Http\Requests\Api\OportunidadCompetidorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadCompetidorStoreRequest $request)
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
     * @param \App\Models\OportunidadCompetidor $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadCompetidor $oportunidadc)
    {
        $data = parent::show($request, $oportunidadc);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadCompetidorUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadCompetidor $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadCompetidorUpdateRequest $request, OportunidadCompetidor $oportunidadc)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidadc);
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
     * @param \App\Models\OportunidadCompetidor $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadCompetidor $oportunidadc)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidadc);
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
