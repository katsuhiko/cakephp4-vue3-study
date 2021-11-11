<?php
declare(strict_types=1);

namespace Sample\Task\Application;

final class SampleListGetResult
{
    /**
     * @param \Sample\Task\Application\SampleResult[] $samples samples
     */
    public function __construct(
        public array $samples
    ) {
    }
}
