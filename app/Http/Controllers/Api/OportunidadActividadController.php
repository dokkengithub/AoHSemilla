<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadActividadStoreRequest;
use App\Http\Requests\Api\OportunidadActividadUpdateRequest;
use App\Models\OportunidadActividad;
use Illuminate\Http\Request;

class OportunidadActividadController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadActividads = OportunidadActividad::all();

        return $oportunidadActividads;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadActividadStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadActividadStoreRequest $request)
    {
        $oportunidadActividad = OportunidadActividad::create($request->validated());

        return $oportunidadActividad;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadActividad $oportunidadActividad
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadActividad $oportunidadActividad)
    {
        return $oportunidadActividad;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadActividadUpdateRequest $request
     * @param \App\Models\OportunidadActividad $oportunidadActividad
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadActividadUpdateRequest $request, OportunidadActividad $oportunidadActividad)
    {
        $oportunidadActividad->update($request->validated());

        return $oportunidadActividad;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadActividad $oportunidadActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadActividad $oportunidadActividad)
    {
        $oportunidadActividad->delete();

        return $oportunidadActividad;
    }
}
