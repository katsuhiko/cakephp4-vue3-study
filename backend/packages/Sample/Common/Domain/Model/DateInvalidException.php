<?php
declare(strict_types=1);

namespace Sample\Common\Domain\Model;

class DateInvalidException extends DomainException
{
    protected $errorCode = 104;
    protected $errorTitle = '日付が無効です.';
}
