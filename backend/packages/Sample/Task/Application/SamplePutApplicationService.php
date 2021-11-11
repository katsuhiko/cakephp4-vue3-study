<?php
declare(strict_types=1);

namespace Sample\Task\Application;

use Sample\Common\Application\ITransaction;
use Sample\Common\Domain\Model\TransactionException;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\Sample;
use Sample\Task\Domain\Model\SampleId;

class SamplePutApplicationService
{
    /**
     * @param \Sample\Common\Application\ITransaction $transaction transaction
     * @param \Sample\Task\Domain\Model\ISampleRepository $sampleRepository sampleRepository
     */
    public function __construct(
        private ITransaction $transaction,
        private ISampleRepository $sampleRepository
    ) {
    }

    /**
     * @param \Sample\Task\Application\SamplePutCommand $command command
     * @return \Sample\Task\Application\SamplePutResult
     */
    public function handle(SamplePutCommand $command): SamplePutResult
    {
        $sampleId = new SampleId($command->sampleId);

        $sample = new Sample(
            $sampleId,
            $command->title,
            $command->content
        );

        $this->transaction->transactional(function () use ($sample) {
            $result = $this->sampleRepository->save($sample);
            if (!$result) {
                throw new TransactionException("[{$sample->getSampleId()}] samples 更新できませんでした。");
            }

            return true;
        });

        return new SamplePutResult();
    }
}
