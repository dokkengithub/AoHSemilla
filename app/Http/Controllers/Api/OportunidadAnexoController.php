<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadAnexoStoreRequest;
use App\Http\Requests\Api\OportunidadAnexoUpdateRequest;
use App\Models\OportunidadAnexo;
use Illuminate\Http\Request;

class OportunidadAnexoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadAnexos = OportunidadAnexo::all();

        return $oportunidadAnexos;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadAnexoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadAnexoStoreRequest $request)
    {
        $oportunidadAnexo = OportunidadAnexo::create($request->validated());

        return $oportunidadAnexo;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadAnexo $oportunidadAnexo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadAnexo $oportunidadAnexo)
    {
        return $oportunidadAnexo;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadAnexoUpdateRequest $request
     * @param \App\Models\OportunidadAnexo $oportunidadAnexo
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadAnexoUpdateRequest $request, OportunidadAnexo $oportunidadAnexo)
    {
        $oportunidadAnexo->update($request->validated());

        return $oportunidadAnexo;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadAnexo $oportunidadAnexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadAnexo $oportunidadAnexo)
    {
        $oportunidadAnexo->delete();

        return $oportunidadAnexo;
    }
}
