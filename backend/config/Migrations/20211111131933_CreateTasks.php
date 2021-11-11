<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTasks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('tasks', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', ['default' => null, 'null' => false])
            ->addColumn('title', 'text', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('content', 'text', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->create();
    }
}
