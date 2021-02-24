<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadEtapa;
use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadEtapaController
 */
class OportunidadEtapaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadEtapas = OportunidadEtapa::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-etapa.index'));

        $response->assertOk();
        $response->assertJson($oportunidadEtapas);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadEtapaController::class,
            'store',
            \App\Http\Requests\Api\OportunidadEtapaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();
        $porcentaje = $this->faker->randomFloat(/** decimal_attributes **/);
        $monto_potencial = $this->faker->randomFloat(/** decimal_attributes **/);
        $importe_ponderado = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('oportunidad-etapa.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'porcentaje' => $porcentaje,
            'monto_potencial' => $monto_potencial,
            'importe_ponderado' => $importe_ponderado,
        ]);

        $oportunidadEtapas = OportunidadEtapa::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->where('porcentaje', $porcentaje)
            ->where('monto_potencial', $monto_potencial)
            ->where('importe_ponderado', $importe_ponderado)
            ->get();
        $this->assertCount(1, $oportunidadEtapas);
        $oportunidadEtapa = $oportunidadEtapas->first();

        $response->assertOk();
        $response->assertJson($oportunidadEtapa);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadEtapa = OportunidadEtapa::factory()->create();

        $response = $this->get(route('oportunidad-etapa.show', $oportunidadEtapa));

        $response->assertOk();
        $response->assertJson($oportunidadEtapa);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadEtapaController::class,
            'update',
            \App\Http\Requests\Api\OportunidadEtapaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadEtapa = OportunidadEtapa::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();
        $porcentaje = $this->faker->randomFloat(/** decimal_attributes **/);
        $monto_potencial = $this->faker->randomFloat(/** decimal_attributes **/);
        $importe_ponderado = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('oportunidad-etapa.update', $oportunidadEtapa), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'porcentaje' => $porcentaje,
            'monto_potencial' => $monto_potencial,
            'importe_ponderado' => $importe_ponderado,
        ]);

        $oportunidadEtapa->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadEtapa);

        $this->assertEquals($oportunidad_header->id, $oportunidadEtapa->oportunidad_header_id);
        $this->assertEquals($porcentaje, $oportunidadEtapa->porcentaje);
        $this->assertEquals($monto_potencial, $oportunidadEtapa->monto_potencial);
        $this->assertEquals($importe_ponderado, $oportunidadEtapa->importe_ponderado);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadEtapa = OportunidadEtapa::factory()->create();

        $response = $this->delete(route('oportunidad-etapa.destroy', $oportunidadEtapa));

        $response->assertOk();
        $response->assertJson($oportunidadEtapa);

        $this->assertDeleted($oportunidadEtapa);
    }
}
