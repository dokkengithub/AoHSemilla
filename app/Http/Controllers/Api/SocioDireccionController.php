<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocioDireccionStoreRequest;
use App\Http\Requests\Api\SocioDireccionUpdateRequest;
use App\Models\SocioDireccion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SocioDireccionController extends ApiBasicController
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->model = SocioDireccion::class;
    }

    public function store(SocioDireccionStoreRequest $request)
    {
        try {
            $data = parent::_store($request->validated());

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

    public function show($id)
    {
        $data = parent::_show($id);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    public function update(SocioDireccionUpdateRequest $request, $id)
    {
        try {
            $status = parent::_update($request->validated(), $id);
            $data = parent::_show($id);

            return Response::json([
                    'status' => $status,
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

    public function destroy(Request $request, $id)
    {
        try{
            parent::_destroy($id);

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

    public function search(Request $request)
    {
        $perPage = ( $request->has('per_page') ? intval($request->per_page) : 10 );

        $paginate = parent::_search($request);

        $paginate = $paginate->paginate($perPage);

        return Response::json($paginate, 200);
    }
}
