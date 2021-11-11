<?php
declare(strict_types=1);

namespace Sample\Common\Test\Application;

use Sample\Common\Application\ITransaction;

class TestTransaction implements ITransaction
{
    /**
     * @param callable $callback callback
     * @return mixed
     */
    public function transactional(callable $callback)
    {
        return $callback();
    }
}
