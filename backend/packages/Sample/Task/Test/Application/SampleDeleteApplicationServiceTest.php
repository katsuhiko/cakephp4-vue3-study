<?php
declare(strict_types=1);

namespace Sample\Task\Test\Application;

use Sample\Common\Test\Application\TestTransaction;
use Sample\Task\Application\SampleDeleteApplicationService;
use Sample\Task\Application\SampleDeleteCommand;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\SampleId;
use Mockery;
use PHPUnit\Framework\TestCase;

class SampleDeleteApplicationServiceTest extends TestCase
{
    /**
     * @var \Sample\Common\Application\ITransaction
     */
    private $testTransaction;

    /**
     * @var \Mockery\MockInterface|\Sample\Task\Domain\Model\ISampleRepository
     */
    private $mockSampleRepository;

    /**
     * @var \Sample\Task\Application\SampleDeleteApplicationService
     */
    private $applicationService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->testTransaction = new TestTransaction();
        $this->mockSampleRepository = Mockery::mock(ISampleRepository::class);
        $this->applicationService = new SampleDeleteApplicationService(
            $this->testTransaction,
            $this->mockSampleRepository
        );
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     * @return void
     */
    public function testHandle(): void
    {
        // Arrange
        $sampleId = SampleId::newId();
        $command = new SampleDeleteCommand(
            $sampleId->asString()
        );

        // Expect
        $this->mockSampleRepository->shouldReceive('remove')
            ->with(
                Mockery::on(function (SampleId $sampleId) use ($command) {
                    return $sampleId->asString() === $command->sampleId;
                })
            )
            ->andReturn(true)
            ->once();

        // Act
        $result = $this->applicationService->handle($command);

        // Assert
        $this->assertNotNull($result);
    }
}
