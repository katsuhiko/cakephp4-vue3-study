<?php
declare(strict_types=1);

namespace Sample\Task\Domain\Model;

final class Sample
{
    /**
     * @param \Sample\Task\Domain\Model\SampleId $sampleId sampleId
     * @param string $title title
     * @param string $content content
     */
    public function __construct(
        private SampleId $sampleId,
        private string $title,
        private string $content
    ) {
    }

    /**
     * @return \Sample\Task\Domain\Model\SampleId
     */
    public function getSampleId(): SampleId
    {
        return $this->sampleId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
