<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadGeneral;
use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadGeneralController
 */
class OportunidadGeneralControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadGenerals = OportunidadGeneral::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-general.index'));

        $response->assertOk();
        $response->assertJson($oportunidadGenerals);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadGeneralController::class,
            'store',
            \App\Http\Requests\Api\OportunidadGeneralStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->post(route('oportunidad-general.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadGenerals = OportunidadGeneral::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->get();
        $this->assertCount(1, $oportunidadGenerals);
        $oportunidadGeneral = $oportunidadGenerals->first();

        $response->assertOk();
        $response->assertJson($oportunidadGeneral);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadGeneral = OportunidadGeneral::factory()->create();

        $response = $this->get(route('oportunidad-general.show', $oportunidadGeneral));

        $response->assertOk();
        $response->assertJson($oportunidadGeneral);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadGeneralController::class,
            'update',
            \App\Http\Requests\Api\OportunidadGeneralUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadGeneral = OportunidadGeneral::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->put(route('oportunidad-general.update', $oportunidadGeneral), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadGeneral->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadGeneral);

        $this->assertEquals($oportunidad_header->id, $oportunidadGeneral->oportunidad_header_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadGeneral = OportunidadGeneral::factory()->create();

        $response = $this->delete(route('oportunidad-general.destroy', $oportunidadGeneral));

        $response->assertOk();
        $response->assertJson($oportunidadGeneral);

        $this->assertDeleted($oportunidadGeneral);
    }
}
