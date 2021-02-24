<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadEtapaStoreRequest;
use App\Http\Requests\Api\OportunidadEtapaUpdateRequest;
use App\Models\OportunidadEtapa;
use Illuminate\Http\Request;

class OportunidadEtapaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadEtapas = OportunidadEtapa::all();

        return $oportunidadEtapas;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadEtapaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadEtapaStoreRequest $request)
    {
        $oportunidadEtapa = OportunidadEtapa::create($request->validated());

        return $oportunidadEtapa;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadEtapa $oportunidadEtapa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadEtapa $oportunidadEtapa)
    {
        return $oportunidadEtapa;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadEtapaUpdateRequest $request
     * @param \App\Models\OportunidadEtapa $oportunidadEtapa
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadEtapaUpdateRequest $request, OportunidadEtapa $oportunidadEtapa)
    {
        $oportunidadEtapa->update($request->validated());

        return $oportunidadEtapa;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadEtapa $oportunidadEtapa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadEtapa $oportunidadEtapa)
    {
        $oportunidadEtapa->delete();

        return $oportunidadEtapa;
    }
}
