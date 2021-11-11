<?php
declare(strict_types=1);

namespace Sample\Common\Domain\Model;

class RecordNotFoundException extends DomainException
{
    protected $errorCode = 101;
    protected $errorTitle = '該当レコードが存在しません。';
}
