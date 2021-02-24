<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadHeader;
use App\Models\OportunidadSocioNegocio;
use App\Models\SocioHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadSocioNegocioController
 */
class OportunidadSocioNegocioControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadSocioNegocios = OportunidadSocioNegocio::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-socio-negocio.index'));

        $response->assertOk();
        $response->assertJson($oportunidadSocioNegocios);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadSocioNegocioController::class,
            'store',
            \App\Http\Requests\Api\OportunidadSocioNegocioStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();
        $socio_header = SocioHeader::factory()->create();
        $codigo_socio = $this->faker->randomNumber();

        $response = $this->post(route('oportunidad-socio-negocio.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'socio_header_id' => $socio_header->id,
            'codigo_socio' => $codigo_socio,
        ]);

        $oportunidadSocioNegocios = OportunidadSocioNegocio::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->where('socio_header_id', $socio_header->id)
            ->where('codigo_socio', $codigo_socio)
            ->get();
        $this->assertCount(1, $oportunidadSocioNegocios);
        $oportunidadSocioNegocio = $oportunidadSocioNegocios->first();

        $response->assertOk();
        $response->assertJson($oportunidadSocioNegocio);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadSocioNegocio = OportunidadSocioNegocio::factory()->create();

        $response = $this->get(route('oportunidad-socio-negocio.show', $oportunidadSocioNegocio));

        $response->assertOk();
        $response->assertJson($oportunidadSocioNegocio);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadSocioNegocioController::class,
            'update',
            \App\Http\Requests\Api\OportunidadSocioNegocioUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadSocioNegocio = OportunidadSocioNegocio::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();
        $socio_header = SocioHeader::factory()->create();
        $codigo_socio = $this->faker->randomNumber();

        $response = $this->put(route('oportunidad-socio-negocio.update', $oportunidadSocioNegocio), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'socio_header_id' => $socio_header->id,
            'codigo_socio' => $codigo_socio,
        ]);

        $oportunidadSocioNegocio->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadSocioNegocio);

        $this->assertEquals($oportunidad_header->id, $oportunidadSocioNegocio->oportunidad_header_id);
        $this->assertEquals($socio_header->id, $oportunidadSocioNegocio->socio_header_id);
        $this->assertEquals($codigo_socio, $oportunidadSocioNegocio->codigo_socio);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadSocioNegocio = OportunidadSocioNegocio::factory()->create();

        $response = $this->delete(route('oportunidad-socio-negocio.destroy', $oportunidadSocioNegocio));

        $response->assertOk();
        $response->assertJson($oportunidadSocioNegocio);

        $this->assertDeleted($oportunidadSocioNegocio);
    }
}
