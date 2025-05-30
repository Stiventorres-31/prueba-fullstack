<?php

namespace Tests\Unit\Services;

use App\Repositories\VisitRepository;
use App\Services\VisitServices;
use Mockery;
use PHPUnit\Framework\TestCase;

class VisitServicesTest extends TestCase
{
    private $visitRepository;
    private $visitServices;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un mock de VisitRepository
        $this->visitRepository = Mockery::mock(VisitRepository::class);

        // Inyectar el mock en VisitServices
        $this->visitServices = new VisitServices($this->visitRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_should_create_a_visit()
    {
        // Datos de prueba
        $visitData = [
            'name' => 'Stiven Mendoza',
            'email' => 'stiven@example.com',
            'latitude' => 10.8706578,
            'longitude' => -74.7751984,
            'user_id' => 1,
        ];

        $expectedResult = array_merge(['user_id' => 1], $visitData);

        $this->visitRepository
            ->shouldReceive('createVisit')
            ->once()
            ->with($visitData)
            ->andReturn($expectedResult);

        $result = $this->visitServices->createVisit($visitData);

        $this->assertEquals($expectedResult, $result);
    }
}
