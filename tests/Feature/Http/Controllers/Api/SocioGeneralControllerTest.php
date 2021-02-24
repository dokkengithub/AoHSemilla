<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\SocioGeneral;
use App\Models\SocioHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SocioGeneralController
 */
class SocioGeneralControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $socioGenerals = SocioGeneral::factory()->count(3)->create();

        $response = $this->get(route('socio-general.index'));

        $response->assertOk();
        $response->assertJson($socioGenerals);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioGeneralController::class,
            'store',
            \App\Http\Requests\Api\SocioGeneralStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $socio_header = SocioHeader::factory()->create();

        $response = $this->post(route('socio-general.store'), [
            'socio_header_id' => $socio_header->id,
        ]);

        $socioGenerals = SocioGeneral::query()
            ->where('socio_header_id', $socio_header->id)
            ->get();
        $this->assertCount(1, $socioGenerals);
        $socioGeneral = $socioGenerals->first();

        $response->assertOk();
        $response->assertJson($socioGeneral);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $socioGeneral = SocioGeneral::factory()->create();

        $response = $this->get(route('socio-general.show', $socioGeneral));

        $response->assertOk();
        $response->assertJson($socioGeneral);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioGeneralController::class,
            'update',
            \App\Http\Requests\Api\SocioGeneralUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $socioGeneral = SocioGeneral::factory()->create();
        $socio_header = SocioHeader::factory()->create();

        $response = $this->put(route('socio-general.update', $socioGeneral), [
            'socio_header_id' => $socio_header->id,
        ]);

        $socioGeneral->refresh();

        $response->assertOk();
        $response->assertJson($socioGeneral);

        $this->assertEquals($socio_header->id, $socioGeneral->socio_header_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $socioGeneral = SocioGeneral::factory()->create();

        $response = $this->delete(route('socio-general.destroy', $socioGeneral));

        $response->assertOk();
        $response->assertJson($socioGeneral);

        $this->assertDeleted($socioGeneral);
    }
}
