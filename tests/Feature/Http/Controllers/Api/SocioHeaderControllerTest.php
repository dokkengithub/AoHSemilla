<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\SocioHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SocioHeaderController
 */
class SocioHeaderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_responds_with()
    {
        $socioHeaders = SocioHeader::factory()->count(3)->create();

        $response = $this->get(route('socio-header.index'));

        $response->assertOk();
        $response->assertJson($socioHeaders);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioHeaderController::class,
            'store',
            \App\Http\Requests\Api\SocioHeaderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_responds_with()
    {
        $response = $this->post(route('socio-header.store'));

        $response->assertOk();
        $response->assertJson($socioHeader);

        $this->assertDatabaseHas(socioHeaders, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_responds_with()
    {
        $socioHeader = SocioHeader::factory()->create();

        $response = $this->get(route('socio-header.show', $socioHeader));

        $response->assertOk();
        $response->assertJson($socioHeader);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SocioHeaderController::class,
            'update',
            \App\Http\Requests\Api\SocioHeaderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_responds_with()
    {
        $socioHeader = SocioHeader::factory()->create();

        $response = $this->put(route('socio-header.update', $socioHeader));

        $socioHeader->refresh();

        $response->assertOk();
        $response->assertJson($socioHeader);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $socioHeader = SocioHeader::factory()->create();

        $response = $this->delete(route('socio-header.destroy', $socioHeader));

        $response->assertOk();
        $response->assertJson($socioHeader);

        $this->assertDeleted($socioHeader);
    }
}
