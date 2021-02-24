<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadAnexo;
use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadAnexoController
 */
class OportunidadAnexoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadAnexos = OportunidadAnexo::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-anexo.index'));

        $response->assertOk();
        $response->assertJson($oportunidadAnexos);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadAnexoController::class,
            'store',
            \App\Http\Requests\Api\OportunidadAnexoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->post(route('oportunidad-anexo.store'), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadAnexos = OportunidadAnexo::query()
            ->where('oportunidad_header_id', $oportunidad_header->id)
            ->get();
        $this->assertCount(1, $oportunidadAnexos);
        $oportunidadAnexo = $oportunidadAnexos->first();

        $response->assertOk();
        $response->assertJson($oportunidadAnexo);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadAnexo = OportunidadAnexo::factory()->create();

        $response = $this->get(route('oportunidad-anexo.show', $oportunidadAnexo));

        $response->assertOk();
        $response->assertJson($oportunidadAnexo);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadAnexoController::class,
            'update',
            \App\Http\Requests\Api\OportunidadAnexoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadAnexo = OportunidadAnexo::factory()->create();
        $oportunidad_header = OportunidadHeader::factory()->create();

        $response = $this->put(route('oportunidad-anexo.update', $oportunidadAnexo), [
            'oportunidad_header_id' => $oportunidad_header->id,
        ]);

        $oportunidadAnexo->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadAnexo);

        $this->assertEquals($oportunidad_header->id, $oportunidadAnexo->oportunidad_header_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadAnexo = OportunidadAnexo::factory()->create();

        $response = $this->delete(route('oportunidad-anexo.destroy', $oportunidadAnexo));

        $response->assertOk();
        $response->assertJson($oportunidadAnexo);

        $this->assertDeleted($oportunidadAnexo);
    }
}
