<?php
declare(strict_types=1);

namespace Sample\Task\Application;

use Sample\Common\Domain\Model\RecordNotFoundException;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\SampleId;

class SampleGetApplicationService
{
    /**
     * @param \Sample\Task\Domain\Model\ISampleRepository $sampleRepository sampleRepository
     */
    public function __construct(
        private ISampleRepository $sampleRepository
    ) {
    }

    /**
     * @param \Sample\Task\Application\SampleGetCommand $command command
     * @return \Sample\Task\Application\SampleGetResult
     */
    public function handle(SampleGetCommand $command): SampleGetResult
    {
        $sampleId = new SampleId($command->sampleId);

        $sample = $this->sampleRepository->findById($sampleId);
        if (!$sample) {
            throw new RecordNotFoundException("[{$sampleId}] samples record not found");
        }

        return new SampleGetResult(
            $sample->getSampleId()->asString(),
            $sample->getTitle(),
            $sample->getContent()
        );
    }
}
