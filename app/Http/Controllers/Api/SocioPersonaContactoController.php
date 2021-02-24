<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocioPersonaContactoStoreRequest;
use App\Http\Requests\Api\SocioPersonaContactoUpdateRequest;
use App\Models\SocioPersonaContacto;
use Illuminate\Http\Request;

class SocioPersonaContactoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $socioPersonaContactos = SocioPersonaContacto::all();

        return $socioPersonaContactos;
    }

    /**
     * @param \App\Http\Requests\Api\SocioPersonaContactoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocioPersonaContactoStoreRequest $request)
    {
        $socioPersonaContacto = SocioPersonaContacto::create($request->validated());

        return $socioPersonaContacto;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioPersonaContacto $socioPersonaContacto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SocioPersonaContacto $socioPersonaContacto)
    {
        return $socioPersonaContacto;
    }

    /**
     * @param \App\Http\Requests\Api\SocioPersonaContactoUpdateRequest $request
     * @param \App\Models\SocioPersonaContacto $socioPersonaContacto
     * @return \Illuminate\Http\Response
     */
    public function update(SocioPersonaContactoUpdateRequest $request, SocioPersonaContacto $socioPersonaContacto)
    {
        $socioPersonaContacto->update($request->validated());

        return $socioPersonaContacto;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SocioPersonaContacto $socioPersonaContacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SocioPersonaContacto $socioPersonaContacto)
    {
        $socioPersonaContacto->delete();

        return $socioPersonaContacto;
    }
}
