<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadEtapaController as ApiOportunidadEtapaController;
use App\Http\Requests\Api\OportunidadEtapaStoreRequest;
use App\Http\Requests\Api\OportunidadEtapaUpdateRequest;
use App\Models\OportunidadEtapa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadEtapaController extends ApiOportunidadEtapaController
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
     * @param \App\Http\Requests\Api\OportunidadEtapaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadEtapaStoreRequest $request)
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
     * @param \App\Models\OportunidadEtapa $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadEtapa $oportunidade)
    {
        $data = parent::show($request, $oportunidade);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadEtapaUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadEtapa $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadEtapaUpdateRequest $request, OportunidadEtapa $oportunidade)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidade);
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
     * @param \App\Models\OportunidadEtapa $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadEtapa $oportunidade)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidade);
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
