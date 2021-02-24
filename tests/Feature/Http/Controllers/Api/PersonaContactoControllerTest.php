<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\PersonaContacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PersonaContactoController
 */
class PersonaContactoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $personaContactos = PersonaContacto::factory()->count(3)->create();

        $response = $this->get(route('persona-contacto.index'));

        $response->assertOk();
        $response->assertJson($personaContactos);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PersonaContactoController::class,
            'store',
            \App\Http\Requests\Api\PersonaContactoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $response = $this->post(route('persona-contacto.store'));

        $response->assertOk();
        $response->assertJson($personaContacto);

        $this->assertDatabaseHas(personaContactos, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $personaContacto = PersonaContacto::factory()->create();

        $response = $this->get(route('persona-contacto.show', $personaContacto));

        $response->assertOk();
        $response->assertJson($personaContacto);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PersonaContactoController::class,
            'update',
            \App\Http\Requests\Api\PersonaContactoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $personaContacto = PersonaContacto::factory()->create();

        $response = $this->put(route('persona-contacto.update', $personaContacto));

        $personaContacto->refresh();

        $response->assertOk();
        $response->assertJson($personaContacto);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $personaContacto = PersonaContacto::factory()->create();

        $response = $this->delete(route('persona-contacto.destroy', $personaContacto));

        $response->assertOk();
        $response->assertJson($personaContacto);

        $this->assertDeleted($personaContacto);
    }
}
