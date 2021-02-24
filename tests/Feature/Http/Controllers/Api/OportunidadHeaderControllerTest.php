<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\OportunidadHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OportunidadHeaderController
 */
class OportunidadHeaderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $oportunidadHeaders = OportunidadHeader::factory()->count(3)->create();

        $response = $this->get(route('oportunidad-header.index'));

        $response->assertOk();
        $response->assertJson($oportunidadHeaders);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadHeaderController::class,
            'store',
            \App\Http\Requests\Api\OportunidadHeaderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $porcentaje_cierre = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('oportunidad-header.store'), [
            'porcentaje_cierre' => $porcentaje_cierre,
        ]);

        $oportunidadHeaders = OportunidadHeader::query()
            ->where('porcentaje_cierre', $porcentaje_cierre)
            ->get();
        $this->assertCount(1, $oportunidadHeaders);
        $oportunidadHeader = $oportunidadHeaders->first();

        $response->assertOk();
        $response->assertJson($oportunidadHeader);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $oportunidadHeader = OportunidadHeader::factory()->create();

        $response = $this->get(route('oportunidad-header.show', $oportunidadHeader));

        $response->assertOk();
        $response->assertJson($oportunidadHeader);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OportunidadHeaderController::class,
            'update',
            \App\Http\Requests\Api\OportunidadHeaderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $oportunidadHeader = OportunidadHeader::factory()->create();
        $porcentaje_cierre = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('oportunidad-header.update', $oportunidadHeader), [
            'porcentaje_cierre' => $porcentaje_cierre,
        ]);

        $oportunidadHeader->refresh();

        $response->assertOk();
        $response->assertJson($oportunidadHeader);

        $this->assertEquals($porcentaje_cierre, $oportunidadHeader->porcentaje_cierre);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $oportunidadHeader = OportunidadHeader::factory()->create();

        $response = $this->delete(route('oportunidad-header.destroy', $oportunidadHeader));

        $response->assertOk();
        $response->assertJson($oportunidadHeader);

        $this->assertDeleted($oportunidadHeader);
    }
}
