<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SocioGeneralController as ApiSocioGeneralController;
use App\Http\Requests\Api\SocioGeneralStoreRequest;
use App\Http\Requests\Api\SocioGeneralUpdateRequest;
use App\Models\SocioGeneral;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SocioGeneralController extends ApiSocioGeneralController
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
     * @param \App\Http\Requests\Api\SocioGeneralStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioGeneralStoreRequest $request)
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
     * @param \App\Models\SocioGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioGeneral $sociog)
    {
        $data = parent::show($request, $sociog);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\SocioGeneralUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function update(SocioGeneralUpdateRequest $request, SocioGeneral $sociog)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $sociog);
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
     * @param \App\Models\SocioGeneral $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioGeneral $sociog)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $sociog);
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
