<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadHeaderStoreRequest;
use App\Http\Requests\Api\OportunidadHeaderUpdateRequest;
use App\Models\OportunidadHeader;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OportunidadHeaderController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->model = OportunidadHeader::class;
    }

    public function index(Request $request)
    {
        $table = new $this->model();
        $comparatorsName = [ "contenga", "entre", "exacto" ];

        $columnsTable = $table->getColumnsTable();

        $data = [
            'comparatorsName' => $comparatorsName,
            'columnsTable' => $columnsTable,
        ];

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200);  //HTTP 200 Ok
    }

    public function store(OportunidadHeaderStoreRequest $request)
    {
        try {
            $data = parent::_store($request->validated());

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

    public function show($id)
    {
        $data = $this->model::with([
            'oportunidadas',
            'oportunidadans',
            'oportunidadcs',
            'oportunidades',
            'oportunidadgs',
            'oportunidadp',
            'oportunidadss'
        ])->findOrFail($id);

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200); //HTTP 200 Ok
    }

    public function update(OportunidadHeaderUpdateRequest $request, $id)
    {
        try {
            $status = parent::_update($request->validated(), $id);

            $data = $this->model::with([
                'oportunidadas',
                'oportunidadans',
                'oportunidadcs',
                'oportunidades',
                'oportunidadgs',
                'oportunidadp',
                'oportunidadss'
            ])->findOrFail($id);

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

        $paginate = $paginate->orderBy('created_at')
            ->orderBy('nombre_oportunidad')
            ->paginate($perPage);

        return Response::json($paginate, 200);
    }

}
