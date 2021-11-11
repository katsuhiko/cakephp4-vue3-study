<?php
declare(strict_types=1);

namespace Sample\Task\Test\Application;

use Sample\Common\Test\Application\TestTransaction;
use Sample\Task\Application\SamplePutApplicationService;
use Sample\Task\Application\SamplePutCommand;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\Sample;
use Sample\Task\Domain\Model\SampleId;
use Mockery;
use PHPUnit\Framework\TestCase;

class SamplePutApplicationServiceTest extends TestCase
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
     * @var \Sample\Task\Application\SamplePutApplicationService
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
        $this->applicationService = new SamplePutApplicationService(
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
        $command = new SamplePutCommand(
            $sampleId->asString(),
            'タイトル',
            '内容です。'
        );

        // Expect
        $this->mockSampleRepository->shouldReceive('save')
            ->with(
                Mockery::on(function (Sample $sample) use ($command) {
                    return $sample->getSampleId()->asString() === $command->sampleId
                        && $sample->getTitle() === $command->title
                        && $sample->getContent() === $command->content;
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
