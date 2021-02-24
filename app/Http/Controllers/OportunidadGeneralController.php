<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadGeneralController as ApiOportunidadGeneralController;
use App\Http\Requests\Api\OportunidadGeneralStoreRequest;
use App\Http\Requests\Api\OportunidadGeneralUpdateRequest;
use App\Models\OportunidadGeneral;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadGeneralController extends ApiOportunidadGeneralController
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
     * @param \App\Http\Requests\Api\OportunidadGeneralStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadGeneralStoreRequest $request)
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
     * @param \App\Models\OportunidadGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadGeneral $oportunidadg)
    {
        $data = parent::show($request, $oportunidadg);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadGeneralUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadGeneralUpdateRequest $request, OportunidadGeneral $oportunidadg)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidadg);
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
     * @param \App\Models\OportunidadGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadGeneral $oportunidadg)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidadg);
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
