<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OportunidadHeaderStoreRequest;
use App\Http\Requests\Api\OportunidadHeaderUpdateRequest;
use App\Models\OportunidadHeader;
use Illuminate\Http\Request;

class OportunidadHeaderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $oportunidadHeaders = OportunidadHeader::all();

        return $oportunidadHeaders;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadHeaderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OportunidadHeaderStoreRequest $request)
    {
        $oportunidadHeader = OportunidadHeader::create($request->validated());

        return $oportunidadHeader;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadHeader $oportunidadHeader
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OportunidadHeader $oportunidadHeader)
    {
        return $oportunidadHeader;
    }

    /**
     * @param \App\Http\Requests\Api\OportunidadHeaderUpdateRequest $request
     * @param \App\Models\OportunidadHeader $oportunidadHeader
     * @return \Illuminate\Http\Response
     */
    public function update(OportunidadHeaderUpdateRequest $request, OportunidadHeader $oportunidadHeader)
    {
        $oportunidadHeader->update($request->validated());

        return $oportunidadHeader;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OportunidadHeader $oportunidadHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OportunidadHeader $oportunidadHeader)
    {
        $oportunidadHeader->delete();

        return $oportunidadHeader;
    }
}
