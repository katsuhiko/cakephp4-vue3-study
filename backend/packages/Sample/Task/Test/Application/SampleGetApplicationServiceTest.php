<?php
declare(strict_types=1);

namespace Sample\Task\Test\Application;

use Sample\Task\Application\SampleGetApplicationService;
use Sample\Task\Application\SampleGetCommand;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\Sample;
use Sample\Task\Domain\Model\SampleId;
use Mockery;
use PHPUnit\Framework\TestCase;

class SampleGetApplicationServiceTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\Sample\Task\Domain\Model\ISampleRepository
     */
    private $mockSampleRepository;

    /**
     * @var \Sample\Task\Application\SampleGetApplicationService
     */
    private $applicationService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockSampleRepository = Mockery::mock(ISampleRepository::class);
        $this->applicationService = new SampleGetApplicationService(
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
        $command = new SampleGetCommand(
            $sampleId->asString()
        );

        $expectedSample = new Sample(
            $sampleId,
            'タイトル',
            '内容です。'
        );

        // Expect
        $this->mockSampleRepository->shouldReceive('findById')
            ->with(
                Mockery::on(function (SampleId $sampleId) use ($command) {
                    return $sampleId->asString() === $command->sampleId;
                })
            )
            ->andReturn($expectedSample)
            ->once();

        // Act
        $result = $this->applicationService->handle($command);

        // Assert
        $this->assertEquals($expectedSample->getSampleId(), $result->sampleId);
        $this->assertEquals($expectedSample->getTitle(), $result->title);
        $this->assertEquals($expectedSample->getContent(), $result->content);
    }
}
