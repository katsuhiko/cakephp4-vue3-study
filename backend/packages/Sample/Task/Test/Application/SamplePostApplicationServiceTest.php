<?php
declare(strict_types=1);

namespace Sample\Task\Test\Application;

use Sample\Common\Test\Application\TestTransaction;
use Sample\Task\Application\SamplePostApplicationService;
use Sample\Task\Application\SamplePostCommand;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\Sample;
use Sample\Task\Domain\Model\SampleId;
use Mockery;
use PHPUnit\Framework\TestCase;

class SamplePostApplicationServiceTest extends TestCase
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
     * @var \Sample\Task\Application\SamplePostApplicationService
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
        $this->applicationService = new SamplePostApplicationService(
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
        $command = new SamplePostCommand(
            'タイトル',
            '内容です。'
        );

        // Expect
        $this->mockSampleRepository->shouldReceive('save')
            ->with(
                Mockery::on(function (Sample $sample) use ($command) {
                    return $sample->getTitle() === $command->title
                        && $sample->getContent() === $command->content;
                })
            )
            ->andReturn(true)
            ->once();

        // Act
        $result = $this->applicationService->handle($command);

        // Assert
        $this->assertNotNull($result->sampleId);
    }
}
