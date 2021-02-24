<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\PersonaContacto;
use App\Models\SocioHeader;
use App\Models\SocioPersonaContacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SocioPersonaContactoController
 */
class SocioPersonaContactoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $socioPersonaContactos = SocioPersonaContacto::factory()->count(3)->create();

        $response = $this->get(route('socio-persona-contacto.index'));

        $response->assertOk();
        $response->assertJson($socioPersonaContactos);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioPersonaContactoController::class,
            'store',
            \App\Http\Requests\Api\SocioPersonaContactoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $socio_header = SocioHeader::factory()->create();
        $persona_contacto = PersonaContacto::factory()->create();

        $response = $this->post(route('socio-persona-contacto.store'), [
            'socio_header_id' => $socio_header->id,
            'persona_contacto_id' => $persona_contacto->id,
        ]);

        $socioPersonaContactos = SocioPersonaContacto::query()
            ->where('socio_header_id', $socio_header->id)
            ->where('persona_contacto_id', $persona_contacto->id)
            ->get();
        $this->assertCount(1, $socioPersonaContactos);
        $socioPersonaContacto = $socioPersonaContactos->first();

        $response->assertOk();
        $response->assertJson($socioPersonaContacto);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $socioPersonaContacto = SocioPersonaContacto::factory()->create();

        $response = $this->get(route('socio-persona-contacto.show', $socioPersonaContacto));

        $response->assertOk();
        $response->assertJson($socioPersonaContacto);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioPersonaContactoController::class,
            'update',
            \App\Http\Requests\Api\SocioPersonaContactoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $socioPersonaContacto = SocioPersonaContacto::factory()->create();
        $socio_header = SocioHeader::factory()->create();
        $persona_contacto = PersonaContacto::factory()->create();

        $response = $this->put(route('socio-persona-contacto.update', $socioPersonaContacto), [
            'socio_header_id' => $socio_header->id,
            'persona_contacto_id' => $persona_contacto->id,
        ]);

        $socioPersonaContacto->refresh();

        $response->assertOk();
        $response->assertJson($socioPersonaContacto);

        $this->assertEquals($socio_header->id, $socioPersonaContacto->socio_header_id);
        $this->assertEquals($persona_contacto->id, $socioPersonaContacto->persona_contacto_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $socioPersonaContacto = SocioPersonaContacto::factory()->create();

        $response = $this->delete(route('socio-persona-contacto.destroy', $socioPersonaContacto));

        $response->assertOk();
        $response->assertJson($socioPersonaContacto);

        $this->assertDeleted($socioPersonaContacto);
    }
}
