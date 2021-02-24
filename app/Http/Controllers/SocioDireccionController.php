<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SocioDireccionController as ApiSocioDireccionController;
use App\Http\Requests\Api\SocioDireccionStoreRequest;
use App\Http\Requests\Api\SocioDireccionUpdateRequest;
use App\Models\SocioDireccion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SocioDireccionController extends ApiSocioDireccionController
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
     * @param \App\Http\Requests\Api\SocioDireccionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioDireccionStoreRequest $request)
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
     * @param \App\Models\SocioDireccion $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioDireccion $sociod)
    {
        $data = parent::show($request, $sociod);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\SocioDireccionUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioDireccion $obj
     * @return \Illuminate\Http\Response
     */
    public function update(SocioDireccionUpdateRequest $request, SocioDireccion $sociod)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $sociod);
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
     * @param \App\Models\SocioDireccion $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioDireccion $sociod)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $sociod);
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
