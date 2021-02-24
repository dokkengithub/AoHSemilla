<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SocioPersonaContactoController as ApiSocioPersonaContactoController;
use App\Http\Requests\Api\SocioPersonaContactoStoreRequest;
use App\Http\Requests\Api\SocioPersonaContactoUpdateRequest;
use App\Models\SocioPersonaContacto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SocioPersonaContactoController extends ApiSocioPersonaContactoController
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
     * @param \App\Http\Requests\Api\SocioPersonaContactoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioPersonaContactoStoreRequest $request)
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
     * @param \App\Models\SocioPersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioPersonaContacto $sociopc)
    {
        $data = parent::show($request, $sociopc);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\SocioPersonaContactoUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioPersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function update(SocioPersonaContactoUpdateRequest $request, SocioPersonaContacto $sociopc)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $sociopc);
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
     * @param \App\Models\SocioPersonaContacto $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioPersonaContacto $sociopc)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $sociopc);
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
