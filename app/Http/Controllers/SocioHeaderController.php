<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SocioHeaderController as ApiSocioHeaderController;
use App\Http\Requests\Api\SocioHeaderStoreRequest;
use App\Http\Requests\Api\SocioHeaderUpdateRequest;
use App\Models\SocioHeader;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SocioHeaderController extends ApiSocioHeaderController
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
     * @param \App\Http\Requests\Api\SocioHeaderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioHeaderStoreRequest $request)
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
     * @param \App\Models\SocioHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioHeader $socioh)
    {
        $data = parent::show($request, $socioh);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\SocioHeaderUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function update(SocioHeaderUpdateRequest $request, SocioHeader $socioh)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $socioh);
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
     * @param \App\Models\SocioHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioHeader $socioh)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $socioh);
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
