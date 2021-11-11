<?php
declare(strict_types=1);

namespace Sample\Task\Application;

use Sample\Common\Application\ITransaction;
use Sample\Common\Domain\Model\TransactionException;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\SampleId;

class SampleDeleteApplicationService
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
     * @param \Sample\Task\Application\SampleDeleteCommand $command command
     * @return \Sample\Task\Application\SampleDeleteResult
     */
    public function handle(SampleDeleteCommand $command): SampleDeleteResult
    {
        $sampleId = new SampleId($command->sampleId);

        $this->transaction->transactional(function () use ($sampleId) {
            $result = $this->sampleRepository->remove($sampleId);
            if (!$result) {
                throw new TransactionException("[{$sampleId}] samples 削除できませんでした。");
            }

            return true;
        });

        return new SampleDeleteResult();
    }
}
