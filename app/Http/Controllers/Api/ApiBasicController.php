<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiBasicController extends Controller
{
    protected $model;

    public function index(Request $request)
    {
        $data = $this->model::all();

        return Response::json([
            'status' => true,
            'data' => $data
        ], 200);  //HTTP 200 Ok
    }

    protected function _store($data)
    {
        try {
            DB::beginTransaction();
            $data = $this->model::create($data);
            DB::commit();

           return $data;
        } catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }

    protected function _show($id)
    {
        $data =  $this->model::findOrFail($id);

        return $data;
    }

    protected function _update($data, $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->model::findOrFail($id)->update($data);
            DB::commit();

           return $data;
        } catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }

    protected function _destroy($id)
    {
        try{
            DB::beginTransaction();
            $data = $this->model::findOrFail($id);
            $data->delete();
            DB::commit();

            return $data;
        }catch (QueryException $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    protected function _search(Request $request, $columns = "*") {

        //$perPage = ( $request->has('per_page') ? intval($request->per_page) : 10 );
        $columnsSearch = ( $request->has('columns_search') ? $request->columns_search : null );
        /*
        $columnsSearch : espera un arreglo con el siguiente formato:
            [
                [ "columnType" => "", "columnName" => "", "comparator" => "", "value" => "" ],
                [ "columnType" => "", "columnName" => "", "comparator" => "", "value" => "" ],
                ...
            ]
        */

        $comparators = [ "exacto" => "=", "contenga" => "like", "entre" => "beetween" ];

        $paginate = $this->model::select($columns);

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

        return $paginate;
    }
}
