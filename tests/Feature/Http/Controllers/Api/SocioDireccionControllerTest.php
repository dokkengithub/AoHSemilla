<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\SocioDireccion;
use App\Models\SocioHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SocioDireccionController
 */
class SocioDireccionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $socioDireccions = SocioDireccion::factory()->count(3)->create();

        $response = $this->get(route('socio-direccion.index'));

        $response->assertOk();
        $response->assertJson($socioDireccions);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioDireccionController::class,
            'store',
            \App\Http\Requests\Api\SocioDireccionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $socio_header = SocioHeader::factory()->create();
        $direccion_id = $this->faker->randomNumber();

        $response = $this->post(route('socio-direccion.store'), [
            'socio_header_id' => $socio_header->id,
            'direccion_id' => $direccion_id,
        ]);

        $socioDireccions = SocioDireccion::query()
            ->where('socio_header_id', $socio_header->id)
            ->where('direccion_id', $direccion_id)
            ->get();
        $this->assertCount(1, $socioDireccions);
        $socioDireccion = $socioDireccions->first();

        $response->assertOk();
        $response->assertJson($socioDireccion);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $socioDireccion = SocioDireccion::factory()->create();

        $response = $this->get(route('socio-direccion.show', $socioDireccion));

        $response->assertOk();
        $response->assertJson($socioDireccion);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioDireccionController::class,
            'update',
            \App\Http\Requests\Api\SocioDireccionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $socioDireccion = SocioDireccion::factory()->create();
        $socio_header = SocioHeader::factory()->create();
        $direccion_id = $this->faker->randomNumber();

        $response = $this->put(route('socio-direccion.update', $socioDireccion), [
            'socio_header_id' => $socio_header->id,
            'direccion_id' => $direccion_id,
        ]);

        $socioDireccion->refresh();

        $response->assertOk();
        $response->assertJson($socioDireccion);

        $this->assertEquals($socio_header->id, $socioDireccion->socio_header_id);
        $this->assertEquals($direccion_id, $socioDireccion->direccion_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $socioDireccion = SocioDireccion::factory()->create();

        $response = $this->delete(route('socio-direccion.destroy', $socioDireccion));

        $response->assertOk();
        $response->assertJson($socioDireccion);

        $this->assertDeleted($socioDireccion);
    }
}
