<?php
declare(strict_types=1);

namespace Sample\Task\Application;

final class SamplePutCommand
{
    /**
     * @param string $sampleId sampleId
     * @param string $title title
     * @param string $content content
     */
    public function __construct(
        public string $sampleId,
        public string $title,
        public string $content
    ) {
    }
}
