<?php
declare(strict_types=1);

namespace Sample\Task\Infrastructure\Cakephp;

use Cake\ORM\Locator\LocatorAwareTrait;
use Sample\Task\Domain\Model\ISampleRepository;
use Sample\Task\Domain\Model\Sample;
use Sample\Task\Domain\Model\SampleId;

final class SampleRepository implements ISampleRepository
{
    use LocatorAwareTrait;

    /**
     * @inheritDoc
     */
    public function save(Sample $sample): bool
    {
        $Samples = $this->getTableLocator()->get('SampleSamples');

        /** @var ?\App\Model\Entity\SampleSample $entity */
        $entity = $Samples->find()->where(['id' => $sample->getSampleId()->asString()])->first();
        if (is_null($entity)) {
            /** @var \App\Model\Entity\SampleSample $entity */
            $entity = $Samples->newEmptyEntity();
            $entity->id = $sample->getSampleId()->asString();
        }

        $entity->title = $sample->getTitle();
        $entity->content = $sample->getContent();

        $result = $Samples->save($entity, ['atomic' => false, 'checkExisting' => false]);
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(SampleId $sampleId): bool
    {
        $Samples = $this->getTableLocator()->get('SampleSamples');

        /** @var ?\App\Model\Entity\SampleSample $entity */
        $entity = $Samples->find()->where(['id' => $sampleId->asString()])->first();
        if (is_null($entity)) {
            return true;
        }

        $result = $Samples->delete($entity, ['atomic' => false]);
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function findById(SampleId $sampleId): ?Sample
    {
        $Samples = $this->getTableLocator()->get('SampleSamples');

        /** @var ?\App\Model\Entity\SampleSample $entity */
        $entity = $Samples->find()->where(['id' => $sampleId->asString()])->first();
        if (is_null($entity)) {
            return null;
        }

        return new Sample(
            new SampleId($entity->id),
            $entity->title,
            $entity->content
        );
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $Samples = $this->getTableLocator()->get('SampleSamples');

        /** @var \App\Model\Entity\SampleSample[] $entities */
        $entities = $Samples->find()->all()->toList();

        /** @var \Sample\Task\Domain\Model\Sample[] $result */
        $result = [];
        foreach ($entities as $entity) {
            $result[] = new Sample(
                new SampleId($entity->id),
                $entity->title,
                $entity->content
            );
        }

        return $result;
    }
}
