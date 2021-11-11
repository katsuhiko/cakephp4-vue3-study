<?php
declare(strict_types=1);

namespace Sample\Common\Domain\Model;

class DateNotRegexException extends DomainException
{
    protected $errorCode = 103;
    protected $errorTitle = '「MM/DD/YYYY」形式で指定してください.';
}
