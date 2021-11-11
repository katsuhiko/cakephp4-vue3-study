<?php
declare(strict_types=1);

namespace Sample\Common\Application;

interface ITransaction
{
    /**
     * @param callable $callback callback
     * @return mixed
     */
    public function transactional(callable $callback);
}
