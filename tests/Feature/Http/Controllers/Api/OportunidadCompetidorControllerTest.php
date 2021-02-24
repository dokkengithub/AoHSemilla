<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadCompetidor;
use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadCompetidorController
 */
class OportunidadCompetidorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadCompetidors = OportunidadCompetidor::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-competidor.index'));

        $response->assertOk();
        $response->assertJson($oportunidadCompetidors);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadCompetidorController::class,
            'store',
            \App\Http\Requests\Api\OportunidadCompetidorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();
        $ganado = $this->faker->boolean;

        $response = $this->post(route('oportunidad-competidor.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'ganado' => $ganado,
        ]);

        $oportunidadCompetidors = OportunidadCompetidor::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->where('ganado', $ganado)
            ->get();
        $this->assertCount(1, $oportunidadCompetidors);
        $oportunidadCompetidor = $oportunidadCompetidors->first();

        $response->assertOk();
        $response->assertJson($oportunidadCompetidor);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadCompetidor = OportunidadCompetidor::factory()->create();

        $response = $this->get(route('oportunidad-competidor.show', $oportunidadCompetidor));

        $response->assertOk();
        $response->assertJson($OportunidadCompetidor);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadCompetidorController::class,
            'update',
            \App\Http\Requests\Api\OportunidadCompetidorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadCompetidor = OportunidadCompetidor::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();
        $ganado = $this->faker->boolean;

        $response = $this->put(route('oportunidad-competidor.update', $oportunidadCompetidor), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'ganado' => $ganado,
        ]);

        $oportunidadCompetidor->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadCompetidor);

        $this->assertEquals($oportunidad_header->id, $oportunidadCompetidor->oportunidad_header_id);
        $this->assertEquals($ganado, $oportunidadCompetidor->ganado);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadCompetidor = OportunidadCompetidor::factory()->create();

        $response = $this->delete(route('oportunidad-competidor.destroy', $oportunidadCompetidor));

        $response->assertOk();
        $response->assertJson($oportunidadCompetidor);

        $this->assertDeleted($oportunidadCompetidor);
    }
}
