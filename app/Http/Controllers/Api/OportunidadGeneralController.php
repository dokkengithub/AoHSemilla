<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadGeneralStoreRequest;
use App\Http\Requests\Api\OportunidadGeneralUpdateRequest;
use App\Models\OportunidadGeneral;
use Illuminate\Http\Request;

class OportunidadGeneralController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadGenerals = OportunidadGeneral::all();

        return $oportunidadGenerals;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadGeneralStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadGeneralStoreRequest $request)
    {
        $oportunidadGeneral = OportunidadGeneral::create($request->validated());

        return $oportunidadGeneral;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadGeneral $oportunidadGeneral
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadGeneral $oportunidadGeneral)
    {
        return $oportunidadGeneral;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadGeneralUpdateRequest $request
     * @param \App\Models\OportunidadGeneral $oportunidadGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadGeneralUpdateRequest $request, OportunidadGeneral $oportunidadGeneral)
    {
        $oportunidadGeneral->update($request->validated());

        return $oportunidadGeneral;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadGeneral $oportunidadGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadGeneral $oportunidadGeneral)
    {
        $oportunidadGeneral->delete();

        return $oportunidadGeneral;
    }
}
