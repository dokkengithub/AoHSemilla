<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadPotencialController as ApiOportunidadPotencialController;
use App\Http\Requests\Api\OportunidadPotencialStoreRequest;
use App\Http\Requests\Api\OportunidadPotencialUpdateRequest;
use App\Models\OportunidadPotencial;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadPotencialController extends ApiOportunidadPotencialController
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
     * @param \App\Http\Requests\Api\OportunidadPotencialStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadPotencialStoreRequest $request)
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
     * @param \App\Models\OportunidadPotencial $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadPotencial $oportunidadp)
    {
        $data = parent::show($request, $oportunidadp);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadPotencialUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadPotencial $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadPotencialUpdateRequest $request, OportunidadPotencial $oportunidadp)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidadp);
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
     * @param \App\Models\OportunidadPotencial $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadPotencial $oportunidadp)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidadp);
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
