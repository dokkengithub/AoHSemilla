<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadSocioNegocioStoreRequest;
use App\Http\Requests\Api\OportunidadSocioNegocioUpdateRequest;
use App\Models\OportunidadSocioNegocio;
use Illuminate\Http\Request;

class OportunidadSocioNegocioController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadSocioNegocios = OportunidadSocioNegocio::all();

        return $oportunidadSocioNegocios;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadSocioNegocioStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadSocioNegocioStoreRequest $request)
    {
        $oportunidadSocioNegocio = OportunidadSocioNegocio::create($request->validated());

        return $oportunidadSocioNegocio;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadSocioNegocio $oportunidadSocioNegocio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadSocioNegocio $oportunidadSocioNegocio)
    {
        return $oportunidadSocioNegocio;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadSocioNegocioUpdateRequest $request
     * @param \App\Models\OportunidadSocioNegocio $oportunidadSocioNegocio
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadSocioNegocioUpdateRequest $request, OportunidadSocioNegocio $oportunidadSocioNegocio)
    {
        $oportunidadSocioNegocio->update($request->validated());

        return $oportunidadSocioNegocio;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadSocioNegocio $oportunidadSocioNegocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadSocioNegocio $oportunidadSocioNegocio)
    {
        $oportunidadSocioNegocio->delete();

        return $oportunidadSocioNegocio;
    }
}
