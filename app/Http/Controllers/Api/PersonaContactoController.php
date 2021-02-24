<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonaContactoStoreRequest;
use App\Http\Requests\Api\PersonaContactoUpdateRequest;
use App\Models\PersonaContacto;
use Illuminate\Http\Request;

class PersonaContactoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $personaContactos = PersonaContacto::all();

        return $personaContactos;
    }

    /**
     * @param \App\Http\Requests\Api\PersonaContactoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaContactoStoreRequest $request)
    {
        $personaContacto = PersonaContacto::create($request->validated());

        return $personaContacto;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonaContacto $personaContacto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PersonaContacto $personaContacto)
    {
        return $personaContacto;
    }

    /**
     * @param \App\Http\Requests\Api\PersonaContactoUpdateRequest $request
     * @param \App\Models\PersonaContacto $personaContacto
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaContactoUpdateRequest $request, PersonaContacto $personaContacto)
    {
        $personaContacto->update($request->validated());

        return $personaContacto;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonaContacto $personaContacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PersonaContacto $personaContacto)
    {
        $personaContacto->delete();

        return $personaContacto;
    }
}
