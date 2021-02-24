<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocioDireccionStoreRequest;
use App\Http\Requests\Api\SocioDireccionUpdateRequest;
use App\Models\SocioDireccion;
use Illuminate\Http\Request;

class SocioDireccionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $socioDireccions = SocioDireccion::all();

        return $socioDireccions;
    }

    /**
     * @param \App\Http\Requests\Api\SocioDireccionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioDireccionStoreRequest $request)
    {
        $socioDireccion = SocioDireccion::create($request->validated());

        return $socioDireccion;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioDireccion $socioDireccion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioDireccion $socioDireccion)
    {
        return $socioDireccion;
    }

    /**
     * @param \App\Http\Requests\Api\SocioDireccionUpdateRequest $request
     * @param \App\Models\SocioDireccion $socioDireccion
     * @return \Illuminate\Http\Response
     */
    public function update(SocioDireccionUpdateRequest $request, SocioDireccion $socioDireccion)
    {
        $socioDireccion->update($request->validated());

        return $socioDireccion;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioDireccion $socioDireccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioDireccion $socioDireccion)
    {
        $socioDireccion->delete();

        return $socioDireccion;
    }
}
