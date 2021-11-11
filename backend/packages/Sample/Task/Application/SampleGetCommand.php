<?php
declare(strict_types=1);

namespace Sample\Task\Application;

final class SampleGetCommand
{
    /**
     * @param string $sampleId sampleId
     */
    public function __construct(
        public string $sampleId
    ) {
    }
}
