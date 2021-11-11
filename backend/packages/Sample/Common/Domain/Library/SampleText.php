<?php
declare(strict_types=1);

namespace Sample\Common\Domain\Library;

use Ulid\Ulid;

final class SampleText
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return (string)Ulid::generate();
    }
}
