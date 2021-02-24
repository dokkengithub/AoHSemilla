<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OportunidadHeaderController as ApiOportunidadHeaderController;
use App\Http\Requests\Api\OportunidadHeaderStoreRequest;
use App\Http\Requests\Api\OportunidadHeaderUpdateRequest;
use App\Models\OportunidadHeader;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OportunidadHeaderController extends ApiOportunidadHeaderController
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
     * @param \App\Http\Requests\Api\OportunidadHeaderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadHeaderStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = parent::store($request);
            DB::commit();

            $data["oportunidada"] = [];
            $data["oportunidadan"] = [];
            $data["oportunidadc"] = [];
            $data["oportunidade"] = [];
            $data["oportunidadg"] = [];
            $data["oportunidadp"] = [];
            $data["oportunidads"] = [];

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
     * @param \App\Models\OportunidadHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $oportunidadh)
    {
        $data =  OportunidadHeader::with([
            'oportunidadas',
            'oportunidadns',
            'oportunidadcs',
            'oportunidades',
            'oportunidadgs',
            'oportunidadp',
            'oportunidadss'
        ])->find($oportunidadh);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadHeaderUpdateRequest $request
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadHeaderUpdateRequest $request, OportunidadHeader $oportunidadh)
    {
        try {
            DB::beginTransaction();
            $data = parent::update($request, $oportunidadh);
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
     * @param \App\Models\OportunidadHeader $obj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadHeader $oportunidadh)
    {
        try{
            DB::beginTransaction();
            $data = parent::destroy($request, $oportunidadh);
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
