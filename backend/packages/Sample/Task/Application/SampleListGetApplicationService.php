<?php
declare(strict_types=1);

namespace Sample\Task\Application;

use Sample\Task\Domain\Model\ISampleRepository;

class SampleListGetApplicationService
{
    /**
     * @param \Sample\Task\Domain\Model\ISampleRepository $sampleRepository sampleRepository
     */
    public function __construct(
        private ISampleRepository $sampleRepository
    ) {
    }

    /**
     * @param \Sample\Task\Application\SampleListGetCommand $command command
     * @return \Sample\Task\Application\SampleListGetResult
     */
    public function handle(SampleListGetCommand $command): SampleListGetResult
    {
        $samples = $this->sampleRepository->findAll();

        /** @var \Sample\Task\Application\SampleResult[] $sampleResult */
        $sampleResult = [];
        foreach ($samples as $sample) {
            $sampleResult[] = new SampleResult(
                $sample->getSampleId()->asString(),
                $sample->getTitle(),
                $sample->getContent()
            );
        }

        return new SampleListGetResult(
            $sampleResult
        );
    }
}
