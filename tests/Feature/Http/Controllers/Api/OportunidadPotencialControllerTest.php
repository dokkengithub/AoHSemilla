<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadHeader;
use App\Models\OportunidadPotencial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadPotencialController
 */
class OportunidadPotencialControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadPotencials = OportunidadPotencial::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-potencial.index'));

        $response->assertOk();
        $response->assertJson($oportunidadPotencials);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadPotencialController::class,
            'store',
            \App\Http\Requests\Api\OportunidadPotencialStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();
        $monto_potencial = $this->faker->randomFloat(/** decimal_attributes **/);
        $monto_ponderado = $this->faker->randomFloat(/** decimal_attributes **/);
        $porc_ganancia_bruta = $this->faker->randomFloat(/** decimal_attributes **/);
        $ganancia_bruta_total = $this->faker->randomFloat(/** decimal_attributes **/);
        $nivel_de_interes = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('oportunidad-potencial.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'monto_potencial' => $monto_potencial,
            'monto_ponderado' => $monto_ponderado,
            'porc_ganancia_bruta' => $porc_ganancia_bruta,
            'ganancia_bruta_total' => $ganancia_bruta_total,
            'nivel_de_interes' => $nivel_de_interes,
        ]);

        $oportunidadPotencials = OportunidadPotencial::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->where('monto_potencial', $monto_potencial)
            ->where('monto_ponderado', $monto_ponderado)
            ->where('porc_ganancia_bruta', $porc_ganancia_bruta)
            ->where('ganancia_bruta_total', $ganancia_bruta_total)
            ->where('nivel_de_interes', $nivel_de_interes)
            ->get();
        $this->assertCount(1, $oportunidadPotencials);
        $oportunidadPotencial = $oportunidadPotencials->first();

        $response->assertOk();
        $response->assertJson($oportunidadPotencial);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadPotencial = OportunidadPotencial::factory()->create();

        $response = $this->get(route('oportunidad-potencial.show', $oportunidadPotencial));

        $response->assertOk();
        $response->assertJson($oportunidadPotencial);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadPotencialController::class,
            'update',
            \App\Http\Requests\Api\OportunidadPotencialUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadPotencial = OportunidadPotencial::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();
        $monto_potencial = $this->faker->randomFloat(/** decimal_attributes **/);
        $monto_ponderado = $this->faker->randomFloat(/** decimal_attributes **/);
        $porc_ganancia_bruta = $this->faker->randomFloat(/** decimal_attributes **/);
        $ganancia_bruta_total = $this->faker->randomFloat(/** decimal_attributes **/);
        $nivel_de_interes = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('oportunidad-potencial.update', $oportunidadPotencial), [
            'oportunidad_header_id' => $oportunidad_header->id,
            'monto_potencial' => $monto_potencial,
            'monto_ponderado' => $monto_ponderado,
            'porc_ganancia_bruta' => $porc_ganancia_bruta,
            'ganancia_bruta_total' => $ganancia_bruta_total,
            'nivel_de_interes' => $nivel_de_interes,
        ]);

        $oportunidadPotencial->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadPotencial);

        $this->assertEquals($oportunidad_header->id, $oportunidadPotencial->oportunidad_header_id);
        $this->assertEquals($monto_potencial, $oportunidadPotencial->monto_potencial);
        $this->assertEquals($monto_ponderado, $oportunidadPotencial->monto_ponderado);
        $this->assertEquals($porc_ganancia_bruta, $oportunidadPotencial->porc_ganancia_bruta);
        $this->assertEquals($ganancia_bruta_total, $oportunidadPotencial->ganancia_bruta_total);
        $this->assertEquals($nivel_de_interes, $oportunidadPotencial->nivel_de_interes);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadPotencial = OportunidadPotencial::factory()->create();

        $response = $this->delete(route('oportunidad-potencial.destroy', $oportunidadPotencial));

        $response->assertOk();
        $response->assertJson($oportunidadPotencial);

        $this->assertDeleted($oportunidadPotencial);
    }
}
