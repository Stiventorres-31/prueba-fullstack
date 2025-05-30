<?php

namespace Tests\Feature;

use App\Services\VisitServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class StoreVisitTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    private $visitServicesMock;
    protected function setUp(): void
    {
        parent::setUp();

        $this->visitServicesMock = \Mockery::mock(VisitServices::class);
        $this->app->instance(VisitServices::class, $this->visitServicesMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    public function test_store_controller_visit(): void
    {
        $user = \App\Models\User::factory()->create(); 
        $this->actingAs($user);
        $visitData = [
            'name' => 'Chadia Stiven',
            'email' => 'chadia@example.com',
            'latitude' => "10.12345",
            'longitude' => "-74.12345",
            'user_id' => $user->id,
        ];

        $createdVisit = array_merge(['id' => 1], $visitData);


        $this->visitServicesMock
            ->shouldReceive('createVisit')
            ->once()
            
            ->andReturn($createdVisit);


        $response = $this->postJson('/api/visit', $visitData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'Visit created successfully',
                'result' => $createdVisit,
            ]);
    }
}
