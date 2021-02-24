<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadActividad;
use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadActividadController
 */
class OportunidadActividadControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadActividads = OportunidadActividad::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-actividad.index'));

        $response->assertOk();
        $response->assertJson($oportunidadActividads);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadActividadController::class,
            'store',
            \App\Http\Requests\Api\OportunidadActividadStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->post(route('oportunidad-actividad.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadActividads = OportunidadActividad::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->get();
        $this->assertCount(1, $oportunidadActividads);
        $oportunidadActividad = $oportunidadActividads->first();

        $response->assertOk();
        $response->assertJson($oportunidadActividad);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadActividad = OportunidadActividad::factory()->create();

        $response = $this->get(route('oportunidad-actividad.show', $oportunidadActividad));

        $response->assertOk();
        $response->assertJson($oportunidadActividad);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadActividadController::class,
            'update',
            \App\Http\Requests\Api\OportunidadActividadUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadActividad = OportunidadActividad::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->put(route('oportunidad-actividad.update', $oportunidadActividad), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadActividad->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadActividad);

        $this->assertEquals($oportunidad_header->id, $oportunidadActividad->oportunidad_header_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadActividad = OportunidadActividad::factory()->create();

        $response = $this->delete(route('oportunidad-actividad.destroy', $oportunidadActividad));

        $response->assertOk();
        $response->assertJson($oportunidadActividad);

        $this->assertDeleted($oportunidadActividad);
    }
}
