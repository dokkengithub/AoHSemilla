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
use Illuminate\Support\Str;

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

    public function search(Request $request) {

        $perPage = ( $request->has('per_page') ? intval($request->per_page) : 10 );
        $columnsSearch = ( $request->has('columns_search') ? $request->columns_search : null );
        /*
        $columnsSearch : espera un arreglo con el siguiente formato:
            [
                [ "columnType" => "", "columnName" => "", "comparator" => "", "value" => "" ],
                [ "columnType" => "", "columnName" => "", "comparator" => "", "value" => "" ],
                ...
            ]
        */

        $comparators = ["exacto" => "=", "contenga" => "like", "entre" => "beetween"];

        $paginate = OportunidadHeader::select("*");

        if(is_array($columnsSearch)) {
            if(count($columnsSearch) > 0){

                $paginate = $paginate->where(function($q) use ($columnsSearch, $comparators) {
                    foreach($columnsSearch as $column) {
                        $cname = $column["columnName"];
                        $c = $comparators[ $column["comparator"] ];

                        if( $c == '=' || $c == 'like'  ) {
                            $value = ( $c == '=' ? $column["value"]  : "%" . $column["value"] . "%" );
                            $q->orWhere($cname, $c, $value);
                        }else{
                            $range_bw = ( $column["value"] ? Str::of( $column["value"] )->trim()->explode('|')->all() : [' ', ' '] );
                            $q->orWhereBetween($cname, $range_bw);
                        }
                    }
                });
            }
        }

        $paginate = $paginate->orderBy('created_at')
            ->orderBy('nombre_oportunidad')
            ->paginate($perPage);

        return Response::json($paginate, 200);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table = new OportunidadHeader();
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
        ])->findOrFail($oportunidadh);

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
    public function update(OportunidadHeaderUpdateRequest $request, $oportunidadh)
    {
        try {
            DB::beginTransaction();
            $data = OportunidadHeader::findOrFail($oportunidadh);
            $data->update($request->validated());
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
