<?php
declare(strict_types=1);

namespace Sample\Task\Domain\Model;

interface ISampleRepository
{
    /**
     * @param \Sample\Task\Domain\Model\Sample $sample sample
     * @return bool
     */
    public function save(Sample $sample): bool;

    /**
     * @param \Sample\Task\Domain\Model\SampleId $sampleId sampleId
     * @return bool
     */
    public function remove(SampleId $sampleId): bool;

    /**
     * @param \Sample\Task\Domain\Model\SampleId $sampleId sampleId
     * @return \Sample\Task\Domain\Model\Sample
     */
    public function findById(SampleId $sampleId): ?Sample;

    /**
     * @return \Sample\Task\Domain\Model\Sample[]
     */
    public function findAll(): array;
}
