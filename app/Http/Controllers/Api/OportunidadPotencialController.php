<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadPotencialStoreRequest;
use App\Http\Requests\Api\OportunidadPotencialUpdateRequest;
use App\Models\OportunidadPotencial;
use Illuminate\Http\Request;

class OportunidadPotencialController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadPotencials = OportunidadPotencial::all();

        return $oportunidadPotencials;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadPotencialStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadPotencialStoreRequest $request)
    {
        $oportunidadPotencial = OportunidadPotencial::create($request->validated());

        return $oportunidadPotencial;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadPotencial $oportunidadPotencial
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadPotencial $oportunidadPotencial)
    {
        return $oportunidadPotencial;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadPotencialUpdateRequest $request
     * @param \App\Models\OportunidadPotencial $oportunidadPotencial
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadPotencialUpdateRequest $request, OportunidadPotencial $oportunidadPotencial)
    {
        $oportunidadPotencial->update($request->validated());

        return $oportunidadPotencial;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadPotencial $oportunidadPotencial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadPotencial $oportunidadPotencial)
    {
        $oportunidadPotencial->delete();

        return $oportunidadPotencial;
    }
}
