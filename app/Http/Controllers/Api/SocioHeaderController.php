<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocioHeaderStoreRequest;
use App\Http\Requests\Api\SocioHeaderUpdateRequest;
use App\Models\SocioHeader;
use Illuminate\Http\Request;

class SocioHeaderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $socioHeaders = SocioHeader::all();

        return $socioHeaders;
    }

    /**
     * @param \App\Http\Requests\Api\SocioHeaderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioHeaderStoreRequest $request)
    {
        $socioHeader = SocioHeader::create($request->validated());

        return $socioHeader;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioHeader $socioHeader
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioHeader $socioHeader)
    {
        return $socioHeader;
    }

    /**
     * @param \App\Http\Requests\Api\SocioHeaderUpdateRequest $request
     * @param \App\Models\SocioHeader $socioHeader
     * @return \Illuminate\Http\Response
     */
    public function update(SocioHeaderUpdateRequest $request, SocioHeader $socioHeader)
    {
        $socioHeader->update($request->validated());

        return $socioHeader;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioHeader $socioHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioHeader $socioHeader)
    {
        $socioHeader->delete();

        return $socioHeader;
    }
}
