<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadCompetidorStoreRequest;
use App\Http\Requests\Api\OportunidadCompetidorUpdateRequest;
use App\Models\OportunidadCompetidor;
use Illuminate\Http\Request;

class OportunidadCompetidorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadCompetidors = OportunidadCompetidor::all();

        return $oportunidadCompetidors;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadCompetidorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadCompetidorStoreRequest $request)
    {
        $oportunidadCompetidor = OportunidadCompetidor::create($request->validated());

        return $oportunidadCompetidor;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadCompetidor $oportunidadCompetidor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadCompetidor $oportunidadCompetidor)
    {
        return $OportunidadCompetidor;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadCompetidorUpdateRequest $request
     * @param \App\Models\OportunidadCompetidor $oportunidadCompetidor
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadCompetidorUpdateRequest $request, OportunidadCompetidor $oportunidadCompetidor)
    {
        $oportunidadCompetidor->update($request->validated());

        return $oportunidadCompetidor;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadCompetidor $oportunidadCompetidor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadCompetidor $oportunidadCompetidor)
    {
        $oportunidadCompetidor->delete();

        return $oportunidadCompetidor;
    }
}
