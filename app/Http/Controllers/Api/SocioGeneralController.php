<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocioGeneralStoreRequest;
use App\Http\Requests\Api\SocioGeneralUpdateRequest;
use App\Models\SocioGeneral;
use Illuminate\Http\Request;

class SocioGeneralController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $socioGenerals = SocioGeneral::all();

        return $socioGenerals;
    }

    /**
     * @param \App\Http\Requests\Api\SocioGeneralStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioGeneralStoreRequest $request)
    {
        $socioGeneral = SocioGeneral::create($request->validated());

        return $socioGeneral;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioGeneral $socioGeneral
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioGeneral $socioGeneral)
    {
        return $socioGeneral;
    }

    /**
     * @param \App\Http\Requests\Api\SocioGeneralUpdateRequest $request
     * @param \App\Models\SocioGeneral $socioGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(SocioGeneralUpdateRequest $request, SocioGeneral $socioGeneral)
    {
        $socioGeneral->update($request->validated());

        return $socioGeneral;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioGeneral $socioGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioGeneral $socioGeneral)
    {
        $socioGeneral->delete();

        return $socioGeneral;
    }
}
